<?php

use yii\db\Migration;

/**
 * Handles the creation for table `notification`.
 */
class m160510_091035_create_notification extends Migration
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

        $this->createTable('notification', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'card_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex( 'FK_notification_card', 'notification', 'card_id');
        $this->addForeignKey( 'FK_notification_card', 'notification', 'card_id', 'card', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey( 'FK_notification_card', 'notification');
        $this->dropIndex( 'FK_notification_card', 'notification');
        
        $this->dropTable('notification');
    }
}
