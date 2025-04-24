<?php
class Especie  {
    private ?int $id;
    private ?string $especie;

    public function __construct(?int $id, ?string $especie) {
        $this->id = $id;
        $this->especie = $especie;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['especie'],
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'especie' => $this->especie,
        ];
    }
}