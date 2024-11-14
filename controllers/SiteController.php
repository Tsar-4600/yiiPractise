<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Customer;
use app\models\Film;
use app\models\RegForm;
use app\models\User;
use app\models\Session;



use Codeception\Lib\Interfaces\ActiveRecord;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
        $userContext = Yii::$app->user->identity;
        $customer = Customer::find()->where(['id_user' => $userContext->id_user])->one();
        return $this->render('index', [
            'user' =>  $customer,
        ]);
    }
    public function actionRegister(){
        $model = new RegForm();
        if($model->load(Yii::$app->request->post())){
            $userModel = new User();
            $userModel->username = $model->username;
            $userModel->password = $model->password;
            $userModel->id_role = $model->id_role;
            $userModel->accessToken = "asdsadadsadadadad";
            $userModel->authKey = "asdadsa21313222145";
            var_dump($userModel);
            if($userModel->save()){
                $customerModel = new Customer();
                $customerModel->id_user = $userModel->id_user;
                $customerModel->name = $model->name;
                $customerModel->surname = $model->surname;
                $customerModel->email = $model->email;
                $customerModel->telephone = $model->telephone;
                var_dump($customerModel);
                if($customerModel->save()){
                    Yii::$app->session->setFlash('success', 'Регистрация прошла успешно!');
                    return $this->redirect(['site/index']);
                }
                else{
                    echo "<br><br><br>Что-то пошло не так с записью customer";
                }
            }
            else{
                echo "<br><br><br>Что пошло не так с записью юзера";
            }
        }
       
        return $this->render('register.php', [
            'regData' => $model,
            
        ]);
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
    public function actionCatalog(){
        
        $filmModel = Film::find()
            // ->select(['Film.*', 'Genre.name AS genre_name'])
            ->limit(20)
            ->all();
        return $this->render('catalog', [
            'catalogfilm' => $filmModel,
        ]);
    }
}
