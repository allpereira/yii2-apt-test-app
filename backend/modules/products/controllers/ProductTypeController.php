<?php

namespace app\modules\products\controllers;

use Yii;
use app\modules\products\models\ProductType;
use Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * ProductTypeController implements the CRUD actions for ProductType model
 */
class ProductTypeController extends Controller {
    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [ 'delete' => ['POST'], ],
                ],
            ]
        );
    }

    /**
     * Lists all ProductType models.
     *
     * @return string
     */
    public function actionIndex() {
        $this->view->title = 'Listagem de Tipos de Produtos';
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['/products/product']];
        $this->view->params['breadcrumbs'][] = ['label' => 'Tipos de Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][] = $this->view->title;

        $dataProvider = new ActiveDataProvider([
            'query' => ProductType::find(),
            'pagination' => [ 'pageSize' => 50 ],
            'sort' => [
                'defaultOrder' => [ 'name' => SORT_DESC ] 
            ],
        
        ]);

        return $this->render('index', [ 'dataProvider' => $dataProvider ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $this->view->title = 'Visualizar Tipo de Produto';
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['/products/product']];
        $this->view->params['breadcrumbs'][] = ['label' => 'Tipos de Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][] = $this->view->title;

        return $this->render('view', [ 'model' => $this->findModel($id) ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new ProductType();

        $this->view->title = 'Cadastrar Tipo de Produto';
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['/products/product']];
        $this->view->params['breadcrumbs'][] = ['label' => 'Tipos de Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][] = $this->view->title;
    
        if ($this->request->isPost) {

            if ($model->load($this->request->post()) && $model->save()) {
                Yii::debug('Product Type record was saved: '.$model->name, 'app\modules\products\controllers\ProductTypeController::actionCreate');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [ 'model' => $model ]);
    }

    /**
     * Updates an existing ProductType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $this->view->title = "Editar Tipo de Produto: $model->name";
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['/products/product']];
        $this->view->params['breadcrumbs'][] = ['label' => 'Tipos de Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][]  = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
        $this->view->params['breadcrumbs'][] = 'Editar Produto';

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [ 'model' => $model ]);
    }

    /**
     * Deletes an existing ProductType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
            
        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProductType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductType::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
