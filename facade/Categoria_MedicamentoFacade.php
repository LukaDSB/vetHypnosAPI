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

public function validateAndUpdateCategoria_Medicamento(array $data, int $id): bool {
    if(empty($id || $id<0)){
        throw new InvalidArgumentException('O id é obrigatório necessário e deve ser válido');
    }
    if(!$this->categoria_medicamentoModel->checkId($id)){
        throw new InvalidArgumentException('A categoria com este id não existe');
    }
    $categoria_medicamento = Categoria_Medicamento::fromArray($data);
    return $this->categoria_medicamentoModel->updateCategoria_Medicamento($id, $categoria_medicamento);
}
public function validateAndDeleteCategoria_Medicamento(int $id): bool{
    
    if(!$this->categoria_medicamentoModel->checkId($id)){
        throw new InvalidArgumentException('A categoria com este id não existe');
    }
    return $this->categoria_medicamentoModel->deleteCategoria_Medicamento($id);

}


}











?>