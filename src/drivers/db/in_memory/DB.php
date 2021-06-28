<?php
namespace drivers\db\in_memory;

class DB {
    private $db = null;
    private $collection = null;
    private $collectionUniqueKey = array();
    private $memory = array();
    private static $stInstance = null;
    
    /**
     * 
     * @param String $database
     * @param String $collection
     * @param String $uniqueKey
     * @return drivers\in_memory\DB
     */
    public static function getInstance($database, $collection, $uniqueKey) {
        if(!is_null(self::$stInstance)){
            return self::$stInstance;
        }
        return self::getNewInstance($database, $collection, $uniqueKey);
    }
    public function add($value) {
        $this->memory[$this->db][$this->collection][] = $value;
    }
    public function delete($value) {
        $collectionUniqueKey = $this->collectionUniqueKey[$this->collection];
        if(isset($value[$collectionUniqueKey])){
            $uniqueId = $value[$collectionUniqueKey];
            unset($this->memory[$uniqueId]);
        }
    }
    public function search($value) {
        $collectionUniqueKey = $this->collectionUniqueKey[$this->collection];
        if(isset($value[$collectionUniqueKey])){
            $uniqueId = $value[$collectionUniqueKey];
            if(isset($this->memory[$uniqueId])){
                return $this->memory[$uniqueId];
            }
        }
        return null;
    }
    public function searchAll() {
        return $this->memory[$this->db][$this->collection];
    }
    private static function getNewInstance($database, $collection, $uniqueKey="id") {
        $db = new DB;
        $db->db = $database;
        $db->collection = $collection;
        $db->collectionUniqueKey[$collection] = $uniqueKey;
        return $db;
    }
}