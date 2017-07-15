<?php

use yii\db\Migration;

class m160707_030621_add_params extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'value' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_address_company', '{{%address}}', 'company_id');
        $this->addForeignKey(
            'FK_address_company', '{{%address}}', 'company_id', '{{%company}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey( 'FK_address_company', '{{%address}}');
        $this->dropIndex( 'FK_address_company', '{{%address}}');

        $this->dropTable('{{%address}}');
    }
}
