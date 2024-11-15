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
       
        //формирование фильмов для афиши
        $filmModel = Film::find()
        ->limit(20)
        ->all();
        

         //формирование пользователя или покупателя
         $userContext = Yii::$app->user->identity;
         if($userContext === null)
         {
            return $this->render('index', [
                'catalogFilm' => $filmModel,
            ]);
         }
         $customer = Customer::find()->where(['id_user' => $userContext->id_user])->one();
         if($customer === null)
         {
             return $this->render('index', [
                'catalogFilm' => $filmModel,
            ]);
         }

        return $this->render('index', [
            'user' =>  $customer,
            'catalogFilm' => $filmModel,
        ]);
    }
    public function actionRegister(){
        $model = new RegForm();
        if($model->load(Yii::$app->request->post())){
            if($model->password == $model->confirmPassword){
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
            else{
              Yii::$app->session->setFlash('error', "Не совпадают пароли пользователя");
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
    public function actionLocation()
    {
        return $this->render('location');
    }
}
