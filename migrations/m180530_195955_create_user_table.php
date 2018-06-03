<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180530_195955_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string(60)->notNull(),
            'password' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'role_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
