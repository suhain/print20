<?php

    class save_product 
    {    
        public $name, $name_ru, $binding_type; #string
        public $formats; #array[string]
        public $is_folded, $is_bind, $type, $is_mono_picture; #bool
        public $pages_on_spread, $folding_count; #int
        public $common_operations, $block_operations;
    
        function save_product($jsonProduct)
        {
            $this->name = $jsonProduct['name'];
            $this->name_ru = $jsonProduct['name_ru'];
            $this->formats = $jsonProduct['formats'];
            $this->is_folded = $jsonProduct['is_folded'];
            $this->is_bind = $jsonProduct['is_bind'];
            $this->type = $jsonProduct['type'];
            $this->binding_type = $jsonProduct['binding_type'];
            $this->is_mono_picture = $jsonProduct['is_mono_picture'];
            $this->bindingType = $jsonProduct['binding_type'];
            $this->pages_on_spread = $jsonProduct['pages_on_spread'];
            $this->folding_count = $jsonProduct['folding_count'];
            $this->common_operations = $jsonProduct['common_operations'];
            $this->block_operations = $jsonProduct['block_operations'];
        }
    }
    
    $product_file = file_get_contents("product.json");
    $obj = json_decode($product_file, true);
//    var_dump($obj);

    $cnt = 0;
    $p = array();
    $prod = array();
    $prod_array = array();
    foreach($obj as $product)
    {
        for ($i = 0; $i < strlen($product['name']); $i++)
            if ($product['name'][$i] == ' ')
                $product['name'][$i] = '_';

        $prod_array[$cnt++] = new save_product($product);
        $p = new save_product($product);
        $prod[$p->name] = (array) $p;
    }
?>
