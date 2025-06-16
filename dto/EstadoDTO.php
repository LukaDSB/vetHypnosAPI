<?php
require_once __DIR__ . '/../entity/Estado.php';
error_reporting(E_ALL & ~E_NOTICE);
class EstadoDTO extends Estado{
    public static function fromArray(array $data): EstadoDTO {
        return new EstadoDTO(
            isset($data['estado_id']) ? (int) $data['estado_id'] : null,
            $data['estado_nome'],
            
        );
    }
}