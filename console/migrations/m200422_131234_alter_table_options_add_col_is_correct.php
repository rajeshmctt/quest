<?php

use yii\db\Migration;

/**
 * Class m200422_131234_alter_table_options_add_col_is_correct
 */
class m200422_131234_alter_table_options_add_col_is_correct extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('options', 'is_correct', 'INT(11) AFTER question_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200422_131234_alter_table_options_add_col_is_correct cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200422_131234_alter_table_options_add_col_is_correct cannot be reverted.\n";

        return false;
    }
    */
}
