<?php
namespace App\Controllers;

use App\Facade\EspecialidadeFacade;

class EspecialidadeController {
    private $especialidadeFacade;

    public function __construct() {
        $this->especialidadeFacade = new EspecialidadeFacade();
    }


    public function getEspecialidades(): void {
        try {
            $especialidade = $this->especialidadeFacade->getEspecialidades();
            $response = array_map(fn($especialidade) => $especialidade->toArray(), $especialidade);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}