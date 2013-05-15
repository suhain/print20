<?php

$vd = array(
    0 => "<option value='0'>Не покрывать</option>",
    1 => "<option value='one matted'>Односторонний матовый</option>",
    2 => "<option value='one glossy'>Односторонний глянцевый</option>",
    3 => "<option value='one offset'>Односторонний оффсетный</option>",
    4 => "<option value='two matted'>Двусторонний матовый</option>",
    5 => "<option value='two glossy'>Двусторонний глянцевый</option>",
    6 => "<option value='two offset'>Двусторонний оффсетный</option>"
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
echo $vd[0];
if (!isset($_GET["cover"])) { // block
    if ($product == "Sticker" || $product == "Stamping_sticker") {
        echo $vd[1];
        echo $vd[2];
        echo $vd[3];
    } else if ($common) {
        if ($lamination == "0") {
            if ($product != "Booklet_(termo-glue)" && $product != "Booklet_(brace)" && $product != "Booklet_(spring)") {
                echo $vd[1];
                echo $vd[2];
                echo $vd[3];
            }
            if (!$onesided)
                echo $vd[4];
            if (!$onesided)
                echo $vd[5];
            if (!$onesided)
                echo $vd[6];
        }
        if ($lamination == "one_matted") {
            if ($product != "Booklet_(brace)" && $product != "Booklet_(spring)")
                echo $vd[1];
            if ($product != "Booklet_(brace)" && $product != "Booklet_(spring)")
                echo $vd[2];
            if ($product != "Booklet_(brace)" && $product != "Booklet_(spring)")
                echo $vd[3];
        }
        if ($lamination == "one_glossy") {
            if ($product != "Booklet_(brace)" && $product != "Booklet_(spring)")
                echo $vd[1];
            if ($product != "Booklet_(brace)" && $product != "Booklet_(spring)")
                echo $vd[2];
            if ($product != "Booklet_(brace)" && $product != "Booklet_(spring)")
                echo $vd[3];
        }
    }
} else { // cover
    if ($common) {
        if ($lamination == "0") {
            echo $vd[1];
            echo $vd[2];
            echo $vd[3];
            if (!$onesided)
                echo $vd[4];
            if (!$onesided)
                echo $vd[5];
            if (!$onesided)
                echo $vd[6];
        }
        if ($lamination == "one_matted") {
            echo $vd[1];
            echo $vd[2];
            echo $vd[3];
        }
        if ($lamination == "one_glossy") {
            echo $vd[1];
            echo $vd[2];
            echo $vd[3];
        }
    }
}
?>
