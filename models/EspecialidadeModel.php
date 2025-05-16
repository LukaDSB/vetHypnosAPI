<?php
require_once __DIR__ . '/../dao/EspecialidadeDAO.php';

class EspecialidadeModel {
    private $especialidadeDAO;

    public function __construct() {
        $this->especialidadeDAO = new EspecialidadeDAO();
    }

    public function getEspecialidade($id) {
        return $this->especialidadeDAO->selectById($id);
    }

    public function getAllEspecialidades(): array {
        return $this->especialidadeDAO->getAllEspecialidades();
    }
}
?>
