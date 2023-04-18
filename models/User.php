<?php

namespace app\models;

<<<<<<< HEAD
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
=======
class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public static function tableName()
    {
        return 'user';
=======
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'auth_key', 'otp'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'password', 'auth_key'], 'string', 'max' => 255],
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

=======
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941
    public function getId()
    {
        return $this->id;
    }

<<<<<<< HEAD
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
            "user_type" => "user"
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
        return $this->hasMany(Vote::class, ['user_id' => 'id']);
=======
    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
>>>>>>> 2d5f09252dc1b2bb636bdc12d5fff451ef31d941
    }
}
