<?php

use yii\db\Migration;

class m160707_030621_add_params extends Migration
{
    public function up()
    {
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
