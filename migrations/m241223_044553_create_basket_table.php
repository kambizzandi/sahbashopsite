<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%basket}}`.
 */
class m241223_044553_create_basket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%basket}}', [
            'basket_id' => $this->primaryKey()->unsigned(),
            'basket_userId' => $this->integer()->unsigned()->notNull(),
            'basket_productId' => $this->integer()->unsigned()->notNull(),
            'basket_qty' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex(
            'idx-basket_userId',
            '{{%basket}}',
            'basket_userId'
        );

        $this->addForeignKey(
            'fk-basket_userId',
            '{{%basket}}',
            'basket_userId',
            '{{%user}}',
            'user_id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-basket_productId',
            '{{%basket}}',
            'basket_productId'
        );

        $this->addForeignKey(
            'fk-basket_productId',
            '{{%basket}}',
            'basket_productId',
            '{{%product}}',
            'product_id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%basket}}');
    }
}
