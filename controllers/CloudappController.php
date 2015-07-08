<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\Customers;
use backend\models\Session;
use backend\models\Customeruseapps;

/**
 * cloudApp controller
 */
class CloudappController extends Controller
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
                        'actions' => ['logout', 'error', 'index','updatecust','runapp','profile'],
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
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $auth_user = \Yii::$app->user;
        if ( !$auth_user->can('CloudApps') ){return false; }
        $customer = $this->findCustomer($auth_user->identity->email);    
        return $this->render('index',['dataprovider'=>$customer]);

    }  
    public function actionProfile()
    {
        $auth_user = \Yii::$app->user;
       // if ( !$auth_user->can('CloudApps') ){return false; }
        $customer = $this->findCustomer($auth_user->identity->email);    
        return $this->render('_profile',['dataprovider'=>$customer]);

    }  
    public function actionRunapp($id)
    {
        if ( !\Yii::$app->user->can('CloudApps') ){return false; }
            if(($apps = Customeruseapps::findOne($id)) !== null){
                $ip = \Yii::$app->getRequest()->getUserIP(); // Yii::$app->request->userHost;
                $username = $this->encrypt_decrypt ('enc',\Yii::$app->user->identity->email);
                // $referrer = "http://clouds.cubiconia.com/orchid.php/applogin/adminauth/".$username;
                $referrer = \Yii::$app->getRequest()->getReferrer();
                $sessionDB = new Session( [
                            'ip' => $ip,
                            'username' => $username,
                            'startdate' => date('Y-m-d H:i:s'),
                            'isadmin' => '1',
                            'companycode' => $apps->companycode,
                            'appcode' => $apps->orderPlan->appcode,
                            'referrer' => $referrer,
                            ]);                   
               $sessionDB->save();
               $this->redirect("http://clouds.cubiconia.com/orchid.php/applogin/adminauth/".$username);

            }else{
                return $this->goBack();
            }       
        
    }  
    protected function encrypt_decrypt($action,$string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'k3';
        $secret_iv = 'i4';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);    

        if( $action == 'enc' ) {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            }else if( $action == 'dec' ){
            
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

    return $output;
    }
    protected function findCustomer($key)
    {   
        if(is_numeric($key)){
            if (($model = Customers::findOne($key)) !== null) {
            return $model;}
        }else{
           if (($model = Customers::findOne(['email'=>$key])) !== null) {
            return $model;}
        }       
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Updates an existing customers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatecust($id)
    {
        $model = $this->findCustomer($id);
        if(($model->email === Yii::$app->user->identity->email) || (\Yii::$app->user->can('CloudAdmin'))){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }else {
                return $this->render('_formcust', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->goBack();
        }
        
    }

}