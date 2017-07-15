<?php

use yii\db\Migration;

class m160926_054951_add_is_push_col_to_notification extends Migration
{
    /**
     * @inheritdoc
     */
     public function up()
    {
        $this->addColumn( '{{%notification}}', 'is_push', $this->integer()->defaultValue(0) );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn( '{{%notification}}', 'is_push' );
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
