<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "position".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 *
 * @property Candidate[] $candidates
 * @property Vote[] $votes
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
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
            [['name', 'slug', 'description'], 'required'],
            [['description'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
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
            'slug' => 'Slug',
            'description' => 'Description',
        ];
    }



    /**
     * Gets query for [[Candidates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCandidates()
    {
        return $this->hasMany(Candidate::class, ['position_id' => 'id']);
    }

    /**
     * Gets query for [[Votes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['position_id' => 'id']);
    }
    
}
