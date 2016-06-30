# ImageHandler
ImageHandler is a PHP class for resizing and shrinking jpeg files with the ImageMagick library.

The ImageMagick PHP library is required for class. This library is not readily available in PHP 7, but this guide was helpful in enabling it on Ubuntu.

[Guide - Enable imagick on PHP7](https://gist.github.com/nivv/5d9a12af5472b91606e6)

## GENERAL INFORMATION

ImageHandler is very simple and only exists to do one basic task. JPEG images are resized and automatically scaled based on the size of the maximum dimension (width or height). The image can then be saved off to file.

## HOW TO USE THE IMAGE HANDLER

Require the image handler in your project

    require_once('/path/to/ImageHandler.php');
    
Create the image handler object

    $img = new ImageHandler;
    
Load an image into the Image Handler object

    $original = 'original.jpg';
    $img->LoadImage($original);

Resize the image to 150px, 100% quality, and a maximum of 75kB in size. The Longest (or widest) dimension will be the scaled to 150px. The lesser dimension will scale.

    $maxsize = 150;
    $quality = 100;
    $maxKB = 75;
    $img->ResizeImage($maxsize,$quality,$maxKB);

Save the image off to a directory to which the user (or web server) has permission to write.

    $newfile = '/photos/saved.jpg';
    $img->SaveImage($newfile);
    
## OPERATIONAL FEEDBACK

There is some basic feedback available after each operation. You can retreive this information from the object by referencing the message property of the object.

    $img->SaveImage($newfile);
    echo $img->message;
