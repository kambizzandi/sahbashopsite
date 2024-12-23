<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m241222_170302_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'user_id' => $this->primaryKey()->unsigned(),
            'user_email' => $this->string(128)->notNull()->unique(),
            'user_passwordHash' => $this->string(128)->notNull(),
            'user_firstName' => $this->string(64)->null(),
            'user_lastName' => $this->string(64)->null(),
            'user_isAdmin' => $this->boolean()->notNull()->defaultValue(false),
        ]);

        $this->insert('{{%user}}', [
            'user_email' => 'admin',
            'user_passwordHash' => Yii::$app->security->generatePasswordHash('admin'),
            'user_firstName' => 'admin',
            'user_lastName' => 'admin',
            'user_isAdmin' => true,
        ]);

        $this->insert('{{%user}}', [
            'user_email' => 'user',
            'user_passwordHash' => Yii::$app->security->generatePasswordHash('user'),
            'user_firstName' => 'user',
            'user_lastName' => 'user',
            'user_isAdmin' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
