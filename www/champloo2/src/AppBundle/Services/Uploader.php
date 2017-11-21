<?php
// src/AppBundle/Services/Uploader.php
/**
 * Created by PhpStorm.
 * User: Fred
 * Date: 17/04/2016
 * Time: 16:36
 */

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

// classé les fichier uploadés par type/année/mois/slug
class Uploader
{

    protected function getUploadRootDir(){
        return __DIR__.'/../../../../uploads/'.$this-> getUploadDir()
    }

    private function getUploadDir(){
        $path = trim($path, '/' );
        $replace = array (
            '%year'  => date('y'),
            '%month' => date('m')
        );

    }
}