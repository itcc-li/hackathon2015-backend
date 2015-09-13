<?php

namespace app\controllers;

/**
 * Description of PoiController
 *
 * @author Bolaji Smith
 */
class PoiController extends BaseController
{
    public $modelClass = 'app\models\Poi';

    /**
     * Resize an image from a base64 string
     * @param string $imgString
     * @param int $width
     * @param int $height
     * @return string
     */
    public static function resizeImage($imgString, $width, $height) 
    {
        header('charset=utf-8');
        $imgString = str_replace(' ', '+', $imgString);
        $img = imagecreatefromstring(base64_decode(trim($imgString)));
        
    	$image_p = imagecreatetruecolor($width, $height);
        imagecopyresampled($image_p, $img, 0, 0, 0, 0, $width, $height, imagesx($img), imagesy($img));
    	ob_start();
    	imagejpeg($image_p, NULL, 100);
    	imagedestroy($image_p);
    	$thumbnail = ob_get_clean();

    	return base64_encode($thumbnail);
    }

}
