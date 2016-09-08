<?php

use yii\db\Migration;

class m160902_063257_create_oauth_access_token extends Migration
{ 
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%oauth_access_token}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'access_token' => $this->string(),
            'refresh_token' => $this->string(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%oauth_access_token}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
