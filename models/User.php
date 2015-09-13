<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $access_token
 * @property resource $thumbnail
 * @property string $created
 * @property string $modified
 *
 * @property Comment[] $comments
 * @property Poi[] $pois
 */
class User extends \app\models\BaseAR implements \yii\web\IdentityInterface
{
    
    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'username',
            'first_name',
            'last_name',
            'email_address',
            'thumbnail',
            'created',
        ];
    }

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email_address'], 'required'],
            [['thumbnail'], 'string'],
            [['created', 'modified'], 'safe'],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 200],
            [['email_address', 'access_token'], 'string', 'max' => 255],
            [['email_address'], 'unique'],
            [['email_address'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_address' => 'Email Address',
            'access_token' => 'Access Token',
            'thumbnail' => 'Thumbnail',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPois()
    {
        return $this->hasMany(Poi::className(), ['user_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
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
        return $this->access_token;
    }

    public function validateAuthKey($authKey)
    {
        return $this->access_token === $authKey;
    }
    
    /**
     * Generate User Access Token
     * @return string
     */
    protected static function generateAccessToken()
    {
        return sha1(uniqid(rand(), true));
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            $this->access_token = self::generateAccessToken();
            return true;
        } 
        else 
        {
            return false;
        }
    }

}
