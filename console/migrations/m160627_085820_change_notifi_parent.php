<?php

use yii\db\Migration;

class m160627_085820_change_notifi_parent extends Migration
{
    public function up()
    {
        $this->dropForeignKey( 'FK_notification_card', 'notification');
        $this->dropIndex( 'FK_notification_card', 'notification');

        $this->dropColumn( '{{%notification}}', 'card_id' );
        $this->addColumn( '{{%notification}}', 'company_id', $this->integer() );

        $this->createIndex( 'FK_notification_company', 'notification', 'company_id');
        $this->addForeignKey( 'FK_notification_company', 'notification', 'company_id', 'company', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey( 'FK_notification_company', 'notification');
        $this->dropIndex( 'FK_notification_company', 'notification');

        $this->dropColumn( '{{%notification}}', 'company_id' );
        $this->addColumn( '{{%notification}}', 'card_id', $this->integer() );

        $this->createIndex( 'FK_notification_card', 'notification', 'card_id');
        $this->addForeignKey( 'FK_notification_card', 'notification', 'card_id', 'card', 'id', 'CASCADE', 'CASCADE');
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
