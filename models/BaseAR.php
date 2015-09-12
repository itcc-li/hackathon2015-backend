<?php
namespace app\models;
use \yii\db\ActiveRecord;

class BaseAR extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'app\models\LoggableBehavior'
        ];
    }
    
    public function beforeSave($insert)
    {
        if ($insert == true) {
            $this->created = new \yii\db\Expression('NOW()');
        }
        else {
            $this->modified = new \yii\db\Expression('NOW()');
        }

        return parent::beforeSave($insert);
    }
}