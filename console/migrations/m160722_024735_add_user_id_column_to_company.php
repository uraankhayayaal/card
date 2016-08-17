<?php

use yii\db\Migration;

/**
 * Handles adding user_id_column to table `company`.
 */
class m160722_024735_add_user_id_column_to_company extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn( '{{%company}}', 'user_id', $this->integer() );

        $this->createIndex( 'FK_company_user', '{{%company}}', 'user_id');
        $this->addForeignKey( 'FK_company_user', '{{%company}}', 'user_id', '{{%user}}', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey( 'FK_company_user', '{{%company}}');
        $this->dropIndex( 'FK_company_user', '{{%company}}');

        $this->dropColumn( '{{%company}}', 'user_id' );
    }
}
