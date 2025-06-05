<?php
require_once __DIR__ .'/../entity/Medicamento.php';
require_once __DIR__ .'/../entity/Estoque.php';
error_reporting(E_ALL & ~E_NOTICE);

class MedicamentoDTO extends Medicamento {
    public static function fromArray(array $data): MedicamentoDTO {
        $categoria_medicamento = null;

        if (!empty($data["categoria_medicamento_id"]) && !empty($data["categoria_medicamento_descricao"])) {
            $categoria_medicamento = new Categoria_Medicamento($data["categoria_medicamento_id"], $data["categoria_medicamento_descricao"]);
        }

        return new MedicamentoDTO(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['concentracao'],
            $data['categoria_medicamento_id'],
            $data['fabricante'],
            $data['lote'],
            $data['validade'],
            $data['quantidade'],
            $categoria_medicamento
        );
    }
}
