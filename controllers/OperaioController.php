<?php

namespace app\controllers;

use Yii;
use app\models\Operaio;
use app\models\OperaioSearch;
use app\models\AccessoriSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\extensions\FKUploadUtils; 
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\db\Query;

/**
 * OperaioController implements the CRUD actions for Operaio model.
 */
class OperaioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index', 
                            'create', 
                            'view', 
                            'update', 
                            'delete',
                            'search',
                            'generate-pdf',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Operaio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OperaioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ["cognome" => SORT_ASC];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Operaio model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $accessoriModel = new AccessoriSearch();
        $accessoriModel->id_operaio = $id;
        $accessori = $accessoriModel->search([]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'accessori' => $accessori,
            'accessoriModel' => $accessoriModel
        ]);
    }

    /**
     * Creates a new Operaio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Operaio();

        if ($model->load(Yii::$app->request->post())) {
            $model->created = date("Y-m-d H:i:s");
            
            /**
             * check wheter files are uploaded
             */
            $files  = UploadedFile::getInstances($model, "codice_fiscale");
            if(!empty($files)){
                $model= $this->manageUploadFiles($model, $files, "codice_fiscale");
            }
            else{
                $model->codice_fiscale = "";
            }

            $files  = UploadedFile::getInstances($model, "documento_identita");
            if(!empty($files)){
                $model= $this->manageUploadFiles($model, $files, "documento_identita");
            }
            else{
                $model->documento_identita = "";
            }
            /**
             * end of file check
             */
             
            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * check each uploaded media in form.
     * if !empty, upload to server
     * path is: /uploads/automezzo_id/*
     */
    protected function manageUploadFiles($model, $files, $field) {
        
        $uploader   = new FKUploadUtils();
        
        $path       = Yii::getAlias('@webroot')."/uploads/dipendenti/";
        
        $dirCreated = FileHelper::createDirectory($path);
        
        $inputFiles = [];
        foreach($files as $doc)
        {
            $filename           = $uploader->generateAndSaveFile($doc, $path);
            $inputFiles[]       = "uploads/dipendenti/".$filename;
        }
        
        $model->$field = json_encode($inputFiles);
        
        return $model;
    }//end of function

    /**
     * Updates an existing Operaio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

             /**
             * check wheter files are uploaded
             */
            $files  = UploadedFile::getInstances($model, "codice_fiscale");
            if(!empty($files)){
                $model= $this->manageUploadFiles($model, $files, "codice_fiscale");
            }

            $files  = UploadedFile::getInstances($model, "documento_identita");
            if(!empty($files)){
                $model= $this->manageUploadFiles($model, $files, "documento_identita");
            }

            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSearch($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            // $query->select('id AS id, CONCAT(nome, cognome) AS text')
            //     ->from('operaio')
            //     ->where(['like', 'cognome', $q])
            //     ->limit(20);
                
            $data = Yii::$app->db->createCommand("SELECT `id` AS id, CONCAT(`nome`, ' ', `cognome`) as text FROM `operaio` WHERE `cognome` LIKE '%{$q}%' LIMIT 20")->queryAll();
            
            $out['results'] = array_values($data);
        }
        else if($id > 0){
            $operaio    = Operaio::find()->select(["nome", "cognome"])->where(["id" => $id])->one();
            $text       = !empty($operaio) ? $operaio->nome." ".$operaio->cognome : "";
            $out['results'] = ['id' => $id, 'text' => $text];
        }
        
        return $out;
    }

    /**
     * Deletes an existing Operaio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Operaio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Operaio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Operaio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
