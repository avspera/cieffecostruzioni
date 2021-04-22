<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\AutomezzoSearch;
use app\models\Automezzo;
use app\models\Accessori;
use app\models\CategoriaAccessori;
use app\models\Tagliando;
use app\models\Operaio;

class SiteController extends Controller
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
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
            return $this->redirect(["login"]);

        $searchModel = new AutomezzoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ["created" => SORT_DESC];

        $today      = date("Y-m-d H:i:s");
        $maxRange   = date('Y-m-d H:i:s', strtotime($today . ' +10 day'));
        
        $scadenzaAss = Automezzo::find()
                    ->select(["id", "marca", "modello", "targa", "data_scadenza_assicurazione"])
                    ->where([">", "data_scadenza_assicurazione", $today])
                    ->andWhere(["<=", "data_scadenza_assicurazione", $maxRange])
                    ->all();
    
        $scadenzaRevisione = Automezzo::find()
                        ->select(["id", "marca", "modello", "targa", "data_prossima_revisione"])
                        ->where([">", "data_prossima_revisione", $today])
                        ->andWhere(["<=", "data_prossima_revisione", $maxRange])
                        ->all();


        $accessori      = Accessori::find()->select(["id", "oggetto"])->groupBy(["id", "oggetto"])->count();
        $categorieAccessori = CategoriaAccessori::find()->orderBy(["nome" => SORT_ASC])->all();
        
        $tagliandiCount = Tagliando::find()->count();

        $operaiCount    = Operaio::find()->count();
        $operai         = Operaio::find()->orderBy(["created" => SORT_DESC])->all(); 
        
        return $this->render('index', [
                'automezzi'         => $dataProvider, 
                'automezzoSearch'   => $searchModel,
                'accessori'         => $accessori,
                'categorieAccessori' => $categorieAccessori,
                'tagliandiCount'    => $tagliandiCount,
                'operaiCount'       => $operaiCount,
                'scadenzaAss'       => $scadenzaAss,
                'scadenzaRevisione' => $scadenzaRevisione,
                'operai'           => $operai
            ]
        );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = "main-login";
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
