<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
 * @property string $token
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Vote[] $votes
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $rememberMe = true;

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



    // Login 
    public static function findByUserEmail($email)
    {
        return self::findOne([
            "email" => $email,
            // "user_type" => "user"
        ]);
    }

    public function validatePassword($passwordHash)
    {
        return Yii::$app->getSecurity()->validatePassword($this->password, $passwordHash);
    }

    public function login()
    {
        $user = $this->findByUserEmail($this->email);
        if ($user && $this->validatePassword($user->password)) {
            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            $this->addError('password', 'Incorrect username or password.');
        }
    }



    /**
     * Gets query for [[Votes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['voter_id' => 'id']);
    }
}
