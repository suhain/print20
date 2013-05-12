<?php

require_once "save_product.php";
foreach ($prod as $key => $value) {
    echo "<option value=" . $key . ">" . $value["name_ru"] . "</option>";
}
?>
