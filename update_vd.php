<?php

$vd = array(
    0 => "<option value='0'>Не покрывать</option>",
    1 => "<option value='one glossy'>Односторонний глянцевый</option>",
    2 => "<option value='two glossy'>Двусторонний глянцевый</option>"
);
//$vd = array(
//    0 => "Не покрывать<br>",
//    1 => "Односторонний глянцевый<br>",
//    2 => "Двусторонний глянцевый<br>"
//);
$product = $_GET["product"];
$material = $_GET["material"];
$density = (int) $_GET["density"];
$chromacity = $_GET["chromacity"];
$common = (bool) (($material == "paper" || $material == "carton") && $density >= 115 && $chromacity != "0 0");
$onesided = (bool) ($chromacity == "4 0" || $chromacity == "1 0");
$lamination = $_GET["lamination"];
if (!isset($_GET["cover"])) { // block
    echo $vd[0];
    if ($product == "Sticker" || $product == "Stamping_sticker") {
        echo $vd[1];
    } else 
    if ($common) {
        if ($product == "Booklet_(brace)" || $product == "Booklet_(spring)" || $product == "Booklet_(termo-glue)") {
            if (!$onesided && $lamination == "0") {
                echo $vd[2];
            }
        } else {
            if ($onesided) {
                if ($lamination == "0" || $lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $vd[1];
                }
            } else {
                if ($lamination == "0") {
                    echo $vd[1];
                    echo $vd[2];
                }
                if ($lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $vd[1];
                }
            }
        }
    }
} else { // cover
    echo $vd[0];
    if ($common) {
        if ($product == "Booklet_(brace)" || $product == "Booklet_(spring)" || $product == "Booklet_(termo-glue)") {
            if ($onesided) {
                if ($lamination == "0" || $lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $vd[1];
                }
            } else {
                if ($lamination == "0") {
                    echo $vd[1];
                    echo $vd[2];
                }
                if ($lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $vd[1];
                }
            }
        } else {
            if ($onesided) {
                if ($lamination == "0" || $lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $vd[1];
                }
            } else {
                if ($lamination == "0") {
                    echo $vd[1];
                    echo $vd[2];
                }
                if ($lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $vd[1];
                }
            }
        }
    }
}
?>
