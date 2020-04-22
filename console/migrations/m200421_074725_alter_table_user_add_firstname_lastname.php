<?php

use yii\db\Migration;

/**
 * Class m200421_074725_alter_table_user_add_firstname_lastname
 */
class m200421_074725_alter_table_user_add_firstname_lastname extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'first_name', 'VARCHAR(255) AFTER email');
        $this->addColumn('user', 'last_name', 'VARCHAR(255) AFTER first_name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200421_074725_alter_table_user_add_firstname_lastname cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200421_074725_alter_table_user_add_firstname_lastname cannot be reverted.\n";

        return false;
    }
    */
}
