<?php

use yii\db\Migration;

/**
 * Handles adding type_col to table `card`.
 */
class m160816_041954_add_type_col_to_card extends Migration
{
    /**
     * @inheritdoc
     */
     public function up()
    {
        $this->addColumn( '{{%card}}', 'type', $this->integer() );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn( '{{%card}}', 'type' );
    }
}
