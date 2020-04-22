<?php

use yii\db\Migration;

/**
 * Class m200420_135009_insert_record_for_super_admin
 */
class m200420_135009_insert_record_for_super_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $time = time();
		$this->insert('user',array(
         'username'=>'admin',
         'auth_key'=>'Chkmx-mYmIp6WYvTjIxEcXSPxawEMbH8',
         'password_hash'=>'$2y$13$eA0JQAI5cQz5L1J1dGh8Xes.R10A6dcfrpC/9VuuH03NbumLf7xgK',
		 'email' => 'info@coachtotransformation.com',
         'created_at' => $time,
         'updated_at' => $time,
		));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200420_135009_insert_record_for_super_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_135009_insert_record_for_super_admin cannot be reverted.\n";

        return false;
    }
    */
}
