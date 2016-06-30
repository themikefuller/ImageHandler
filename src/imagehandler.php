<?php

class ImageHandler {

    private $image;
    public $message;
    public $filesize;
    private $d;

    public function __construct() {
        $this->message = "";
    }

    function SaveImage($newfile) {
        if ($this->image) {
            try {
                $result = $this->image->WriteImage($newfile);
            } catch(Exception $e) {
                $this->message .= "Can not save to that location. ";
                $this->image->destroy();
                return false;
            }
            $this->image->destroy();
                $this->message .= "Image saved to " . $newfile . ". ";
            return $newfile;
        } else {
            $this->message .= "Can not save empty image. Try loading an image. "; 
            return false;
        } 
    }

    function LoadImage($original) {
        if (!class_exists('Imagick')) {
            $this->message .= "ImageMagick PHP module is required. ";
            return false;
        }
        try {
            $image = new Imagick($original);
        }
        catch(Exception $e) {
            $this->message .= "Failed to load image. File must be a jpeg image. ";
            $this->image = false;
            return false;
        }
        $this->filesize = filesize($original);
        $this->image = $image;
        $this->d = $this->image->getImageGeometry();
        $this->message .= "Image loaded. Current Dimension: " . $this->d['width'] . ' X ' . $this->d['height'] . ". ";
        return true;
    }

    function ResizeImage($maxsize=3000,$quality=100,$maxKB=300) {
        $d = $this->d;
        if ($quality > 100) {
            $quality = 100;
        }
        $w = $d['width'];
        $h = $d['height'];

        if ($h > $w) {
            if ($h < $maxsize) {
                $maxsize = $h;
            }
            $h = $maxsize;
            $w = 0;
        } else {
            if ($w < $maxsize) {
                $maxsize = $w;
            }
            $w = $maxsize;
            $h = 0;
        }
        if ($this->image) {
            $oriKB = $this->filesize / 1000;
            if ($oriKB < $maxKB) {
                $maxKB = $oriKB;
            }
            $this->image->scaleImage($w,$h);
            $this->image->setOption('jpeg:extent', $maxKB. 'kb');
            $this->image->SetImageCompressionQuality($quality);
            $this->d = $this->image->getImageGeometry();
            $this->message .= "Image resized to " . $this->d['width'] . " X " . $this->d['height'] . ". ";
            return true;
        } else {
            $this->message .= "Could not resize image. Was the image loaded properly? ";
            return false;
        }
    }

}
