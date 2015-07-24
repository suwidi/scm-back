<?php

namespace backend\controllers;

use Yii;
use backend\models\LpseDetail;
use backend\models\LpseDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
/**
 * LpseDetailController implements the CRUD actions for LpseDetail model.
 */
class LpseDetailController extends Controller
{
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['normalize','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all LpseDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
               
    $command = Yii::$app->db->createCommand("SELECT t1.`lpse_id`,t2.`name`,  
        SUM(IF (t1.`last_status` NOT LIKE '%Selesai',1,0)) AS 'activetotal',
        SUM(IF (t1.`last_status` NOT LIKE '%Selesai',budget,0)) AS 'activebudget',
        count(*) AS total, sum(`budget`) AS budget
        FROM  lpse_detail t1
        INNER JOIN m_lpse t2 ON t2.id = t1.lpse_id
        GROUP BY t1.lpse_id");
        $dataStatistic = $command->queryAll(); 
        
        // tersedia  90.000 lelang active (M) dari 9000 (M) keseluruhan lelang
        // statistic saat ini (total, anggaran) (active, total, anggaran),(active, total, anggaran)
        // pertumbuhan data baru tiap tanggal
        //
        $dataProvider = new ArrayDataProvider([
                'allModels' => $dataStatistic,
                
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNormalize(){
        $model= LpseDetail::find()
                ->where(['is','budget',null])
                ->limit(10000)
                ->all();
        foreach ($model as $key => $value) {
            $dataProfile = $value->lpseDetailProfiles;
            foreach ($dataProfile as $k => $v) {
               if($v->profile_id==1){
                $value->last_status = $v->value;  
               }
               if($v->profile_id==4){
                $value->expired = $v->value;    
               }
               if($v->profile_id==7){
                $budget = trim($v->value);             
                $new_budget = explode(' ',$budget);
                $factor = ($new_budget[1]=="M")?1000000000:1000000;
                $number_budget = str_replace(",",".",$new_budget[0]);              
                $budget = floatval($number_budget*$factor);
                $value->budget = $budget;    
               }
               /*if($v->profile_id==11){
                $value->category = $v->value;          
               }  */  
            }
            echo ".";
            $value->save();
           // die;
        }

    }
    /**
     * Displays a single LpseDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LpseDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LpseDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LpseDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LpseDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the LpseDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LpseDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LpseDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
