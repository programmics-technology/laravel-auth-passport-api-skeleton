<?php

namespace App\Library;

trait Image

{

    private $allowedExtension = ["gif", "jpeg", "jpg", "png"];

    //2000000 bytes = 2MB
    public function image_validation($file='', $size = '2000000')
    {
        $file_type = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

        return (!in_array($file_type, $this->allowedExtension) || filesize($file) > $size) ? false : true ;
    }

    public function create_image($source){

        // Get image info
        $file_name = basename($source);
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        $image = null;
  
        // Create a new image from file 
        switch($file_type){ 
            case 'jpeg': 
                $image = imagecreatefromjpeg($source); 
                break; 
            case 'png': 
                $image = imagecreatefrompng($source); 
                break; 
            case 'gif': 
                $image = imagecreatefromgif($source); 
                break; 
            default: 
                $image = imagecreatefromjpeg($source); 
        }

        return $image;
    }

    public function compressImage($source, $destination, $quality) {

        // Get image info
        $file_name = basename($source);
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

        $image = $this->create_image($source);
        // Save image
        switch($file_type){ 
            case 'jpeg': 
                imagejpeg($image, $destination, $quality); 
                break; 
            case 'png': 
                imagepng($image, $destination, $quality); 
                break; 
            case 'gif': 
                imagegif($image, $destination, $quality); 
                break; 
            default: 
                imagejpeg($image, $destination, $quality); 
        }

        // Return compressed image 
        return $destination; 
    }

    public function resizeImage($source, $destination, $width = 150, $height = 150) { 
        
        // Get image info
        $file_name = basename($source);
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

        $image = $this->create_image($source);
        $image = imagescale($image , $width, $height);

        // Save image
        switch($file_type){ 
            case 'jpeg': 
                imagejpeg($image, $destination); 
                break; 
            case 'png': 
                imagepng($image, $destination); 
                break; 
            case 'gif': 
                imagegif($image, $destination); 
                break; 
            default: 
                imagejpeg($image, $destination); 
        }

        return $destination;
    }

}

