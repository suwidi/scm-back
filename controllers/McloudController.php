<?php
namespace backend\controllers;

use Yii;
// use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\LoginForm;
use common\models\User;
use common\models\SignupForm;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use backend\models\Orders;
use backend\models\Customers;
use backend\models\MasterDatabase;
use backend\models\Customeruseapps;
use backend\models\OrdersSearch;
use backend\models\CustomersSearch;
use backend\models\CustomeruseappsSearch;
/**
 * Mcloud controller
 */
class McloudController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','ordercust','actcust','actapps','viewcust','indexcust','indexapps'],
                        'allow' => true,
                        'roles' => ['@'
                             ],
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
        if (! \Yii::$app->user->can('CloudAdmin')){return FALSE; }
        return $this->render('index');
    }  
    public function actionOrdercust()
    {   
        if (! \Yii::$app->user->can('CloudAdmin')){return FALSE; }
        $query = Orders::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere([
                'status' =>'OPEN',
            ]);
        $queryApp = Customeruseapps::find();
        $dataProviderApp = new ActiveDataProvider([
            'query' => $queryApp,
        ]);        
        $queryApp->andFilterWhere([
                'status' =>'OPEN',
            ]);
        return $this->render('../ordercust/index', [
             'dataProvider' => $dataProvider,
             'dataProviderApp'=>$dataProviderApp,
        ]);
    }    

    public function actionActcust($id)
    {
        if (! \Yii::$app->user->can('CloudAdmin')){return FALSE; }
        $model = $this->findOrdercust($id);

        $customers = new Customers();
        $customers->companycode = $this->getCompanyCode(8);
        $customers->contactname = strtoupper($model->fullname);
        $customers->email = $model->email;
        $customers->phone = $model->phonenumber;
        $customers->status = 'ACTIVE';
        if($this->actionSignup($model->email)){
                if( $customers->save()){
                $apps = new Customeruseapps();
                $apps->order_id = $model->order_id;
                $apps->customer_id = $customers->id;
                $apps->companyname = strtoupper($model->companyname);
                $apps->orderplan = $model->orderplan;
                $apps->status = 'OPEN';            
                $apps->orderkey = $model->orderkey;   
                $apps->companycode = $this->getCompanyCode(6);
                if($apps->save()){
                    $model->status = "PROCESS";
                    $model->save();
                }
              }
         }else{
            throw new NotFoundHttpException('User Exist in Central Authentication');
        }
        return $this->redirect(['ordercust']);
    }
    public function actionActapps($id)
    { 
        $model = Customeruseapps::findOne($id);
        $dbMaster = MasterDatabase::findOne(['status'=>"AVAILABLE",'appcode'=>$model->orderPlan->appcode]);
        if ($dbMaster !== NULL){
             $dbMaster->status = "USED";
             if($dbMaster->save()){            
                    $model->status = "ACTIVE";
                    $model->dbname = $dbMaster->dbname;
                    $model->save();
                }     
        }else{
            throw new NotFoundHttpException('Database does not exist. Please retry again after few minutes');
        }
          
        return $this->redirect(['ordercust']);
    } 
    public function actionViewcust($id)
    {   
        if (! \Yii::$app->user->can('CloudAdmin')){return FALSE; }
        return $this->render('../customers/view', [
            'model' => $this->findCust($id),
        ]);
    }

   
    public function actionIndexcust()
    {   
        if (! \Yii::$app->user->can('CloudAdmin')){return FALSE; }
        $searchModel = new CustomersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('../customers/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexapps()
    {   
        if (! \Yii::$app->user->can('CloudAdmin')){return FALSE; }
        $searchModel = new CustomeruseappsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('../customers-apps/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    protected function actionSignup($email)
    {
        $model = new SignupForm();
        $model->username = $email;
        $model->email = $email;
        $model->password = 'Lentie1';
        if ($user = $model->signup()) {
            return true;
            }
        return false;
    }
    protected function getCompanyCode($lenght){
        $result = true;
        while ($result == true) {            
            $key = strtoupper(substr(sha1(rand()), 0, $lenght));
            if (Customers::findOne(['companycode'=>$key]) == null) {
                if(Customeruseapps::findOne(['companycode'=>$key]) == null){
                    $result = false;
                }
                
            }
        }
        return $key;
    }
     protected function findOrdercust($id)
    {
        
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findCust($id)
    {
        
        if (($model = Customers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

       
  
}