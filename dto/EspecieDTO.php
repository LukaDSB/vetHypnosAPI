<?php
namespace App\DTO;

use App\Entity\Especie;
class EspecieDTO extends Especie{
    public static function fromArray(array $data): EspecieDTO {

        return new EspecieDTO(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['especie'],
        );
    }
}