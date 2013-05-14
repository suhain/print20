<?php

require_once 'save_product.php';
$product = $_GET["product"];
if ($prod[$product]["type"] == "singlepage" || $product == "Kubarik") {
    echo "<option value='0'>Без обложки</option>";
} else if ($_GET["product"] == "Booklet_(brace)") {
    echo "<option value='1'>из того же материала, что и блок</option>";
    echo "<option value='2'>из другого материала</option>";
} else {
    echo "<option value='2'>из другого материала</option>";
}
?>
