<?php

/**
 * Setup Barcode Generator
 * Type Code_39
 * @param string $text [<text generator>]
 * getBarcode(text,type,width,height)
 */
require('BarcodeGeneratorPNG.php');

$text = 'BarcodeGeneratorPNG-Code39'; 
$generator = new BarcodeGeneratorPNG();
$imgbar = base64_encode($generator->getBarcode($text, $generator::TYPE_CODE_39, 1, 50));
?>
<div>
<?= '<img src="data:image/png;base64,' . $imgbar . '">'; ?>
<p><?= $text ?></p>	
</div>
