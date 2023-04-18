<?php

use yii\db\Migration;

/**
 * Class m230404_132010_vote
 */
class m230404_132010_vote extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // create vote table
        $this->createTable('vote', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'candidate_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);

        // add foreign key for vote user
        $this->addForeignKey(
            'fk-vote-user_id',
            '{{%vote}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // add foreign key for vote candidate
        $this->addForeignKey(
            'fk-vote-candidate_id',
            '{{%vote}}',
            'candidate_id',
            '{{%candidate}}',
            'id',
            'CASCADE'
        );

        // add foreign key for vote position
        $this->addForeignKey(
            'fk-vote-position_id',
            '{{%vote}}',
            'position_id',
            '{{%position}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('vote');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230404_132010_vote cannot be reverted.\n";

        return false;
    }
    */
}
