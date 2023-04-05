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
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('position');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230404_131946_position cannot be reverted.\n";

        return false;
    }
    */
}
