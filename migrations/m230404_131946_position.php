<?php

use yii\db\Migration;

/**
 * Class m230404_131946_position
 */
class m230404_131946_position extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // create position table
        $this->createTable('position', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
            'updated_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('position');
    } 
}
