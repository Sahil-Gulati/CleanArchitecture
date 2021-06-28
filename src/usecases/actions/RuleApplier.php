<?php
namespace usecases\actions;

class RuleApplier {
    protected $repository;
    protected $ruleEngine;
    
    public static function getInstance() {
        $self = new self();
        return $self;
    }

    public function applyRules($items, $rules) {
        $mergedItems = $this->mergeProducts($items);
        $mergedItems = $this->checkRules($rules, $mergedItems);
        return $mergedItems;
    }
    private function checkRules($rules, $items) {
        foreach($rules as $rule){
            switch($rule["type"]) {
                case "QUANTITY_BENEFIT":
                    $items = $this->applyQuantitativeBenefits($items, $rule);
                    break;
            }
        }
        return $items;
    }
    private function applyQuantitativeBenefits($items, $rule) {
        $ruleSku = $rule["sku"];
        $ruleQuantity = $rule["quantity"];
        if(isset($items[$ruleSku])){
            $item = $items[$ruleSku];
            $item["completePrice"] = (
                    (($item["quantity"] % $ruleQuantity) * $item["price"]) + 
                    (intval($item["quantity"] / $ruleQuantity) * $rule["totalPrice"])
            );
            $items[$ruleSku] = $item;
        }
        return $items;
    }
    private function mergeProducts($items) {
        $uniqueProducts = array();
        foreach($items as $item){
            $id = $item->getSku();
            if(isset($uniqueProducts[$id])){
                $uniqueProducts[$id]["quantity"] += 1;
                $uniqueProducts[$id]["totalPrice"] = $uniqueProducts[$id]["price"] * $uniqueProducts[$id]["quantity"];
                continue;
            } 
            $uniqueProducts[$id] = self::mapItemToArray($item);
            $uniqueProducts[$id]["quantity"] = 1;
            $uniqueProducts[$id]["totalPrice"] = $uniqueProducts[$id]["price"] * $uniqueProducts[$id]["quantity"];
        }
        return $uniqueProducts;
    }
    
    private static function mapItemToArray($item) {
        return array(
            "sku" => $item->getSku(), 
            "price" => $item->getUnitPrice()
        );
    }
}