<?php

namespace app\controllers;

use Yii;
use app\models\CategoriaAccessori;
use app\models\Accessori;
use app\models\CategoriaAccessoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CategoriaAccessoriController implements the CRUD actions for CategoriaAccessori model.
 */
class CategoriaAccessoriController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'login',
                        ],
                        'allow' => true,
                        'allow' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'get-costo-singolo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all CategoriaAccessori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaAccessoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoriaAccessori model.
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


    public function actionGetCostoSingolo(){
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $costo_singolo = CategoriaAccessori::find()
                                ->select(["costo_con_iva"])
                                ->where(["id" => $data["oggetto"]])
                                ->one();
            
            $out = [
                "status" => !empty($costo_singolo) ?  "200" : "100",
                "costo_singolo" => !empty($costo_singolo->costo_con_iva) ? $costo_singolo->costo_con_iva : 0
            ];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $out;
        }
    }

    /**
     * Creates a new CategoriaAccessori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoriaAccessori();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoriaAccessori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldCosto = $model->costo;
        $oldCostoConIva = $model->costo_con_iva;
        
        if ($model->load(Yii::$app->request->post())) {
            /**
             * updates each accessorio costo totale 
             * based on new provided costo
             */
            if($model->costo && $model->costo_con_iva)
            {
                if($oldCosto != $model->costo || $oldCostoConIva != $model->costo_con_iva){
                    $accessori = Accessori::findAll(["oggetto" => $model->id]);
                    foreach($accessori as $accessorio){
                        $accessorio->costo_totale = $model->costo_con_iva * $accessorio->quantita;
                        $accessorio->save();
                    }
                }
            } 
            if($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoriaAccessori model.
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
     * Finds the CategoriaAccessori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoriaAccessori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoriaAccessori::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
