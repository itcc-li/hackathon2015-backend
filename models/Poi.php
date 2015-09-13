<?php

namespace app\models;

use Yii;
use app\controllers\PoiController;

/**
 * This is the model class for table "poi".
 *
 * @property integer $id
 * @property string $name
 * @property string $longitude
 * @property string $latitude
 * @property string $description
 * @property resource $image
 * @property integer $user_id
 * @property string $created
 * @property string $modified
 *
 * @property Comment[] $comments
 * @property User $user
 * @property thumbnail
 */
class Poi extends \app\models\BaseAR
{
    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'name',
            'description',
            'longitude',
            'latitude',
            'image',
            'thumbnail',
            'user_id',
            'created',
            'rating' => function ($model) {
                return self::getRating($this->id);
            },
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['user'];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'longitude', 'latitude', 'user_id'], 'required'],
            [['longitude', 'latitude'], 'number'],
            [['description', 'image', 'thumbnail'], 'string'],
            [['user_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'description' => 'Description',
            'image' => 'Image',
            'user_id' => 'User ID',
            'created' => 'Created',
            'modified' => 'Modified',
            'thumbnail' => 'Thumbnail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['poi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    
    protected static function getRating($poi_id)
    {
        $sql = "SELECT AVG(a.rating) as average_rating from comment a JOIN poi b on a.poi_id = b.id WHERE a.poi_id = $poi_id";
        $command = \Yii::$app->db->createCommand($sql)->queryAll();
        return is_null($command[0]['average_rating']) ? 0 : round($command[0]['average_rating'],1, PHP_ROUND_HALF_UP);
    }
    
    /**
     * Search Point of Interest by Distance (in kilometers)
     * @param float $long
     * @param float $lat
     * @param int $distance
     * @param int $limit
     *
     * @return
     */
    public static function searchByDistance($long, $lat, $distance=20, $limit=20)
    {
        $sql = "SELECT
                id, (
                  6371 * acos (
                    cos ( radians(78.3232) )
                    * cos( radians( ".$lat." ) )
                    * cos( radians( ".$long." ) - radians(65.3234) )
                    + sin ( radians(78.3232) )
                    * sin( radians( ".$lat." ) )
                  )
                ) AS distance
              FROM markers
              HAVING distance < ".$distance."
              ORDER BY distance
              LIMIT 0 , ".$limit.";";
		
        $command = Yii::$app->db->createCommand($sql);
        return $command->queryAll();
    
    }

    public function beforeSave($insert)
    {
        
        if (parent::beforeSave($insert) )
        {
            if(isset($this->image))
            {
                $this->thumbnail = PoiController::resizeImage($this->image, 108, 108);
            }
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
}
