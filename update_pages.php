<?php

require_once "save_product.php";
$product = $_GET["product"];
if (!isset($_GET["cover"])) {
    if ($prod[$product]["type"] == "singlepage") {
        $count_of_pages = $prod[$product]["pages_on_spread"];
        echo "<input type='text' style='width:165px' name='pages' id='pages' value='$count_of_pages' disabled></span>";
    } else {
        echo "<input type='text' style='width:165px' name='pages' id='pages' maxlength='6'>";
    }
} else {
    echo "<input type='text' style='width:165px' name='cover-pages' id='cover_pages' value='4' disabled></span>";
}
?>
