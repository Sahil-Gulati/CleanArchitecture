<?php
namespace drivers\rule_engine;

class RuleEngine implements \usecases\interfaces\RuleEngine{
    
    private $ruleBook = array();
    private static $filename = PROJECT_DIR."drivers/rule_engine/rules.json";
    
    public static function getInstance() {
        $ruleEngine  = new RuleEngine();
        $ruleEngine->ruleBook = json_decode(file_get_contents(self::$filename), true);
        return $ruleEngine;
    }
    public function applyRules(array &$prices = array()) {
        $rules = $this->getContent($this->ruleBook, array("price", "discount"));
        foreach($rules as $rule){
            foreach($rule["when"] as $condition){
                if($this->applyPercentageCondition($condition, $prices, $rule["percentage"])){
                    return true;
                }
            }
        }
    }
    private function applyPercentageCondition(array $condition=array(), &$prices, $percentage) {
        switch ($condition["condition"]){
            case "gte":
                foreach($prices as $variableName => &$value){
                    $condition["variable"] = str_replace(sprintf("{%s}", $variableName), $value, $condition["variable"]);
                    if($condition["variable"] >= $condition["value"]){
                        $value =  ((100 - $percentage) * $prices[$variableName])/100;
                        return true;
                    }
                }
                break;
        }
    }
    public function getContent(array $ruleBook = array(), array $contents = array()) {
        if(count($contents) == 0){
            return $ruleBook;
        }
        foreach($ruleBook as $key => $value) {
            if($key === $contents[0]){
                array_shift($contents);
                return $this->getContent($value, $contents);
            }
        }
    }
}