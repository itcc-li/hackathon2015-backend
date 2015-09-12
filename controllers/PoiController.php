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

    public static function resizeImage($imgString, $width, $height) {
      $img = \imagecreatefromstring($imgString);

    	// Ensure image is in jpg format
    	if ($img["type"] != "image/jpeg" && $img["type"] != "image/jpg") return false;

    	$tmp = \imagecreatetruecolor($width, $height);

    	$initSize = \getimagesize($img["tmp_name"]);

    	\imagecopyresampled($tmp, \imagecreatefromjpeg($img["tmp_name"]), 0, 0, 0, 0, $width, $height, $initSize[0], $initSize[1]);

    	\ob_start();
    	\imagejpeg($tmp, NULL, 100);
    	\imagedestroy($tmp);
    	$thumbnail = \ob_get_clean();

    	return \base64_encode($thumbnail);
    }

}
