<?php
require_once "save_product.php";
$product = $_GET["product"];
for ($i = 0; $i < count($prod[$product]["formats"]); $i++) {
    $w = $prod[$product]["formats"][$i];
    $t = explode("x", $w);
    $w = $t[1] . "x" . $t[0];
    echo "<option value=" . $w . ">" . $w . "</option>";
}
?>
