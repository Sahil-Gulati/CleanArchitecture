<?php
namespace drivers\db\in_memory;

class Repository implements \usecases\interfaces\RulesRepository {
    /**
     * @var adaptors\in_memory_db\DB 
     */
    private $dbInstance;
    
    public static function getInstance($database, $collection, $uniqueKey = "") {
        $repository = new Repository();
        $repository->dbInstance = \drivers\db\in_memory\DB::getInstance($database, $collection, $uniqueKey);
        return $repository;
    }
    
    public function getRules() {
        return json_decode(
            file_get_contents(PROJECT_DIR."/drivers/db/in_memory/rules.json"),
            true
        );
    }
}