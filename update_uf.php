<?php

$uf = array(
    0 => "<option value='0'>Не покрывать</option>",
    1 => "<option value='one glossy'>Односторонний глянцевый(Сплошной)</option>",
    2 => "<option value='one glossy selected'>Односторонний глянцевый(Выборочный)</option>",
    3 => "<option value='two glossy'>Двусторонний глянцевый(Сплошной)</option>",
    4 => "<option value='two glossy selected'>Двусторонний глянцевый(Выборочный)</option>"
);
$product = $_GET["product"];
$material = $_GET["material"];
$density = (int) $_GET["density"];
$chromacity = $_GET["chromacity"];
$common = (bool) (($material == "paper" || $material == "carton") && $density >= 115 && $chromacity != "0 0");
$onesided = (bool) ($chromacity == "4 0" || $chromacity == "1 0");
$lamination = $_GET["lamination"];
echo $uf[0];
if (!isset($_GET["cover"])) { // block
    if ($product == "Sticker" || $product == "Stamping_sticker") {
        echo $uf[1];
        echo $uf[2];
    } else
    if ($common) {
        if ($lamination == "0") {
            if ($product != "Booklet_(termo-glue)" && $product != "Notebook_(spring)" && $product != "Kubarik") echo $uf[1];
            if ($product != "Booklet_(termo-glue)") echo $uf[2];
            if (!$onesided && $product != "Booklet_(termo-glue)" && $product != "Notebook_(spring)") echo $uf[3];
            if (!$onesided) echo $uf[4];
        }
        if ($lamination == "one_matted") {
            if ($product != "Notebook_(spring)" && $product != "Kubarik") echo $uf[1];
            echo $uf[2];
            if (!$onesided) echo $uf[4];
        }
        if ($lamination == "one_glossy") {
            if ($product != "Notebook_(spring)" && $product != "Kubarik") echo $uf[1];
            echo $uf[2];
        }
        if ($lamination == "two_matted") {
            echo $uf[2];
            if (!$onesided) echo $uf[4];
        }
    }
} else { // cover
    if ($common) {
        if ($lamination == "0") {
            echo $uf[1];
            echo $uf[2];
            if (!$onesided && $product != "Booklet_(termo-glue)") echo $uf[3];
            if (!$onesided) echo $uf[4];
        }
        if ($lamination == "one_matted") {
            if ($product != "Booklet_(termo-glue)") echo $uf[1];
            echo $uf[2];
            if (!$onesided) echo $uf[4];
        }
        if ($lamination == "one_glossy") {
            if ($product != "Booklet_(termo-glue)") echo $uf[1];
            echo $uf[2];
        }
        if ($lamination == "two_matted") {
            echo $uf[2];
            if (!$onesided) echo $uf[4];
        }
    }
}
?>
