<?php

namespace app\controllers;

use Yii;
use app\models\Tagliando;
use app\models\TagliandoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\extensions\FKUploadUtils;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * TagliandoController implements the CRUD actions for Tagliando model.
 */
class TagliandoController extends Controller
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
     * Lists all Tagliando models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagliandoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tagliando model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tagliando model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tagliando();

        if ($model->load(Yii::$app->request->post())) {

             /**
             * check wheter files are uploaded
             */
            $files  = UploadedFile::getInstances($model, "allegati");
            if(!empty($files)){
                $model= $this->manageUploadFiles($model, $files, "allegati");
            }

            // $model->created = date("Y-m-d H:i:s");
            $model->created = $model->convertDate($model->created);

            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
            else{
                print_r($model->getErrors());die;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tagliando model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->updated = date("Y-m-d H:i:s");
            
             /**
             * check wheter files are uploaded
             */
            $files  = UploadedFile::getInstances($model, "allegati");
            if(!empty($files)){
                $model= $this->manageUploadFiles($model, $files, "allegati");
            }
            
            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
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
        
        $path       = Yii::getAlias('@webroot')."/uploads/tagliandi/";
        
        $dirCreated = FileHelper::createDirectory($path);
        
        $inputFiles = [];
        foreach($files as $doc)
        {
            $filename           = $uploader->generateAndSaveFile($doc, $path);
            $inputFiles[]       = "uploads/tagliandi/".$filename;
        }
        
        $model->$field = json_encode($inputFiles);
        
        return $model;
    }//end of function


    /**
     * Deletes an existing Tagliando model.
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
     * Finds the Tagliando model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tagliando the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tagliando::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
