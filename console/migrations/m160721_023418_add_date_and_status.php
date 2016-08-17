<?php

use yii\db\Migration;

class m160721_023418_add_date_and_status extends Migration
{
    public function up()
    {
        $this->addColumn( '{{%notification}}', 'created_at', $this->dateTime()->notNull() );
        $this->addColumn( '{{%notification}}', 'updated_at', $this->dateTime() );
        $this->addColumn( '{{%notification}}', 'status', $this->smallInteger()->notNull()->defaultValue(1) );

        $this->addColumn( '{{%user_card}}', 'created_at', $this->dateTime()->notNull() );
        $this->addColumn( '{{%user_card}}', 'updated_at', $this->dateTime() );
        $this->addColumn( '{{%user_card}}', 'status', $this->smallInteger()->notNull()->defaultValue(10) );
    }

    public function down()
    {
        $this->dropColumn( '{{%user_card}}', 'created_at' );
        $this->dropColumn( '{{%user_card}}', 'updated_at' );
        $this->dropColumn( '{{%user_card}}', 'status' );

        $this->dropColumn( '{{%notification}}', 'created_at' );
        $this->dropColumn( '{{%notification}}', 'updated_at' );
        $this->dropColumn( '{{%notification}}', 'status' );
    }
}
