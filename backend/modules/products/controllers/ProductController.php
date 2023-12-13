<?php

namespace app\modules\products\controllers;

use Yii;
use app\modules\products\models\Product;
use Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex() {
        $this->view->title = 'Listagem de Produto';
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][] = $this->view->title;

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [ 'pageSize' => 50 ],
            'sort' => [
                'defaultOrder' => [ 'code' => SORT_DESC ] 
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
        $this->view->title = 'Visualizar Produto';
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][] = $this->view->title;

        return $this->render('view', [ 'model' => $this->findModel($id) ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Product();

        $this->view->title = 'Cadastrar Produto';
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][] = $this->view->title;
    
        if ($this->request->isPost) {

            if ($model->load($this->request->post()) && $model->save()) {
                Yii::debug('Product record was saved: '.$model->name, 'app\modules\products\controllers\ProductController::actionCreate');

                $model->file = UploadedFile::getInstance($model, 'file');

                try {
                    $model->checkOnCreate();
                } catch (Exception $e) {
                    $model->addError('file', $e->getMessage());
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [ 'model' => $model ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $this->view->title = "Editar Produto: $model->name";
        $this->view->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
        $this->view->params['breadcrumbs'][]  = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
        $this->view->params['breadcrumbs'][] = 'Editar Produto';

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [ 'model' => $model ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Não foi possível encontrar o produto.');
    }

}
