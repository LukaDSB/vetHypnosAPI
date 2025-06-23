<?php
require_once __DIR__ . '/../entity/Contato.php';
error_reporting(E_ALL & ~E_NOTICE);
class ContatoDTO extends Contato{



    public static function fromArray(array $data): self {
        $tipo_contato = null;
        if (!empty($data['tipo_contato_id']) && !empty($data['tipo_contato_descricao'])) {
            $tipo_contato = Tipo_Contato::fromArray($data);
        }
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['contato_descricao'],
            $data['tipo_contato_id'],
            $tipo_contato
        );
    }
}