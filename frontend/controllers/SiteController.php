<?php

namespace frontend\controllers;

use app\models\Parametros;
use common\models\Articulos;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Productos;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\UtilServices;
use PhpMyAdmin\Twig\UtilExtension;
use \Statickidz\GoogleTranslate;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public const TITULO_PRODUCTOS ='Explore';
    public const SUBTITULO_PRODUCTOS = 'The most interesting items in technology these days';
    public const SUBTITULO_PRODUCTOS_GRID = "Today's Choice";
    public const ACTUAL_LENGUAJE = 'English';
    public static $ACTUAL_VIEW = 'none';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {      
        //return Yii::$app->response->redirect(['frontend/web/site/productos']); 
        //return Yii::$app->response->redirect(['site/productos']); 
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        self::$ACTUAL_VIEW = 'contact';

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        $title = 'About Us';
        $paragraph = 'BitAdvice is a site focused on sharing the most interesting stuff that you can buy online. We are constantly searching
        for cool things online so that you can see them all in one place.<br><br>The products listed on this site may receive a commission for product referral, this is a small help to keep BitAdvice
        as cool as always, but this is not the main motivation, our goal is to create a helpful place where people can find items
        for their needs. We appreciate your visit to our web site and hope we see you around again. <br> <br> Joel Males';
        $title2 = 'Contact Us';
        $paragraph2 = 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.';

        return $this->render('contact', [
            'model' => $model,
            'title' => $title,
            'paragraph' => $paragraph,
            'title2' => $title2,
            'paragraph2' => $paragraph2
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        self::$ACTUAL_VIEW = 'about';
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionOffline(){
        echo 'You are not connected to Internet';
    }

    public function actionArticle(){

        self::$ACTUAL_VIEW = 'article';
        $id = $_GET['id'];
        $model = Articulos::findOne(['id' => $id]);
        $dataArticulos = Articulos::find()->all();

        if(sizeof($dataArticulos) > 1){ //Gets the next article

            foreach($dataArticulos as $articulo){
                if($articulo->id != $model->id){
                    $nextArticle = $articulo;
                }
            }

            return $this->render('article',[
                'model' => $model,
                'nextArticle' => $nextArticle,
            ]);
        }


        return $this->render('article',[
            'model' => $model
        ]);

    }

    public function actionSearch(){
        self::$ACTUAL_VIEW = 'productos';
        $query = $_GET['query'];

        // to use sql queries
        // $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$query."%'";
        // $dataSql = Productos::findBySql($sql)->all();

        UtilServices::getEbayProductData();
        $data = Productos::find()->all();
        $dataArticulos = Articulos::find()->all();

        
        $dataProductos = [];
        foreach($data as $product) {
            if (str_contains(strtolower($product["nombre"]), strtolower($query))){
                array_push($dataProductos, $product);
            }
        }

        return $this->render('productos',[
            'data' => $dataProductos,
            'dataArticulos' => $dataArticulos,
            'titulo' => self::TITULO_PRODUCTOS,
            'subtitulo' =>  self::SUBTITULO_PRODUCTOS,
            'subtituloProducto' => self::SUBTITULO_PRODUCTOS_GRID
        ]);

    }

    public function actionFilterProduct(){
        $category = $_GET['category'];
        self::$ACTUAL_VIEW = 'productos';

        $items = UtilServices::getEbayProductData();
        $data = Productos::find()->all();

        $dataProductos = [];
        foreach($data as $product) {
            if (in_array($category, explode(',',$product["categoria"]))){
                array_push($dataProductos, $product);
            }
        }

        $dataArticulos = Articulos::find()->all();

        return $this->render('productos',[
            'data' => $dataProductos,
            'dataArticulos' => $dataArticulos,
            'titulo' => self::TITULO_PRODUCTOS,
            'subtitulo' =>  self::SUBTITULO_PRODUCTOS,
            'subtituloProducto' => self::SUBTITULO_PRODUCTOS_GRID
        ]);
    }

    /**
     * Action to display the main products page
     */
    public function actionProductos(){

        // $data = UtilServices::getEbayProductData();  
        // return json_encode($data); 
        $items = Productos::find()->all();
        self::$ACTUAL_VIEW = 'productos';

        $dataArticulos = Articulos::find()->all();
        
        return $this->render('productos',[
            'data' => $items,
            'dataArticulos' => $dataArticulos,
            'titulo' => self::TITULO_PRODUCTOS,
            'subtitulo' =>  self::SUBTITULO_PRODUCTOS,
            'subtituloProducto' => self::SUBTITULO_PRODUCTOS_GRID
        ]);        
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTranslatedView(){

        self::$ACTUAL_VIEW = $_GET['view'];
        $target = $_GET['target'];
        $id = $_GET['id'];

        $params = UtilServices::translateByView($target, self::$ACTUAL_VIEW, $id, self::TITULO_PRODUCTOS, self::SUBTITULO_PRODUCTOS);

        return $this->render(self::$ACTUAL_VIEW, $params);

    }

}
