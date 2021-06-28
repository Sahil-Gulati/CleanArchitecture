<?php
namespace entities;

class Item {
    private $id;
    private $sku;
    private $unitPrice;
    
    public function __construct($id, $sku, $unitPrice) {
        $this->id = $id;
        $this->sku = $sku;
        $this->unitPrice = $unitPrice;
    }
    function getId() {
        return $this->id;
    }

    function getSku() {
        return $this->sku;
    }

    function getUnitPrice() {
        return $this->unitPrice;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSku($sku) {
        $this->sku = $sku;
    }

    function setUnitPrice($unitPrice) {
        $this->unitPrice = $unitPrice;
    }

}