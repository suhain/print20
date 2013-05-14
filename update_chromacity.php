<?php

$chromacity = array(
    0 => "<option value='4+4'>4+4</option>",
    1 => "<option value='4+1'>4+1</option>",
    2 => "<option value='4+0'>4+0</option>",
    3 => "<option value='1+1'>1+1</option>",
    4 => "<option value='1+0'>1+0</option>",
    5 => "<option value='0+0'>0+0</option>"
);
if (!isset($_GET["cover"])) {
    if ($_GET["product"] == "Booklet_(brace)" || $_GET["product"] == "Booklet_(termo-glue)" || $_GET["product"] == "Booklet_(spring)") {
        echo $chromacity[0];
        echo $chromacity[3];
    } else if ($_GET["product"] == "Sticker" || $_GET["product"] == "Stamping_sticker" || $_GET["product"] == "Kubarik") {
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
