<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $poi_id
 * @property string $comment
 * @property integer $rating
 * @property string $created
 * @property string $modified
 *
 * @property Poi $poi
 * @property User $user
 */
class Comment extends \app\models\BaseAR
{
    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'user_id',
            'poi_id',
            'comment',
            'rating',
            'created',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['user', 'poi'];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'poi_id', 'comment'], 'required'],
            [['user_id', 'poi_id', 'rating'], 'integer'],
            [['comment'], 'string'],
            [['created', 'modified'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'poi_id' => 'Poi ID',
            'comment' => 'Comment',
            'rating' => 'Rating',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoi()
    {
        return $this->hasOne(Poi::className(), ['id' => 'poi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
