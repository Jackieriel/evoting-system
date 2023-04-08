<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "candidate".
 *
 * @property int $id
 * @property string $name
 * @property string|null $photo
 * @property string $bio
 * @property int $position_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Position $position
 * @property Vote[] $votes
 */
class Candidate extends \yii\db\ActiveRecord
{
    public $imageFile; // attribute to hold the uploaded image file

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'candidate';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'bio', 'position_id'], 'required'],
            [['bio'], 'string'],
            [['position_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'photo'], 'string', 'max' => 255],            
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::class, 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'photo' => 'Photo',            
            'imageFile' => 'Photo',
            'bio' => 'Bio',
            'position_id' => 'Position',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

  // method to handle the image file upload
  public function upload()
  {
      if ($this->validate()) {
          $filename = 'uploads/candidates/' . uniqid() . '.' . $this->imageFile->extension;
          $this->imageFile->saveAs($filename);
          $this->photo = $filename;
          return true;
      } else {
          return false;
      }
  }
  

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::class, ['id' => 'position_id']);
    }

    /**
     * Gets query for [[Votes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['candidate_id' => 'id']);
    }
}
