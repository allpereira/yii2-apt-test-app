<?php

namespace backend\controllers;

use Yii;

use common\models\LoginForm;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        // 'roles' => ['@'],
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
    public function actions() {
        return ['error' => [ 'class' => 'yii\web\ErrorAction' ] ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $this->view->title = Yii::$app->name . ' | Página Inicial';

        return $this->render('index');
    }

    // Login Hiding
    
    // /**
    //  * Login action.
    //  *
    //  * @return string|Response
    //  */
    // public function actionLogin() {
    //     $this->view->title = Yii::$app->name . ' | Logado';

    //     if (!Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $this->layout = 'blank';

    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->goBack();
    //     }

    //     $model->password = '';

    //     return $this->render('login', [ 'model' => $model ]);
    // }

    // /**
    //  * Logout action.
    //  *
    //  * @return Response
    //  */
    // public function actionLogout() {
        
    //     Yii::$app->user->logout();

    //     return $this->goHome();
    // }
}
