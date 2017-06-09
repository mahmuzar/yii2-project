<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\common\model\User;
use app\common\components\AccessRule;
use app\models\CreateCategoryForm;
use app\models\AddProduct;
use app\models\Categoryes;
use app\models\ProductFilter;

class SiteController extends Controller {

    /**
     *
     * @var Categoryes
     */
    private $categoryes;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        // Allow admins to delete
                        'roles' => [
                            User::ROLE_ADMIN
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
    public function actions() {
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

    function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->categoryes = new Categoryes();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        
        //var_dump(Yii::$app->user);
        $model = new ProductFilter();
        $data = $this->categoryes->findAll();
        $data = \yii\helpers\ArrayHelper::map($data, 'id', 'name');
        return $this->render('index', ['model' => $model, 'data' => $data]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
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
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionCreateCategory() {
        $data = Yii::$app->request->post();
        $model = new CreateCategoryForm();
        
        if ($model->load($data)&&$model->create()) {
            Yii::$app->session->setFlash('postFormSabmited');
            return $this->refresh();
        }
        return $this->render('createCategory', ['model' => $model]);
    }

    public function actionAddProduct() {
        $model = new AddProduct();
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = \yii\web\UploadedFile::getInstances($model, 'imageFiles');
            $model->upload();
            Yii::$app->session->setFlash('postFormSabmited');
            //var_dump($model);
            //var_dump();
            return $this->refresh();
        }

        $data = $this->categoryes->findAll();
        $data = \yii\helpers\ArrayHelper::map($data, 'id', 'name');
        return $this->render('addProduct', ['model' => $model, 'data' => $data]);
    }

    public function actionDelete() {
        return $this->render('delete');
    }

}
