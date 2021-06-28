<?php
namespace config\manual;

class Config implements \usecases\interfaces\Config {
    private $repository;
    private $ruleEngine;
    
    public function __construct(\usecases\interfaces\Product $repository, \usecases\interfaces\RuleEngine $ruleEngine) {
        $this->repository = $repository;
        $this->ruleEngine = $ruleEngine;
    }
    public static function getInstance(\usecases\interfaces\Product $repository, \usecases\interfaces\RuleEngine $ruleEngine) {
        return new self($repository, $ruleEngine);
    }
    
    function getRepository() {
        return $this->repository;
    }

    function getRuleEngine() {
        return $this->ruleEngine;
    }

    function setRepository($repository) {
        $this->repository = $repository;
    }

    function setRuleEngine($ruleEngine) {
        $this->ruleEngine = $ruleEngine;
    }
}