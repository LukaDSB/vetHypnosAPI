<?php
require_once __DIR__ . '/../dao/PacienteDAO.php';

class PacienteModel {
    private $pacienteDAO;

    public function __construct() {
        $this->pacienteDAO = new PacienteDAO();
    }

    public function createPaciente  ( $paciente): bool {
        return $this->pacienteDAO->insert($paciente);
    }

    public function getAllPacientes(): array {
        return $this->pacienteDAO->getAllPacientes();
    }
}
?>
