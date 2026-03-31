<?php
namespace app\repositories;

class CheckoutRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCheckouts() {
        $stmt = $this->db->query("SELECT id, number FROM checkouts");
        $row= $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $checkout = new Checkout($row['id'], $row['number']);
            return $checkout;
    }
}