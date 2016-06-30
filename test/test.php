<?php

// This test is a pratical use of the image handler.

// Load the image handler class
require_once "../src/ImageHandler.php";

// Creat an ImageHandler object
$img = new ImageHandler;

// Load an image into the object
$original = "original.jpg";
$img->LoadImage($original);
echo $img->message . "\r\n";

// Resize the image and adjust the quality
$maxsize = 150;
$quality = 20;
$img->ResizeImage($maxsize,$quality);
echo $img->message . "\r\n";

// Save the image
$newfile = 'saved.jpg';
$img->SaveImage($newfile);
echo $img->message . "\r\n";

