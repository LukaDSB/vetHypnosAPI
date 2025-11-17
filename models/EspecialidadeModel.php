<?php
namespace App\Models;

use App\DAO\EspecialidadeDAO;

class EspecialidadeModel {
    private $especialidadeDAO;

    public function __construct() {
        $this->especialidadeDAO = new EspecialidadeDAO();
    }

    public function getEspecialidades(): array {
        return $this->especialidadeDAO->getEspecialidades();
    }
}