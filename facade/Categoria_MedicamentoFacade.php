<?php 

require_once __DIR__ . '/../models/Categoria_MedicamentoModel.php';

class Categoria_MedicamentoFacade{
    private $categoria_medicamentoModel;

    public function __construct(){
        $this->categoria_medicamentoModel = new Categoria_MedicamentoModel();
    }

    public function validateAndCreateCategoria_Medicamento(array $data): bool {
        $categoria_medicamento = Categoria_Medicamento::fromArray($data);

        return $this->categoria_medicamentoModel->createCategoria_Medicamento($categoria_medicamento);
    }
 
    public function getCategoria_Medicamentos(): array {
        return $this->categoria_medicamentoModel->getAllCategorias();
    }

public function validateAndUpdateCategoria_Medicamento(array $data): bool {
    $id = (int) $data['ID'];
    $categoria_medicamento = Categoria_Medicamento::fromArray($data);
    return $this->categoria_medicamentoModel->updateCategoria_Medicamento($id, $categoria_medicamento);
}
public function validateAndDeleteCategoria_Medicamento(array $data): bool {
    if (empty($data['ID'])) {
        throw new InvalidArgumentException("O ID da categoria é obrigatório para a exclusão.");
    }
 
    $id = (int) $data['ID'];

    // Se necessário, verifique se o ID existe antes de deletar
    return $this->categoria_medicamentoModel->deleteCategoria_Medicamento($id);
}


}











?>