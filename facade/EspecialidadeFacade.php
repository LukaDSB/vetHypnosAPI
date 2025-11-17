<?php
namespace App\Facade;

use App\Models\EspecialidadeModel;
use App\Entity\Especialidade;

class EspecialidadeFacade {
    private $especialidadeModel;

    public function __construct() {
        $this->especialidadeModel = new EspecialidadeModel();
    }

    public function getEspecialidades(): array {
        return $this->especialidadeModel->getEspecialidades();
    }
}