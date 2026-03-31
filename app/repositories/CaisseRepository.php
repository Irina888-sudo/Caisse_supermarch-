<?php
namespace app\repositories;

use app\models\Caisse;
use PDO;

class CaisseRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM Caisse");
        $caisses = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $caisse = new Caisse($row['numero_caisse']);
            $caisse->setId($row['id_caisse']);
            $caisses[] = $caisse;
        }

        return $caisses;
    }
}