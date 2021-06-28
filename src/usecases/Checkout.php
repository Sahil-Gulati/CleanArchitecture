<?php
namespace usecases;

class Checkout {
    private $rules = array();
    private $scanItems = null;
    private $ruleApplier =  null;
    private $itemsGenerated = array();

    public function __construct(array $rules = array()) {
        $this->rules = $rules;
        $this->scanItems = \usecases\actions\ScanItems::getInstance();
        $this->ruleApplier = \usecases\actions\RuleApplier::getInstance();
    }
    public function scan(\entities\Item $item) {
        $this->scanItems->scan($item);
    }
    public function total() {
        $items = $this->scanItems->getItems();
        $this->itemsGenerated = $this->ruleApplier->applyRules($items, $this->rules);
        return $this->getAggregatedSum($this->itemsGenerated);
    }
    private function getAggregatedSum($items) {
        $count = 0;
        $aggregatedResult = array();
        foreach($items as $item){
            @$aggregatedResult["count"] += $item["quantity"];
            @$aggregatedResult["totalPrice"] += $item["totalPrice"];
            @$aggregatedResult["discountedPrice"] += $item["completePrice"];
        }
        return $aggregatedResult;
    }
}

