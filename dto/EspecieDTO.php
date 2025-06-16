<?php
require_once __DIR__ ."/../entity/Especie.php";
class EspecieDTO extends Especie{
    public static function fromArray(array $data): EspecieDTO {


        return new EspecieDTO(
            isset($data['especie_id']) ? (int) $data['especie_id'] : null,
            $data['especie'],
        );
    }
}