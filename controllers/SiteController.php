<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    //-----validacion de formularios con el modelo----------------------
    
    public function actionValidarformulario(){
        return $this->render('validarformulario');
    }

    //-----FORMULARIO----------------------------------------------
    //renderiza el formulario
    public function actionFormulario($mensaje = null){
        
        return $this->render('formulario',["mensaje"=>$mensaje]);
    }
    //ACCION REQUEST QUE HACE EL FORMULARIO AL HAHCER SUBMIT
    public function actionRequest(){

        $mensaje=null;
        if(isset($_REQUEST['nombre1'])){
            $nombre = $_REQUEST['nombre1'];
            $mensaje="bienvenido compare, ".$nombre;
        }

        $this->redirect(["site/formulario","mensaje"=>$mensaje]);
    }
    //----------------------------------------------------------------
    
    //----FUNCION DE PRUEBA SALUDAR--------------------------------------
    public function actionSaludar($gete = "obtenermos valor metido por parametro"){ //por parametro  osea si hacemos(http://localhost:8080/index.php?r=site%2Fsaludar&get=jaja) ahora $get sera "jaja"
        $nombres = "miguel";
        $datos  = array(10,11,12,13);
        return $this->render('saludar',["nombre"=>$nombres,"areglo"=>$datos,"get"=>$gete]);
    }
    //----------------------------------------------
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
        return $this->render('index');
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
}
