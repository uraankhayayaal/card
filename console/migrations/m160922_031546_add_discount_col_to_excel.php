<?php

use yii\db\Migration;

class m160922_031546_add_discount_col_to_excel extends Migration
{
    /**
     * @inheritdoc
     */
     public function up()
    {
        $this->addColumn( '{{%excel}}', 'discount', $this->integer() );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn( '{{%excel}}', 'discount' );
    }
}
