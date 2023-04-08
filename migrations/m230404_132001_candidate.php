<?php

use yii\db\Migration;

/**
 * Class m230404_132001_candidate
 */
class m230404_132001_candidate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // create candidate table
        $this->createTable('candidate', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'photo' => $this->string()->notNull(),
            'bio' => $this->text()->notNull(),
            'position_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
            'updated_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
        ]);

        // add foreign key for candidate position
        $this->addForeignKey(
            'fk-candidate-position_id',
            'candidate',
            'position_id',
            'position',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%candidate}}');
    }

}
