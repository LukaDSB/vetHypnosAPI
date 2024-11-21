<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Paciente.php';


class PacienteController {
    private $conn;
    private $paciente;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->paciente = new Paciente($this->conn);
    }

    public function getAllPacientes() {
        $stmt = $this->paciente->read();
        $pacientes_arr = array();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $paciente_item = array(
                "id" => $id,
                "nome" => $nome,
                "especie" => $especie,
                "idade" => $idade,
                "sexo" => $sexo,
                "peso" => $peso
            );
            array_push($pacientes_arr, $paciente_item);
        }

        http_response_code(200);
        echo json_encode($pacientes_arr);
    }
}
