<?php

require_once "density_of_materials.php";
$material = $_GET["material"];
$product = $_GET["product"];

function range_d($lower, $upper) {
    global $density;
    global $material;
    for ($i = 0; $i < count($density[$material]); $i++) {
        $w = (int) $density[$material][$i];
        if ($lower <= $w && $w <= $upper) echo "<option value='$w'>$w</option>";
    }
}
if (!isset($_GET["cover"])) {
    if ($product == "Postcard") {
        if ($material == "paper") {
            range_d(200, 1000);
        } else range_d(0, 1000);
    } else if ($product == "Booklet_(termo-glue)") {
        range_d(0, 150);    
    } else if ($product == "Kubarik") {
        range_d(0, 150);
    } else range_d(0, 1000);
} else {
    if ($product == "Booklet_(termo-glue)") {
        if ($material == "paper") range_d(170, 1000);    
    }
    else range_d(0, 1000);
}
?>
