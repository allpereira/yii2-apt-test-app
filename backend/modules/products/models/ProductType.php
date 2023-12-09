<?php

namespace app\modules\products\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Product[] $products
 */
class ProductType extends \yii\db\ActiveRecord {
    
    public static function tableName() {
        return 'product_type';
    }

    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getProducts() {
        return $this->hasMany(Product::class, ['product_type_id' => 'id'])->inverseOf('productType');
    }
}
