<?php
require_once __DIR__ ."/../entity/Especie.php";
class EspecieDTO extends Especie{
    public static function fromArray(array $data): EspecieDTO {

        return new EspecieDTO(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['especie'],
        );
    }
}