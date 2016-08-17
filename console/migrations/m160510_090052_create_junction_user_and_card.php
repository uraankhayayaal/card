<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_card`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `card`
 */
class m160510_090052_create_junction_user_and_card extends Migration
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

        $this->createTable('user_card', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'card_id' => $this->integer()->notNull(),
            'number' => $this->string(),
            'description' => $this->string(),
        ], $tableOptions);

        $this->createIndex( 'FK_user_card', 'user_card', 'user_id');
        $this->addForeignKey( 'FK_user_card', 'user_card', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex( 'FK_card_user', 'user_card', 'card_id');
        $this->addForeignKey( 'FK_card_user', 'user_card', 'card_id', 'card', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey( 'FK_card_user', 'user_card');
        $this->dropIndex( 'FK_card_user', 'user_card');

        $this->dropForeignKey( 'FK_user_card', 'user_card');
        $this->dropIndex('FK_user_card', 'user_card');

        $this->dropTable('user_card');
    }
}
