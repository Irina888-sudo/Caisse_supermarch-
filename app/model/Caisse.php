<?php
namespace app\models;

class Caisse
{
    private ?int $id_caisse = null;
    private string $numero_caisse;

    public function __construct(string $numero_caisse)
    {
        $this->numero_caisse = $numero_caisse;
    }

    // Getters
    public function getId(): ?int { return $this->id_caisse; }
    public function getNumeroCaisse(): string { return $this->numero_caisse; }

    // Setters
    public function setNumeroCaisse(string $numero_caisse): void
    {
        $this->numero_caisse = $numero_caisse;
    }

    public function setId(int $id): void
    {
        $this->id_caisse = $id;
    }
}