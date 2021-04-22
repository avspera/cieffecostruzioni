<?php

namespace app\controllers;

use Yii;
use app\models\Automezzo;
use app\models\AutomezzoSearch;
use app\models\TagliandoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AutomezzoController implements the CRUD actions for Automezzo model.
 */
class AutomezzoController extends Controller
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
                            'check-targa'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Automezzo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AutomezzoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ["data_scadenza_assicurazione" => SORT_ASC];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCheckTarga(){
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $automezzo = Automezzo::find()->where(["targa" => $data["targa"]])->exists();
            $out = [
                "status" => $automezzo ?  "200" : "100"
            ];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $out;
        }
    }
    
    /**
     * used in sessione/index search form
     */
    public function actionSearch($q = null){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => []];
        if (!is_null($q)) {
            $automezzi   = Automezzo::find()->select(["id", "modello", "targa"])->where(["like", "targa", $q])->limit(20)->all();
            $results    = [];
            foreach($automezzi as $item){
                $results["id"] = $item->id;
                $results["text"] = $item->modello." - ".$item->targa;     
            }
            $out['results'][] = $results;
        }
        else if($id > 0){
            $out['results'] = ['id' => $id, 'text' => Automezzo::find($id)->modello];
        }
        return $out;  
    }

    /**
     * Displays a single Automezzo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $tagliandoSearch = new TagliandoSearch();
        $tagliandoSearch->id_automezzo = $id;

        $tagliandi = $tagliandoSearch->search([]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'tagliandi' => $tagliandi,
            'tagliandoSearch' => $tagliandoSearch
        ]);
    }

    /**
     * Creates a new Automezzo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Automezzo();

        if ($model->load(Yii::$app->request->post())) {
            $model->created = date("Y-m-d H:i:s");
            $model->data_immatricolazione = $model->convertDate($model->data_immatricolazione);
            $model->data_ultimo_rinnovo_assicurazione = $model->convertDate($model->data_ultimo_rinnovo_assicurazione);
            $model->data_scadenza_assicurazione = $model->convertDate($model->data_scadenza_assicurazione);
            $model->data_ultima_revisione = $model->convertDate($model->data_ultima_revisione);
            $model->data_prossima_revisione = $model->convertDate($model->data_prossima_revisione);

            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Automezzo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Automezzo model.
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
     * Finds the Automezzo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Automezzo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Automezzo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
