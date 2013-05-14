<?php

$uf = array(
    0 => "<option value='no'>Не покрывать</option>",
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
if (!isset($_GET["cover"])) { // block
    echo $uf[0];
    if ($product == "Sticker" || $product == "Stamping_sticker") {
        echo $uf[1];
        echo $uf[2];
    } else
    if ($common) {
        if ($product == "Booklet_(brace)" || $product == "Booklet_(spring)") {
            if ($lamination == "0") {
                if (!$onesided)
                    echo $uf[4];
            }
        } if ($product == "Booklet_(termo-glue)") {
            if (!$onesided)
                echo $uf[4];
        } else {
            if ($lamination == "one_matted") {
                echo $uf[1];
                echo $uf[2];
            }
            if ($lamination == "one_glossy") {
                echo $uf[1];
                echo $uf[2];
                if (!$onesided)
                    echo $uf[4];
            }
            if ($lamination == "two_glossy") {
                echo $uf[2];
                if (!$onesided)
                    echo $uf[4];
            }
        }
    }
} else { // cover
    echo $uf[0];
    if ($common) {
        if ($product == "Booklet_(brace)" || $product == "Booklet_(spring)" || $product == "Booklet_(termo-glue)") {
            if ($onesided) {
                if ($lamination == "0" || $lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $uf[1];
                }
            } else {
                if ($lamination == "0") {
                    echo $uf[1];
                    echo $uf[2];
                }
                if ($lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $uf[1];
                }
            }
        } else {
            if ($onesided) {
                if ($lamination == "0" || $lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $uf[1];
                }
            } else {
                if ($lamination == "0") {
                    echo $uf[1];
                    echo $uf[2];
                }
                if ($lamination == "one_matted" || $lamination == "one_glossy") {
                    echo $uf[1];
                }
            }
        }
    }
}
?>
