<?php
require_once __DIR__ . '/../entity/Contato.php';
error_reporting(E_ALL & ~E_NOTICE);
class ContatoDTO extends Contato{



    public static function fromArray(array $data): self {
        $tipo_contato = null;
        if (!empty($data['tipo_contato_id_ref'])) {
            $tipo_contato = Tipo_Contato::fromArray($data);
        }
        return new self(
            $data['contato_id_ref'] ?? null,
            $data['contato_descricao'] ?? null,
            $data['tipo_contato_id'] ?? null,
            $tipo_contato
        );
    }
}