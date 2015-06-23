<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\Models\Customers;
use backend\Models\Customeruseapps;

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
                        'actions' => ['logout', 'index','updatecust','runapp'],
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
    public function actionRunapp($id)
    {
        if ( !\Yii::$app->user->can('CloudApps') ){return false; }
            if(($apps = Customeruseapps::findOne($id)) !== null){
                \Yii::$app->session->set('username',\Yii::$app->user->identity->email);  
                \Yii::$app->session->set('is_admin',true);  
                \Yii::$app->session->set('companycode',$apps->companycode);  
                \Yii::$app->session->set('appcode',$apps->orderPlan->appcode);              
                $this->redirect("http://clouds.cubiconia.com/orchid.php/applogin/adminauth") ;
            }else{
                return $this->goBack();
            }            
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