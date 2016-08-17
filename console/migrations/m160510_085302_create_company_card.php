<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_card`.
 */
class m160510_085302_create_company_card extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('card', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'path' => $this->string(),
            'company_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('FK_card_company', '{{%card}}', 'company_id');
        $this->addForeignKey(
            'FK_card_company', '{{%card}}', 'company_id', '{{%company}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company_card');
    }
}