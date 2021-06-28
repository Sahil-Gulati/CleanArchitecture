<?php

namespace usecases\interfaces;


interface RuleEngine {
    public function applyRules(array &$prices = array());
}