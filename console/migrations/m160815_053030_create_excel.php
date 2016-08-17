<?php

use yii\db\Migration;

/**
 * Handles the creation for table `excel`.
 */
class m160815_053030_create_excel extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%excel}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'card_number' => $this->string()->notNull(),
            'description' => $this->string(),
            'user_id' => $this->integer(),

        ], $tableOptions);

        $this->createIndex( 'FK_user_excel', '{{%excel}}', 'user_id');
        $this->addForeignKey( 'FK_user_excel', '{{%excel}}', 'user_id', '{{%user}}', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey( 'FK_user_excel', '{{%excel}}');
        $this->dropIndex( 'FK_user_excel', '{{%excel}}');

        $this->dropTable('excel');
    }
}
