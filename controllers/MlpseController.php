<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\MLpse;
use backend\models\MLpseSearch;
use backend\models\LpseDetail;
use backend\models\LpseDetailProfile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \DOMDocument; 
use \DOMXPath;
/**
 * MLpseController implements the CRUD actions for MLpse model.
 */
class MlpseController extends Controller
{


 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','create','update','view','grab',],
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
     * Lists all MLpse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MLpseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MLpse model.
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
     * Creates a new MLpse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MLpse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MLpse model.
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
     * Deletes an existing MLpse model.
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
     *
     */
    public function actionGrab($id)
    {
        $model= $this->findModel($id);
        $model->ed = date('Y-m-d H:i:s');
        $model->save();
        $list_data = $this->grab_data($model);

        foreach($list_data['name_lelang'] as $key => $val){
            foreach ($val as $k => $name){
                $data_lpse_detail = array(     
                        'edit_by'=>2,
                        'date_now'=>date('Y-m-d H:i:s'),
                        'lpse_id' => $id,                   
                        'name' => $name->nodeValue,
                        'orig_lpse_id' =>$model->id_lpse_inaproc,
                        'orig_lelang_id' => $list_data['id'][$key][$k],

                        '1' => $list_data['tahap'][$key][$k],
                        '2' => $this->convert_id($list_data['date_publish'][$key][$k]),
                        '3' => $this->convert_id($list_data['date_start_upload'][$key][$k]),
                        '4' => $this->convert_id($list_data['date_end_upload'][$key][$k]),
                        
                        '6' => $list_data['agenci'][$key][$k],
                        '7' => $list_data['budget'][$key][$k],
                        '8' => $list_data['url'][$key][$k], 
                        '9' => $id,                        
                        '10'=> $list_data['id'][$key][$k],
                        '11'=> $list_data['category'][$key][$k],

                 );
                  /*  status
                    date_publish
                    date_start_upload
                    Expired Date
                    lelang_name
                    lelang_agenci
                    Budget
                    lelang_url
                    lelang_lembaga
                    lelang_id
                    Category*/

                $model_details = LpseDetail::findOne(
                    ['lpse_id'=>$data_lpse_detail['lpse_id'],
                    'orig_lelang_id'=>$data_lpse_detail['orig_lelang_id']
                    ]);
                if(!$model_details){
                    $model_details = new LpseDetail();
                    $model_details->lpse_id         = $data_lpse_detail['lpse_id'];
                    $model_details->name            = $data_lpse_detail['name'];
                    $model_details->orig_lpse_id    = $data_lpse_detail['orig_lpse_id'];
                    $model_details->orig_lelang_id  = $data_lpse_detail['orig_lelang_id'];
                    $model_details->cd              = $data_lpse_detail['date_now'];
                    $model_details->cb              = $data_lpse_detail['edit_by'];
                }else{
                    $model_details->ed              = $data_lpse_detail['date_now'];
                    $model_details->eb              = $data_lpse_detail['edit_by'];
                }               
       
                if($model_details->save()){
                    echo ".";
                      $this->inputDetailProfile($model_details->id,$data_lpse_detail);
              }
              
            }
        }

    if(Yii::$app->request->referrer){
    return $this->redirect(Yii::$app->request->referrer);
        }else{
            return $this->goHome();
        }

    }

    /**
     * Finds the MLpse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MLpse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MLpse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function inputDetailProfile($lpse_detail_id,$data_lpse_detail){  
     foreach ($data_lpse_detail as $key => $value) {
        if( $key>0){

            $text_value = (!is_object($value))?$value:$value->nodeValue;
            $ModelLpseDetailProfile = LpseDetailProfile::findOne(
                [
                'lpse_detail_id'=>$lpse_detail_id,
                'profile_id'=>$key
                ]);
            if(!$ModelLpseDetailProfile ){
                $ModelLpseDetailProfile= new LpseDetailProfile();
                $ModelLpseDetailProfile->lpse_detail_id = $lpse_detail_id;
                $ModelLpseDetailProfile->profile_id = $key;
                $ModelLpseDetailProfile->cd = date('Y-m-d H:i:s');
                $ModelLpseDetailProfile->cb = '2';
                $ModelLpseDetailProfile->value = $text_value;
            }else{
                $ModelLpseDetailProfile->ed = date('Y-m-d H:i:s');
                $ModelLpseDetailProfile->eb = '2';
                $ModelLpseDetailProfile->value = $text_value;
            }

           $ModelLpseDetailProfile->save();
            echo ".";
            
         }
            
       }
            
    }
    protected function grab_data($val){
    
            libxml_use_internal_errors(true);
            $c = file_get_contents($val['link']);
            $d = new DomDocument();
            $d->loadHTML($c);
            $xp = new domxpath($d);
            $name_lelang = array();
            $no=1;
            echo "<pre>";

            foreach ($xp->query("//table[@class='t-data-grid']//tr/td[@class='pkt_nama']/b") as $el) {
                $name_lelang[$no]= $el;
                $no++;
            }
            $return['name_lelang'][$val['id']]= $name_lelang;
            
            $agenci = array();
            $no=1;
            foreach ($xp->query("//table[@class='t-data-grid']//tr/td[@class='agc_nama']") as $el) {
                $agenci[$no]= $el;
                $no++;
            }
            $return['agenci'][$val['id']] = $agenci;
            $tahap = array();
            $no=1;
            foreach ($xp->query("//table[@class='t-data-grid']//tr/td[@class='tahap']") as $el) {
                $tahap[$no]= $el;
                $no++;
            }
            $return['tahap'][$val['id']] = $tahap;
            $budget = array();
            $no=1;
            foreach ($xp->query("//table[@class='t-data-grid']//tr/td[@class='pkt_hps']") as $el) {
                $budget[$no]= $el;
                $no++;

            }
            $return['budget'][$val['id']] = $budget;

            $category = array();
            $no=1;
            foreach ($xp->query("//table[@class='t-data-grid']//tr/td[@class='pkt_nama']/div[@class='list']") as $el) {
                $xx = explode("Jenis Lelang:",$el->textContent);
                $category[$no]= str_replace("Kategori:", "", $xx[0]);
                $no++;
            }
            $return['category'][$val['id']] =$category;  

            $id = array();
            $url = array();
            $no=1;
            $ur = explode("/",$val['link']);
            $date_publish_ = array();
            $date_start_upload_ = array();
            $date_end_upload_ = array();
        
            foreach ($xp->query("//table[@class='t-data-grid']//tr/td[@class='pkt_nama']/b/a/@href") as $el) {
                $data = count(explode("/",$el->value));     
                $id[$no]= explode("/",$el->value)[$data-1];
                $url[$no]= $ur[0].'/'.$ur[1].'/'.$ur[2].$el->value;
                    $url_tahap = str_replace("view", 'tahap',$url);
                    $c_tahap = file_get_contents($url_tahap[1]);
                    $d_tahap = new DomDocument();
                    $d_tahap->loadHTML($c_tahap);
                    $xp_tahap = new domxpath($d_tahap);
                    $list_tahap = array();
                    $count_tr = $xp_tahap->query('//table[@class="border"]//tr');
                    for($i=1; $i<=$count_tr->length -1; $i++){
                        $as = $xp_tahap->query("//table[@class='border']//tr[$i]/td");
                        foreach ($as as $a) 
                        {
                            $list_tahap[$i][] = $a->nodeValue;
                        }
                    }
                    $date_publish_[$no] = $list_tahap[2][2];
                    foreach ($list_tahap as $thp_loop){ 
                        if($thp_loop[1] == "Upload Dokumen Penawaran"){
                            $date_start_upload_[$no] = $thp_loop[2];
                            $date_end_upload_[$no] = $thp_loop[3];
                        }
                    }
                            
                $no++;
            }
        
            $return['url'][$val['id']] = $url;
            $return['id'][$val['id']] = $id;
            $return['date_publish'][$val['id']] = $date_publish_;
            $return['date_start_upload'][$val['id']] = $date_start_upload_;
            $return['date_end_upload'][$val['id']] = $date_end_upload_;
            
            
            $pagging = array();
            $no=1;
            foreach ($xp->query("//div[@class='t-data-grid-pager']/a/@href") as $el){
                $pagging[$no]= $el->value;
                $no++;
            }
            $return['pagging'][$val['id']] = $pagging;        
          /*  if (!empty($return['pagging'])){
                if (isset($url[1])){
                    $this->pagging_data($return['pagging'], $url[1], $val['id']);                          
                }
            }*/
        
        return $return;
    }

protected function convert_id($date){
        $bln = explode(" ",$date);
    
        switch($bln[1])
        {
            case "Januari" : $namaBln = "01";
            break ;
            case "Pebruari" : $namaBln = "02";
            break ;
            case "Maret" : $namaBln = "03";
            break ;
            case "April" : $namaBln = "04";
            break ;
            case "Mei" : $namaBln = "05";
            break ;
            case "Juni" : $namaBln = "06";
            break ;
            case "Juli" : $namaBln = "07";
            break ;
            case "Agustus" : $namaBln = "08";
            break ;
            case "September" : $namaBln = "09";
            break ;
            case "Oktober" : $namaBln = "10";
            break ;
            case "Nopember" : $namaBln = "11";
            break ;
            case "Desember" : $namaBln = "12";
            break ;
            default : 
                $namaBln = "";
        }
    
        $date_new = $bln[2]."-".$namaBln.'-'.$bln[0];
        $date = date("Y-m-d",strtotime($date_new))." ".preg_replace("/&#?[a-z0-9]{2,8};/i","",htmlentities($bln[3])).":"."00";
        return $date;
        
        
    }   

}
