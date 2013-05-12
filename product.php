<?php

require_once 'save_product.php';

class product {

    public $data;

    public function product(&$post) {
        foreach ($post as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    public function get_array() {

        $result['attrs'] = array(
            'name' => $this->data['choose-product']
        );

        $result['circulation'] = $this->data['circulation'];

        if (isset($this->data['format-height']) && isset($this->data['format-width'])) {
            $result['format'] = $this->data['format-width'] . 'x' . $this->data['format-height'];
        } else {
            exit("Bug in the formats");
            $result['format'] = $this->data['format-product'];
        }

        $result['operations'] = array();
        $result['operations']['packing'] = array('attrs' => array());
        // operation impression
        if ($this->data['impression-width'] != '' && $this->data['impression-height'] != '' && $this->data['impression-times'] != '') {
            $impression_attrs = array(
                'format' => $this->data['impression-height'] . 'x' . $this->data['impression-width'],
                'times' => $this->data['impression-times']
            );
            $result['operations']['impression'] = array(
                'attrs' => $impression_attrs
            );
        }

        // operation stamping
        if ($this->data['stamping-width'] != '' && $this->data['stamping-height'] != '' && $this->data['stamping-times'] != '') {
            $stamping_attrs = array(
                'format' => $this->data['stamping-height'] . 'x' . $this->data['stamping-width'],
                'times' => $this->data['stamping-times']
            );
            $result['operations']['stamping'] = array(
                'attrs' => $stamping_attrs
            );
        }
        
        // binding
        if ($this->data['json-product']['is_bind']) {
            $binding_attrs = array(
                'type' => $this->data['json-product']['binding_type'],
                'side' => 'long'
            );
            $result['operations']['binding'] = array(
                'attrs' => $binding_attrs
            );
        }
        
        // common operations
        foreach ($this->data['json-product']['common_operations'] as $operation => $description) {
            $result['operations'][$operation]['attrs'] = $description;
        }

        // tag parts -> block
        $result['parts']['block']['chromacity'] = $this->data['chromacity'];
        $result['parts']['block']['pages'] = $this->data['pages'];
        $result['parts']['block']['density'] = $this->data['density'];

        // tag parts -> materials        
        $result['parts']['block']['materials']['type'] = $this->data['type'];
        $result['parts']['block']['materials']['surface'] = $this->data['surface'];

        // tag parts -> operations
        $result['parts']['block']['operations'] = array();

        // folding
        if ($this->data['json-product']['is_folded']) {
            $result['parts']['block']['operations']['folding'] = $this->data['json-product']['folding_count'];
        }
        
        // operation vd
        if ($this->data['vd'] != 'no') {
            $temp = explode(' ', $this->data['vd']);
            $vd_attrs['side'] = $temp[0];
            $vd_attrs['type'] = $temp[1];
            $result['parts']['block']['operations']['vd_varnishing'] = array(
                'attrs' => $vd_attrs
            );
        }

        // operation laminate
        if ($this->data['lamination'] != 'no') {
            $temp = explode(' ', $this->data['lamination']);
            $lamination_attrs['side'] = $temp[0];
            $lamination_attrs['type'] = $temp[1];
            $result['parts']['block']['operations']['lamination'] = array(
                'attrs' => $lamination_attrs
            );
        }

        // operation uf
        if ($this->data['uf'] != 'no') {
            $temp = explode(' ', $this->data['uf']);
            $uf_attrs['side'] = $temp[0];
            $uf_attrs['type'] = $temp[1];
            $uf_attrs['selected'] = isset($this->data['choose_uf']) ? 'true' : 'false';
            $result['parts']['block']['operations']['uf_varnishing'] = array(
                'attrs' => $uf_attrs
            );
        }
        
        foreach ($this->data['json-product']['block_operations'] as $operation => $description) {
            $result['parts']['block']['operations'][$operation]['attrs'] = $description;
        }

        //tag parts -> cover
        if ($this->data['json-product']['type'] == 'multipage') {
            $result['parts']['cover']['chromacity'] = $this->data['cover-chromacity'];
            $result['parts']['cover']['pages'] = $this->data['cover-pages'];
            $result['parts']['cover']['density'] = $this->data['cover-density'];

            // parts -> cover -> materials
            $result['parts']['cover']['materials']['type'] = $this->data['cover-type'];
            $result['parts']['cover']['materials']['surface'] = $this->data['cover-surface'];

            // tag parts -> cover -> operations
            $result['parts']['cover']['operations'] = array();

            // cover operation vd
            if ($this->data['cover-vd'] != 'no') {
                $temp = explode(' ', $this->data['cover-vd']);
                $vd_attrs['side'] = $temp[0];
                $vd_attrs['type'] = $temp[1];
                $result['parts']['cover']['operations']['vd_varnishing'] = array(
                    'attrs' => $vd_attrs
                );
            }

            // cover operation laminate
            if ($this->data['cover-lamination'] != 'no') {
                $temp = explode(' ', $this->data['cover-lamination']);
                $lamination_attrs['side'] = $temp[0];
                $lamination_attrs['type'] = $temp[1];
                $result['parts']['cover']['operations']['lamination'] = array(
                    'attrs' => $lamination_attrs
                );
            }

            // cover operation uf
            if ($this->data['cover-uf'] != 'no') {
                $temp = explode(' ', $this->data['cover-uf']);
                $uf_attrs['side'] = $temp[0];
                $uf_attrs['type'] = $temp[1];
                $uf_attrs['selected'] = isset($this->data['choose_cover_uf']) ? 'true' : 'false';
                $result['parts']['cover']['operations']['uf_varnishing'] = array(
                    'attrs' => $uf_attrs
                );
            }
        }
        return $result;
    }

}

?>
