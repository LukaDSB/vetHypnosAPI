<?php
namespace App\Entity;

class Especie  {
    private ?int $id;
    private ?string $especie;

    public function __construct(?int $id, ?string $especie) {
        $this->id = $id;
        $this->especie = $especie;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['especie_id']) ? (int) $data['especie_id'] : null,
            $data['especie'],
        );
    }

    public function toArray(): array {
        return [
            'especie_id' => $this->id,
            'especie' => $this->especie,
        ];
    }

    public function getId(): ?int {return $this->id;}
    public function getEspecie():?string {return $this->especie;}
}