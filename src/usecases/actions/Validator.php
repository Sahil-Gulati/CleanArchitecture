<?php
namespace usecases\actions;

trait Validator{
    public function validateItem(\entities\Item $item) {
        if(empty($item->getSku())){
            throw new \InvalidArgumentException("Product sku can't be empty.");
        } if(empty($item->getUnitPrice())){
            throw new \InvalidArgumentException("Product price can't be empty.");
        } if(!is_numeric($item->getUnitPrice())){
            throw new \InvalidArgumentException("Invalid price received.");
        }
    }
}