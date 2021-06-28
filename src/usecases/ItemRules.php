<?php
namespace usecases;

class ItemRules {
   
    private $repository = null;
    
    public static function getInstance(\usecases\interfaces\RulesRepository $rulesRepository) {
        $self = new self();
        $self->repository = $rulesRepository;
        return $self;
    }
    public function getRules () {
        return $this->repository->getRules();
    }
}