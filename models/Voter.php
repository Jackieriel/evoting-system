<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $user_type
 * @property string $auth_key
 * @property string $otp
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Vote[] $votes
 */
class Voter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'email', 'password', 'auth_key', 'otp'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'first_name', 'last_name', 'email', 'password', 'auth_key'], 'string', 'max' => 255],
            [['user_type'], 'string', 'max' => 120],
            [['otp'], 'string', 'max' => 6],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'user_type' => 'User Type',
            'auth_key' => 'Auth Key',
            'otp' => 'OTP',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * Gets query for [[Votes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['user_id' => 'id']);
    }
}
