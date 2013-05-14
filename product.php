<?php

require_once 'save_product.php';

class product {

    public $data;

    public function product(&$post) {
        foreach ($post as $key => $value) {
            $this->data[$key] = $value;
        }
    }
    
    private function convert_chromacity($chromacity) {
        $tmp = explode(' ', $chromacity);
        return $tmp[0] . 'x' . $tmp[1];
    }

    public function get_array() {

        $result['@attributes'] = array(
            'name' => $this->data['choose-product']
        );

        $result['circulation'] = $this->data['circulation'];

        $result['format'] = $this->data['format-width'] . 'x' . $this->data['format-height'];

        $result['operations'] = array();
        $result['operations']['packing'] = array('@attributes' => array());

        // binding
        if ($this->data['json-product']['is_bind']) {
            $binding_attrs = array(
                'type' => $this->data['json-product']['binding_type'],
                'side' => 'long'
            );
            $result['operations']['binding'] = array(
                '@attributes' => $binding_attrs
            );
        }

        // common operations
        foreach ($this->data['json-product']['common_operations'] as $operation => $description) {
            $result['operations'][$operation]['@attributes'] = $description;
        }

        // tag parts -> block
        $result['parts']['block']['chromacity'] = $this->convert_chromacity($this->data['chromacity']);
        $result['parts']['block']['pages'] = $this->data['pages'];
        $result['parts']['block']['density'] = $this->data['density'];

        // tag parts -> materials        
        $result['parts']['block']['materials']['type'] = $this->data['type'];
        if ($this->data['surface'] != 0) $result['parts']['block']['materials']['surface'] = $this->data['surface'];

        // tag parts -> operations
        $result['parts']['block']['operations'] = array();

        // folding
        if ($this->data['json-product']['is_folded']) {
            $result['parts']['block']['operations']['folding'] = $this->data['json-product']['folding_count'];
        }

        // operation vd
        if ($this->data['vd'] != '0') {
            $temp = explode(' ', $this->data['vd']);
            $vd_attrs['side'] = $temp[0];
            $vd_attrs['type'] = $temp[1];
            $result['parts']['block']['operations']['vd_varnishing'] = array(
                '@attributes' => $vd_attrs
            );
        }

        // operation laminate
        if ($this->data['lamination'] != '0') {
            $temp = explode(' ', $this->data['lamination']);
            $lamination_attrs['side'] = $temp[0];
            $lamination_attrs['type'] = $temp[1];
            $result['parts']['block']['operations']['lamination'] = array(
                '@attributes' => $lamination_attrs
            );
        }

        // operation uf
        if ($this->data['uf'] != '0') {
            $temp = explode(' ', $this->data['uf']);
            $uf_attrs['side'] = $temp[0];
            $uf_attrs['type'] = $temp[1];
            $uf_attrs['selected'] = count($temp) == 3 ? 'true' : 'false';
            $result['parts']['block']['operations']['uf_varnishing'] = array(
                '@attributes' => $uf_attrs
            );
        }

        foreach ($this->data['json-product']['block_operations'] as $operation => $description) {
            $result['parts']['block']['operations'][$operation]['@attributes'] = $description;
        }

        //tag parts -> cover
        if ($this->data['cover'] == 2) {
            $result['parts']['cover']['chromacity'] = $this->convert_chromacity($this->data['cover-chromacity']);
            $result['parts']['cover']['pages'] = $this->data['cover-pages'];
            $result['parts']['cover']['density'] = $this->data['cover-density'];

            // parts -> cover -> materials
            $result['parts']['cover']['materials']['type'] = $this->data['cover-type'];
            if ($this->data['cover-surface'] != 0) $result['parts']['cover']['materials']['surface'] = $this->data['cover-surface'];

            // tag parts -> cover -> operations
            $result['parts']['cover']['operations'] = array();

            // cover operation vd
            if ($this->data['cover-vd'] != '0') {
                $temp = explode(' ', $this->data['cover-vd']);
                $vd_attrs['side'] = $temp[0];
                $vd_attrs['type'] = $temp[1];
                $result['parts']['cover']['operations']['vd_varnishing'] = array(
                    '@attributes' => $vd_attrs
                );
            }

            // cover operation laminate
            if ($this->data['cover-lamination'] != '0') {
                $temp = explode(' ', $this->data['cover-lamination']);
                $lamination_attrs['side'] = $temp[0];
                $lamination_attrs['type'] = $temp[1];
                $result['parts']['cover']['operations']['lamination'] = array(
                    '@attributes' => $lamination_attrs
                );
            }

            // cover operation uf
            if ($this->data['cover-uf'] != '0') {
                $temp = explode(' ', $this->data['cover-uf']);
                $uf_attrs['side'] = $temp[0];
                $uf_attrs['type'] = $temp[1];
                $uf_attrs['selected'] = isset($temp[2]) ? 'true' : 'false';
                $result['parts']['cover']['operations']['uf_varnishing'] = array(
                    '@attributes' => $uf_attrs
                );
            }
        }
        if ($this->data['cover'] == 1) {
            $result['parts']['cover'] = $result['parts']['block'];
            $result['parts']['cover']['pages'] = 4;
        }
        return $result;
    }

}

?>
