<?php
namespace App\DTO;

use App\Entity\Medicamento;
use App\Entity\Estoque;
use App\DTO\CategoriaMedicamentoDTO;

error_reporting(E_ALL & ~E_NOTICE);

class MedicamentoDTO extends Medicamento {
    public static function fromArray(array $data): MedicamentoDTO {
        $categoria_medicamento = null;

        if (!empty($data["categoria_medicamento_id"]) && !empty($data["categoria_medicamento_descricao"])) {
            $categoria_medicamento = new CategoriaMedicamentoDTO($data["categoria_medicamento_id"], $data["categoria_medicamento_descricao"]);
        }

        return new MedicamentoDTO(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['concentracao'],
            $data['categoria_medicamento_id'],
            $data['fabricante'],
            $data['lote'],
            $data['validade'],
            $data['dose_min'],
            $data['dose_max'],
            $data['quantidade'],
            $categoria_medicamento
        );
    }
}
