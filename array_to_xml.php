<?php

/*
 * 
 */

class array_to_xml {

    private $writer;
    private $version = '1.0';
    private $encoding = 'UTF-8';
    private $rootName = 'product';

    public function __construct() {
        $this->writer = new XMLWriter();
    }

    public function convert($data) {
        $this->writer->openMemory();
        $this->writer->startDocument($this->version, $this->encoding);
        $this->writer->startElement($this->rootName);
        if (is_array($data)) {
            $this->getXML($data);
        }
        $this->writer->endElement();
        return $this->writer->outputMemory();
    }

    public function setVersion($version) {
        $this->version = $version;
    }

    public function setEncoding($encoding) {
        $this->encoding = $encoding;
    }

    public function setRootName($rootName) {
        $this->rootName = $rootName;
    }

    private function getXML($data) {
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                if ($key == 'attrs') {
                    $attrs = & $val;
                    foreach ($attrs as $name_attr => $value_attr) {
                        $this->writer->writeAttribute($name_attr, $value_attr);
                    }
                } else {
                    $this->writer->startElement($key);
                    $this->getXML($val);
                    $this->writer->endElement();
                }
            } else {
                if ($val != null) {
                    $this->writer->writeElement($key, $val);
                }
            }
        }
    }

}

//end of Array2XML.php
?>
