<?php

App::uses('Component', 'Controller');

class ResizeComponent extends Object
{

    public function initialize(Controller $controller) {
        
    }

    public function beforeRender() {
        
    }

    public function beforeRedirect() {
        
    }

    public function shutdown() {
        
    }

    function startup(&$controller) {
        // This method takes a reference to the controller which is loading it.
        // Perform controller initialization here.
    }

    function resize($src, $dst, $type, $r_width, $r_height, $crop_x, $crop_y, $crop_width, $crop_height) {
        list( $width, $height, $source_type ) = getimagesize($src);

        switch ($source_type) {
            case IMAGETYPE_GIF:
                $source_gdim = imagecreatefromgif($src);
                break;

            case IMAGETYPE_JPEG:
                $source_gdim = imagecreatefromjpeg($src);
                break;

            case IMAGETYPE_PNG:
                $source_gdim = imagecreatefrompng($src);
                break;
        }

        if ($type == "width") {
            $new_width = $r_width;

            $new_height = floor(($height / $width) * $new_width);
        } elseif ($type == "height") {
            $new_height = $r_height;

            $new_width = floor(($width / $height) * $new_height);
        }
        /*         * * as_define is for height & weight  as you define as parameters in resize  function in controller ** */ else if ($type == "as_define") {
            $new_height = $r_height;

            $new_width = $r_width;
        } elseif ($type == "auto") {
            if ($width / $height > $r_width / $r_height) {
                $new_width = $r_width;

                $new_height = floor(($height / $width) * $new_width);
            } elseif ($width / $height < $r_width / $r_height) {
                $new_height = $r_height;

                $new_width = floor(($width / $height) * $new_height);
            } else {
                $new_width = $r_width;

                $new_height = $r_height;
            }
        } elseif ($type == "aspect_fill") {
            $new_width = $r_width;

            $new_height = $r_height;

            if ($r_width == 0 && $r_height == 0) {
                $r_width = $crop_width;

                $r_height = $crop_height;
            }
            if ($width / $height > $r_width / $r_height) {
                if ($crop_x == 0) {
                    $crop_x = round(($width - ($r_width / ($r_height / $height))) / 2);

                    $crop_y = 0;
                }
                $width = floor(($r_width / $r_height) * $height);
            } elseif ($width / $height < $r_width / $r_height) {
                if ($crop_y == 0) {
                    $crop_y = round(($height - ($r_height / ($r_width / $width))) / 2);

                    $crop_x = 0;
                }
                $height = floor(($r_height / $r_width) * $width);
            } else {
                if ($crop_y == 0) {
                    $crop_y = 0;

                    $crop_x = 0;
                }
            }
            if ($crop_width != 0) {
                $width = $crop_width;
            }
            if ($crop_height != 0) {
                $height = $crop_height;
            }
        } elseif ($type == "aspect_fit") {
            $new_width = $r_width;

            $new_height = $r_height;

            if ($width / $height > $r_width / $r_height) {
                $crop_y = round(($r_height - $r_width * ($height / $width)) / 2);

                $crop_x = 0;
            } elseif ($width / $height < $r_width / $r_height) {
                $crop_x = round(($r_width - $r_height * ($width / $height)) / 2);

                $crop_y = 0;
            } else {
                $crop_y = 0;

                $crop_x = 0;
            }
        }
        $new_image = imagecreatetruecolor($new_width, $new_height);

        switch ($source_type) {

            case IMAGETYPE_PNG:
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($new_image, 255, 255, 255);
                // removing the black from the placeholder
                imagecolortransparent($new_image, $background);
                // turning off alpha blending (to ensure alpha channel information
                // is preserved, rather than removed (blending with the rest of the
                // image in the form of black))
                imagealphablending($new_image, false);

                // turning on alpha channel information saving (to ensure the full range
                // of transparency is preserved)
                imagesavealpha($new_image, true);
                break;
            case IMAGETYPE_GIF:
                // integer representation of the color black (rgb: 0,0,0)
                $background = imagecolorallocate($new_image, 255, 255, 255);
                // removing the black from the placeholder
                imagecolortransparent($new_image, $background);

                break;
        }

        if ($type == "aspect_fit") {
            $newColor = ImageColorAllocate($new_image, 255, 255, 255);

            imagefill($new_image, 0, 0, $newColor);

            if ($width / $height > $r_width / $r_height) {
                $new_height = $r_width * ($height / $width);
            } elseif ($width / $height < $r_width / $r_height) {
                $new_width = $r_height * ($width / $height);
            }
        }

        if ($type == "aspect_fit") {
            //echo $crop_x,$crop_y,$new_width, $new_height, $width, $height; die;
            imagecopyresampled($new_image, $source_gdim, $crop_x, $crop_y, 0, 0, $new_width, $new_height, $width, $height);
        } else {
            imagecopyresampled($new_image, $source_gdim, 0, 0, $crop_x, $crop_y, $new_width, $new_height, $width, $height);
        }
        switch ($source_type) {
            case IMAGETYPE_GIF:
                imagegif($new_image, $dst);
                break;

            case IMAGETYPE_JPEG:
                imagejpeg($new_image, $dst, 90);
                break;

            case IMAGETYPE_PNG:
                imagepng($new_image, $dst);
                break;
        }
        imagedestroy($source_gdim);

        imagedestroy($new_image);
    }

}
