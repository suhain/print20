<?php

require_once ("xml_to_array.php");
$material_object = new xml_to_array("customs/materials.xml");
$material = $material_object->get_array();
$density = array();
for ($i = 0; $i < count($material); $i++) {
    $density[$material[$i]["type"]][$material[$i]["density"]] = $material[$i]["density"];
}
sort($density["paper"]);
sort($density["carton"]);
sort($density["offset"]);
sort($density["self_adhesive"]);
?>
