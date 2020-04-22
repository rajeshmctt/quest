<?php

use yii\db\Migration;

/**
 * Class m200420_141500_add_tables_for_quest
 */
class m200420_141500_add_tables_for_quest extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

		$this->createTable('category', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(255)',
			'description' => 'TEXT', 
			'status' => 'SMALLINT(6)', 
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL' 
        ]);
		$this->createTable('questionnaire', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255)',
            'description' => 'TEXT', 
            'category_id' => 'INT',
			'status' => 'SMALLINT(6)', 
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL'
        ]);
		$this->createTable('question', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255)',
            'questionnaire_id' => 'INT',
			'status' => 'SMALLINT(6)', 
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL'
        ]);
		$this->createTable('options', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255)',
            'question_id' => 'INT',
			'status' => 'SMALLINT(6)', 
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL'
        ]);
		$this->addForeignKey('fk_qstre_cat', 'questionnaire', 'category_id', 'category', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_question_qstre', 'question', 'questionnaire_id', 'questionnaire', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_option_question', 'options', 'question_id', 'question', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200420_141500_add_tables_for_quest cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200420_141500_add_tables_for_quest cannot be reverted.\n";

        return false;
    }
    */
}
