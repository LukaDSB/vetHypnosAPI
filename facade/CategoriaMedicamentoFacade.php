<?php 
namespace App\Facade;

use App\Models\CategoriaMedicamentoModel;

class CategoriaMedicamentoFacade{
    private $categoriaMedicamentoModel;

    public function __construct(){
        $this->categoriaMedicamentoModel = new CategoriaMedicamentoModel();
    }

    public function validateAndCreateCategoria_Medicamento(array $data): bool {
        $categoriaMedicamento = Categoria_Medicamento::fromArray($data);

        return $this->categoriaMedicamentoModel->createCategoria_Medicamento($categoria_medicamento);
    }
 
    public function getCategoriaMedicamentos(): array {
        return $this->categoriaMedicamentoModel->getAllCategorias();
    }

public function validateAndUpdateCategoriaMedicamento(array $data, int $id): bool {
    if(empty($id || $id<0)){
        throw new InvalidArgumentException('O id é obrigatório necessário e deve ser válido');
    }
    if(!$this->categoriaMedicamentoModel->checkId($id)){
        throw new InvalidArgumentException('A categoria com este id não existe');
    }
    $categoria_medicamento = Categoria_Medicamento::fromArray($data);
    return $this->categoriaMedicamentoModel->updateCategoriaMedicamento($id, $categoria_medicamento);
}
public function validateAndDeleteCategoria_Medicamento(int $id): bool{
    
    if(!$this->categoriaMedicamentoModel->checkId($id)){
        throw new InvalidArgumentException('A categoria com este id não existe');
    }
    return $this->categoriaMedicamentoModel->deleteCategoriaMedicamento($id);
}
}