<?php

use yii\db\Migration;

/**
 * Class m230404_131904_user
 */
class m230404_131904_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // create user table
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'user_type' => $this->string(120)->defaultValue('voter'),
            'auth_key' => $this->string()->notNull(),
            'otp' => $this->string(6)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
            'updated_at' => $this->dateTime()->defaultValue(Date('Y-m-d H:i:s')),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230404_131904_user cannot be reverted.\n";

        return false;
    }
    */
}
