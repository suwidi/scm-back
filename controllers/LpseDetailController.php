<?php

namespace backend\controllers;

use Yii;
use backend\models\LpseDetail;
use backend\models\LpseDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
        $searchModel = new LpseDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        echo "data";die;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNormalize(){
        $model= LpseDetail::find()
                ->where(['<','budget',0])
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
