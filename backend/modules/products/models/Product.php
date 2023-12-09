<?php

namespace app\modules\products\models;

use Exception;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $file_path
 * @property int|null $product_type_id
 *
 * @property ProductType $productType
 */
class Product extends \yii\db\ActiveRecord {

    public $file;

    public static function tableName() {
        return 'product';
    }


    public function rules() {
        return [
            [['product_type_id'], 'integer'],
            [['file_path'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 20, 'message' => 'O campo {attribute} deve ter menos do que 20 caracteres.'],
            ['name', 'string', 'max' => 50, 'message' => 'O campo {attribute} deve ter menos do que 50 caracteres.'],
            [['code', 'name'], 'required', 'message' => 'O campo {attribute} é obrigatório.'],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::class, 'targetAttribute' => ['product_type_id' => 'id']],
            [['file'], 'file', 'skipOnEmpty' => true ],
            [['file'], 'file', 'extensions' => 'gif, jpg, png, jpeg'],
            // [['file'], 'file', 'maxSize' => 1024 * 1024],
        ];
    }


    public function attributeLabels() {
        return [
            'id' => 'ID',
            'code' => 'Código',
            'name' => 'Nome / Descrição',
            'file' => 'Foto / Imagem',
            'file_path' => 'Caminho do Arquivo',
            'product_type_id' => 'Tipo de Produto',
        ];
    }

    /**
     * Gets query for [[ProductType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductType() {
        return $this->hasOne(ProductType::class, ['id' => 'product_type_id'])->inverseOf('products');
    }

    public function checkOnCreate() {
        
        if($this->file) {
            
            $uploadPath = Yii::getAlias('@productsUploads') .DIRECTORY_SEPARATOR. $this->id;
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true); 
            } 

            $this->file_path = $uploadPath .DIRECTORY_SEPARATOR. $this->file->baseName .'.'. $this->file->extension;
            if($this->file->saveAs($this->file_path)) {
                $this->save(false);
            }

        } else {
            throw new Exception('Nenhum arquivo foi selecionado.');
        }

    }

}
