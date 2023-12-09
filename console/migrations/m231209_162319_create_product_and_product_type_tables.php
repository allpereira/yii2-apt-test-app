<?php
use yii\db\Migration;

/**
 * Class m231209_162319_create_product_and_product_type_tables
 * 
 * This migration class is responsible for managing Product and Product Type tables.
 * 
 */
class m231209_162319_create_product_and_product_type_tables extends Migration {
    
    public function safeUp() {

        // Creates a Product Type table
        $this->createTable('product_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // Creates a Product table
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'file_path' => $this->string(),
            'product_type_id' => $this->integer(),
        ]);

        // Adiciona a chave estrangeira para a relação Many-to-One
        $this->addForeignKey(
            'fk-product-product_type',
            'product',
            'product_type_id',
            'product_type',
            'id',
            'SET NULL',
            'CASCADE'
        );

    }

    public function safeDown() {

        // Remove foreing keys
        $this->dropForeignKey('fk-product-product_type', 'product');

        // Remove tables
        $this->dropTable('product');
        $this->dropTable('product_type');

    }
}