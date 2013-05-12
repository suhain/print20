<?php

$chromacity = array(
    0 => "<option value='4x4'>4x4</option>",
    1 => "<option value='4x1'>4x1</option>",
    2 => "<option value='4x0'>4x0</option>",
    3 => "<option value='1x1'>1x1</option>",
    4 => "<option value='1x0'>1x0</option>",
    5 => "<option value='0x0'>0x0</option>"
);
if (!isset($_GET["cover"])) {
    if ($_GET["product"] == "Booklet_(brace)" || $_GET["product"] == "Booklet_(termo-glue)" || $_GET["product"] == "Booklet_(spring)") {
        echo $chromacity[0];
        echo $chromacity[3];
    } else if ($_GET["product"] == "Sticker" || $_GET["product"] == "Stamping_sticker") {
        echo $chromacity[2];
        echo $chromacity[4];
    } else if ($_GET["product"] == "Notebook_(spring)") {
        foreach ($chromacity as $value)
            echo $value;
    } else {
        for ($i = 0; $i < 5; $i++)
            echo $chromacity[$i];
    }
} else {
    for ($i = 0; $i < 5; $i++) {
        echo $chromacity[$i];
    }
}
?>
