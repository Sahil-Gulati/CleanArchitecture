<?php
namespace interface_adaptors\console;


class Manual {
    public static function checkout() {
        $repository = \drivers\db\in_memory\Repository::getInstance("product", "product_rules");
        
        $pricingRules = \usecases\ItemRules::getInstance($repository)->getRules();
        
        $checkout = new \usecases\Checkout($pricingRules);
        
        $checkout->scan(\entities\ItemBuilder::getItem("1", "A", 50));
        $checkout->scan(\entities\ItemBuilder::getItem("1", "A", 50));
        $checkout->scan(\entities\ItemBuilder::getItem("1", "A", 50));
        $checkout->scan(\entities\ItemBuilder::getItem("1", "A", 50));
        $checkout->scan(\entities\ItemBuilder::getItem("1", "A", 50));
        $checkout->scan(\entities\ItemBuilder::getItem("1", "A", 50));
        $checkout->scan(\entities\ItemBuilder::getItem("1", "B", 50));
        $checkout->scan(\entities\ItemBuilder::getItem("1", "B", 50));
        
        $results = $checkout->total();
        
        echo sprintf("Total price: %d\n", $results["totalPrice"]);
        
    }
}
Manual::checkout();