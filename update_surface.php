<?php

if (!isset($_GET["cover"])) {
    if ($_GET["product"] == "Sticker" || $_GET["product"] == "Stamping_sticker") {
        echo "<option value='0'>Без покрытия</option>";
    } else {
        if ($_GET["material"] == "paper") {
            echo "<option value='matted'>Матовая</option>";
            echo "<option value='glossy'>Глянцевая</option>";
        } else {
            echo "<option value='0'>Без покрытия</option>";
        }
    }
} else {
    if ($_GET["product"] == "Sticker" || $_GET["product"] == "Stamping_sticker") {
        echo "<option value='0'>Без покрытия</option>";
    } else {
        if ($_GET["material"] == "paper") {
            echo "<option value='matted'>Матовая</option>";
            echo "<option value='glossy'>Глянцевая</option>";
        } else {
            echo "<option value='0'>Без покрытия</option>";
        }
    }
}
?>
