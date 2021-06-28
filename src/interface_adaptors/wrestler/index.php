<?php

namespace application\manual;

define("PROJECT_DIR", "/var/www/php/CleanArchitecture/src/");
require_once PROJECT_DIR.'adaptors/loader/registerar.php';

class Manual {
    public static function test() {
        $ruleEngine = \adaptors\rule_engine\RuleEngine::getInstance();
        $respository = \adaptors\in_memory\Repository::getInstance("database", "collection","id");    
        
        $addProduct = new \usecases\AddProduct($respository, $ruleEngine);
        $addProduct->scan(new \entities\Product("1", "X", 200));
        $addProduct->scan(new \entities\Product("2", "Y", 300));
        $addProduct->scan(new \entities\Product("3", "Z", 500));
        $results = $addProduct->total();
        
        print_r($results);
        
    }
}
Manual::test();