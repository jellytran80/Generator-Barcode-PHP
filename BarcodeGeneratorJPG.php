<?php 
require "BarcodeGenerator.php";

class BarcodeGeneratorJPG extends BarcodeGenerator {
	//do something here
	public function getBarcode($code, $type, $widthFactor = 2, $totalHeight = 30, $color = array(0, 0, 0))
    {
        $barcodeData = $this->getBarcodeData($code, $type);
        // calculate image size
        $width = ($barcodeData['maxWidth'] * $widthFactor);
        $height = $totalHeight;
        if (function_exists('imagecreate')) {
            // GD library
            $imagick = false;
            $jpg = imagecreate($width, $height);
            $colorBackground = imagecolorallocate($jpg, 255, 255, 255);
            imagecolortransparent($jpg, $colorBackground);
            $colorForeground = imagecolorallocate($jpg, $color[0], $color[1], $color[2]);
        } elseif (extension_loaded('imagick')) {
            $imagick = true;
            $colorForeground = new \imagickpixel('rgb(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ')');
            $jpg = new \Imagick();
            $jpg->newImage($width, $height, 'none', 'jpg');
            $imageMagickObject = new \imagickdraw();
            $imageMagickObject->setFillColor($colorForeground);
        } else {
            return false;
        }
        // print bars
        $positionHorizontal = 0;
        foreach ($barcodeData['bars'] as $bar) {
            $bw = round(($bar['width'] * $widthFactor), 3);
            $bh = round(($bar['height'] * $totalHeight / $barcodeData['maxHeight']), 3);
            if ($bar['drawBar']) {
                $y = round(($bar['positionVertical'] * $totalHeight / $barcodeData['maxHeight']), 3);
                // draw a vertical bar
                if ($imagick && isset($imageMagickObject)) {
                    $imageMagickObject->rectangle($positionHorizontal, $y, ($positionHorizontal + $bw), ($y + $bh));
                } else {
                    imagefilledrectangle($jpg, $positionHorizontal, $y, ($positionHorizontal + $bw) - 1, ($y + $bh),
                        $colorForeground);
                }
            }
            $positionHorizontal += $bw;
        }
        ob_start();
        if ($imagick && isset($imageMagickObject)) {
            $jpg->drawImage($imageMagickObject);
            echo $jpg;
        } else {
            imagejpeg($jpg);
            imagedestroy($jpg);
        }
        $image = ob_get_clean();
        return $image;
    }
}
}
 ?>