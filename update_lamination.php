<?php

$lamination = array(
    0 => "<option value='0'>Без ламинации</option>",
    1 => "<option value='one matted'>Односторонняя матовая</option>",
    2 => "<option value='one glossy'>Односторонняя глянцевая</option>",
    3 => "<option value='two matted'>Двусторонняя матовая</option>",
    4 => "<option value='two glossy'>Двусторонняя глянцевая</option>"
);
$product = $_GET["product"];
$material = $_GET["material"];
$density = (int) $_GET["density"];
$common = (bool) ($density >= 130 && ($material == "paper" || $material == "carton"));
if (!isset($_GET["cover"])) {
    $simple = array(
        "Booklet",
        "Eurobooklet",
        "Booklet_(3)",
        "Leaflet",
        "Postcard",
        "Flyer",
        "Poster",
        "Stamping_product",
        "Sticker",
        "Stamping_sticker"
    );

    function is_simple($product) {
        global $simple;
        foreach ($simple as $key)
            if ($product == $key)
                return true;
        return false;
    }

    if (is_simple($product) && $common) {
        foreach ($lamination as $value)
            echo $value;
    } else if (($product == "Booklet_(brace)" || $product == "Booklet_(spring)") && $common) {
        echo $lamination[0];
        echo $lamination[3];
        echo $lamination[4];
    } else if (is_simple($product) && $material == "self_adhesive") {
        echo $lamination[0];
        echo $lamination[1];
        echo $lamination[2];
    } else {
        echo $lamination[0];
    }
} else {
    $simple = array(
        "Booklet_(brace)",
        "Booklet_(spring)",
        "Notebook_(spring)",
    );

    function is_simple($product) {
        global $simple;
        foreach ($simple as $key)
            if ($product == $key)
                return true;
        return false;
    }

    if (is_simple($product) && $common) {
        foreach ($lamination as $value)
            echo $value;
    } else if ($product == "Booklet_(termo-glue)" && $common) {
        echo $lamination[0];
        echo $lamination[1];
        echo $lamination[2];
    } else {
        echo $lamination[0];
    }
}
?>
