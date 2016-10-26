<?php 
require "BarcodeGenerator.php";

class BarcodeGeneratorJPG extends BarcodeGenerator {
	//do something here
	public function getBarcode($code, $type, $widthFactor = 2, $totalHeight = 30, $color = array(0, 0, 0)) {
		$barcodeData = $this->getBarcodeData($code, $type);
        // calculate image size
        $width = ($barcodeData['maxWidth'] * $widthFactor);
        $height = $totalHeight;	
	}
}
 ?>