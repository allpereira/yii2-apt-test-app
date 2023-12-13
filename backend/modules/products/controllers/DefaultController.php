<?php
namespace app\modules\products\controllers;

use yii\web\Controller;

/**
 * Default controller for the `products` module
 */
class DefaultController extends Controller {
    
    /**
     * Redirects to the index of the product 
     * @return string
     */
    public function actionIndex() {
        return $this->redirect('products/product/index');
    }
}
