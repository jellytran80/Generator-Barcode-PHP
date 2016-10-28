<?php 

class BarcodeGeneratorHTML extends BarcodeGenerator
{
    /**
     * Return an HTML representation of barcode.
     *
     */
    public function getBarcode($code, $type, $widthFactor = 2, $totalHeight = 30, $color = 'black')
    {
        $barcodeData = $this->getBarcodeData($code, $type);
        $html = '<div style="font-size:0;position:relative;width:' . ($barcodeData['maxWidth'] * $widthFactor) . 'px;height:' . ($totalHeight) . 'px;">' . "\n";
        $positionHorizontal = 0;
        foreach ($barcodeData['bars'] as $bar) {
            $barWidth = round(($bar['width'] * $widthFactor), 3);
            $barHeight = round(($bar['height'] * $totalHeight / $barcodeData['maxHeight']), 3);
            if ($bar['drawBar']) {
                $positionVertical = round(($bar['positionVertical'] * $totalHeight / $barcodeData['maxHeight']), 3);
                // draw a vertical bar
                $html .= '<div style="background-color:' . $color . ';width:' . $barWidth . 'px;height:' . $barHeight . 'px;position:absolute;left:' . $positionHorizontal . 'px;top:' . $positionVertical . 'px;">&nbsp;</div>' . "\n";
            }
            $positionHorizontal += $barWidth;
        }
        $html .= '</div>' . "\n";
        return $html;
    }
}
 ?>