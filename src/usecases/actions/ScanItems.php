<?php
namespace usecases\actions;

class ScanItems {
    
    private $items = array();
    
    use Validator;
    
    public static function getInstance() {
        $self = new self();
        return $self;
    }
    public function scan(\entities\Item $item) {
        $this->validateItem($item);
        $this->items[] = $item;
    }
    public function getItems() {
        return $this->items;
    }
}   