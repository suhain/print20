<?php

class xml_to_array {

    private $object;
    private $array;

    public function __construct($path_to_xml) {
        if (file_exists($path_to_xml)) {
            $this->object = simplexml_load_file($path_to_xml);
            foreach ($this->object->paper as $paper) {
                $paper = (array) $paper->attributes();
                $this->array[] = $paper["@attributes"];
            }
        } else {
            exit("File " . $path_to_xml . " can not found.");
        }
    }

    public function get_array() {
        return $this->array;
    }

}

?>
