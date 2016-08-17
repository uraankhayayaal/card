<?php

use yii\db\Migration;

/**
 * Handles adding colm to table `usercard`.
 */
class m160711_070919_add_colm_to_usercard extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn( '{{%user_card}}', 'barCode', $this->string() );
        $this->addColumn( '{{%user_card}}', 'barFormatId', $this->integer() );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn( '{{%user_card}}', 'barCode' );
        $this->dropColumn( '{{%user_card}}', 'barFormatId' );
    }
}
