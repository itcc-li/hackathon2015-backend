<?php

namespace app\controllers;
use yii\filters\auth\HttpBasicAuth;
/**
 * Description of UserController
 *
 * @author Bolaji Smith
 */
class UserController extends BaseController
{
    public $modelClass = 'app\models\User';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
//        $behaviors['authenticator'] = [
//            'except' => ['create'],
//            'class' => HttpBasicAuth::className(),
//            'auth' => [$this, 'auth'],
//        ];
        return $behaviors;
    }
    
}

