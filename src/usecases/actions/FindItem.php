<?php
namespace usecases\actions;

class FindProduct {
    
    protected $repository;
     
    public function __construct(\usecases\interfaces\Product $repository) {
        $this->repository = $repository;
    }
    public function getAll() {
        return $this->repository->searchAll();
    }
}