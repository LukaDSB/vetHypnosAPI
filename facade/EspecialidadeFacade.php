<?php
require_once __DIR__ . '/../models/EspecialidadeModel.php';

class EspecialidadeFacade {
    private $especialidadeModel;

    public function __construct() {
        $this->especialidadeModel = new EspecialidadeModel();
    }

    public function getEspecialidade($id) {
        
        return $this->especialidadeModel->getEspecialidade($id);
        
    }

    public function getAllEspecialidades(): array {
        return $this->especialidadeModel->getAllEspecialidades();
    }
}
?>
