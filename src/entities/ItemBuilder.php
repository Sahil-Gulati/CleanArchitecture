<?php
namespace entities;

class ItemBuilder {
    
    public static function getItem($id, $sku, $unitPrice) {
        return new Item(
            $id,
            $sku,
            $unitPrice
        );
    }
}
