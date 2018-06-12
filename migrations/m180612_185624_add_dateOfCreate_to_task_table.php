<?php

use yii\db\Migration;

/**
 * Class m180612_185624_add_dateOfCreate_to_task_table
 */
class m180612_185624_add_dateOfCreate_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'date_of_create', $this->dateTime());
        $this->addColumn('task', 'date_of_update', $this->dateTime());
        $this->addColumn('user', 'date_of_create', $this->dateTime());
        $this->addColumn('user', 'date_of_update', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180612_185624_add_dateOfCreate_to_task_table cannot be reverted.\n";

        $this->dropColumn('task', 'date_of_create');
        $this->dropColumn('task', 'date_of_update');
        $this->dropColumn('user', 'date_of_create');
        $this->dropColumn('user', 'date_of_update');

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180612_185624_add_dateOfCreate_to_task_table cannot be reverted.\n";

        return false;
    }
    */
}
