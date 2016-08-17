<?php

use yii\db\Migration;

class m160705_010721_gtoken extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('gtoken', [
            'id' => $this->primaryKey(),
            'value' => $this->string()->notNull(),
            'os' => $this->integer(2)->notNull(),
            'user_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex( 'FK_gtoken_user', 'gtoken', 'user_id');
        $this->addForeignKey( 'FK_gtoken_user', 'gtoken', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey( 'FK_gtoken_user', 'gtoken');
        $this->dropIndex( 'FK_gtoken_user', 'gtoken');
        
        $this->dropTable('gtoken');
    }
}
