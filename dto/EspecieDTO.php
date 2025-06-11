<?php
require_once __DIR__ ."/../entity/Especie.php";
class EspecieDTO extends Especie{
    public static function fromArray(array $data): EspecieDTO {
        $especie = null;

        if (!empty($data["especie_id"]) && !empty($data["especie"])) {
            $especie = new EspecieDTO($data["especie_id"], $data["especie"]);
        }

        return new EspecieDTO(
            isset($data['especie_id']) ? (int) $data['especie_id'] : null,
            $data['especie'],
        );
    }
}