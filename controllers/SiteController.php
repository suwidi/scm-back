<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\Customeruseapps;
use backend\models\Orders;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\SignupForm;
use common\models\User;
use frontend\models\ContactForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','error','reset-password','captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','error', 'index','app','login'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
       $key = (string)mt_rand(100000,999999);
       // echo $key;die;
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                 'class' => 'yii\captcha\CaptchaAction',
                 'backColor' => '14472670',
                 'minLength' => '4',
                 'maxLength' => '5',
                 //'fixedVerifyCode' => $key,
            ],
        ];
    }

    public function actionIndex()
    {   
       $orderCust = Orders::find()->where(['status'=>'OPEN'])->count();
       $orderApps = Customeruseapps::find()->where(['status'=>'OPEN'])->count();
       $order = array('custs'=>$orderCust,'apps'=>$orderApps);
       return $this->render('index',['order'=>$order]);
    }
    public function actionApp()
    {
        return $this->render('app');
    }
   
    public function actionLogin()
    {
        $this->layout = 'main-login';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->goHome();
    }
    public function actionResetPassword($token)
    {
       $this->layout = 'main-login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');    
            $this->sendEmailActivation($model->_user->email,'password');            
            return $this->redirect(['site/login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    protected function sendEmailActivation($email,$type=null)
    {
        // buat reset password dan kirim email
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $email,
        ]);
          $email= $user->email;
          $admins = \Yii::$app->params['adminEmail']; 
        if ($user) {

        switch ($type) {
            case 'password':
                    return \Yii::$app->mailer->compose(['html' => 'activation-password-html', 'text' => 'activation-password-text'], ['user' => $user])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'Cubiconia'])
                        ->setTo($email)
                        ->setBcc($admins)
                        ->setSubject('[Cubiconia] Aktivasi Super Administrator')
                        ->send();
                break;            
            default:
                return false;
                break;
         }
            
        }       
        return false;
        
    }

    
}
