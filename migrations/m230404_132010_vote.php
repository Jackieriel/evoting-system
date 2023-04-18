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
            'voter_id' => $this->integer()->notNull(), //user_id
            'candidate_id' => $this->integer()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
            'updated_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
        ]);

        // add foreign key for vote user
        $this->addForeignKey(
            'fk-vote-user_id',
            '{{%vote}}',
            'voter_id',
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
}
