<?php
class Checkout {
    private $id;
    private $number;

    public function __construct($id, $number) {
        $this->id = $id;
        $this->number = $number;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumber() {
        return $this->number;
    }
}