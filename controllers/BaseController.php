<?php
namespace app\controllers;

use yii\rest\ActiveController;
use \app\models\User;
use yii\filters\auth\HttpBasicAuth;

/**
 * Description of BaseController
 *
 * @author Bolaji Smith
 */
class BaseController extends ActiveController 
{
   public $serializer = [
        'class' => 'yii\rest\Serializer',
    ];
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
//        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::className(),
//            'auth' => [$this, 'auth'],
//        ];
        return $behaviors;
    }
    
    
    
    public function auth($username, $password) 
    {
        return User::findOne([
        'username' => $username,
        'access_token' => $password,
        ]);
    }
    
    public function checkAccess($action, $model = null, $params = array()) {
        
        parent::checkAccess($action, $model, $params);
    }
}
