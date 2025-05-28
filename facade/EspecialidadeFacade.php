<?php 

require_once __DIR__ . '/../models/EspecialidadeModel.php';

class EspecialidadeFacade{
    private $especialidadeModel ; 

    public function __construct(){
        $this->especialidadeModel = new EspecialidadeModel();
    }

    public function validateAndCreateEspecialidade(array $data): bool {
        $especialidade = Especialidade::fromArray($data);
        return $this->especialidadeModel->createEspecialidade($especialidade);
    }
 

    public function getEspecialidade(): array {
        return $this->especialidadeModel->getAllEspecialidades();
    }

    public function validateAndUpdateEspecialidade(array $data, $id): bool {
        $especialidade = Especialidade::fromArray($data);
        return $this->especialidadeModel->updateEspecialidade($especialidade, $id);
    }

    public function validateAndDeleteEspecialidade($id): bool {
        empty($id) ? throw new InvalidArgumentException("O id da especialidade é obrigatório para a exclusão.") : null;
        return $this->especialidadeModel->deleteEspecialidade($id);
    }
}