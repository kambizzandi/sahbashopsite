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
            'basket_totalPrice' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createTable('{{%basket_item}}', [
            'basketItem_id' => $this->primaryKey()->unsigned(),
            'basketItem_basketId' => $this->integer()->unsigned()->notNull(),
            'basketItem_productId' => $this->integer()->unsigned()->notNull(),
            'basketItem_qty' => $this->integer()->unsigned()->notNull(),
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
            'idx-basketItem_basketId',
            '{{%basket_item}}',
            'basketItem_basketId'
        );

        $this->addForeignKey(
            'fk-basketItem_basketId',
            '{{%basket_item}}',
            'basketItem_basketId',
            '{{%basket}}',
            'basket_id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-basketItem_productId',
            '{{%basket_item}}',
            'basketItem_productId'
        );

        $this->addForeignKey(
            'fk-basketItem_productId',
            '{{%basket_item}}',
            'basketItem_productId',
            '{{%product}}',
            'product_id',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-basketItem_productId',
            '{{%basket_item}}'
        );

        $this->dropIndex(
            'idx-basketItem_productId',
            '{{%basket_item}}'
        );

        $this->dropForeignKey(
            'fk-basketItem_basketId',
            '{{%basket_item}}'
        );

        $this->dropIndex(
            'idx-basketItem_basketId',
            '{{%basket_item}}'
        );

        $this->dropForeignKey(
            'fk-basket_userId',
            '{{%basket}}'
        );

        $this->dropIndex(
            'idx-basket_userId',
            '{{%basket}}'
        );

        $this->dropTable('{{%basket}}');
    }
}
