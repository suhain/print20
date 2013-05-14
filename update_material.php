<?php

if (!isset($_GET["cover"])) {
    $simple = array(
        "Booklet",
        "Eurobooklet",
        "Booklet_(3)",
        "Booklet_(2)",
        "Leaflet",
        "Booklet_(brace)",
        "Booklet_(spring)",
        "Poster"
    );

    function is_simple($product) {
        global $simple;
        foreach ($simple as $key)
            if ($product == $key)
                return true;
        return false;
    }

    if (is_simple($_GET["product"])) {
        echo "<option value='paper'>Мелованная бумага</option>";
        echo "<option value='carton'>Картон</option>";
        echo "<option value='offset'>Офсетная бумага</option>";
    }

    if ($_GET["product"] == "Postcard") {
        echo "<option value='paper'>Мелованная бумага</option>";
        echo "<option value='carton'>Картон</option>";
    }

    if ($_GET["product"] == "Flyer" || $_GET["product"] == "Booklet_(termo-glue)" || $_GET["product"] == "Kubarik" || $_GET["product"] == "Notebook_(spring)") {
        echo "<option value='paper'>Мелованная бумага</option>";
        echo "<option value='offset'>Офсетная бумага</option>";
    }

    if ($_GET["product"] == "Sticker" || $_GET["product"] == "Stamping_sticker") {
        echo "<option value='self_adhesive'>Самоклейка</option>";
    }

    if ($_GET["product"] == "Stamping_product") {
        echo "<option value='paper'>Мелованная бумага</option>";
        echo "<option value='carton'>Картон</option>";
        echo "<option value='offset'>Офсетная бумага</option>";
    }
} else {
    if ($_GET["product"] == "Booklet_(brace)" || $_GET["product"] == "Booklet_(spring)") {
        echo "<option value='paper'>Мелованная бумага</option>";
        echo "<option value='carton'>Картон</option>";
        echo "<option value='offset'>Офсетная бумага</option>";
    }
    if ($_GET["product"] == "Booklet_(termo-glue)") {
        echo "<option value='paper'>Мелованная бумага</option>";
    }
    if ($_GET["product"] == "Notebook_(spring)") {
        echo "<option value='paper'>Мелованная бумага</option>";
        echo "<option value='carton'>Картон</option>";
    }
}
?>
