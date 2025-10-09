<?php
namespace App\Controllers;

use App\Facade\ProntuarioFacade;

class ProntuarioController {
    private $prontuarioFacade;

    public function __construct() {
        $this->prontuarioFacade = new ProntuarioFacade();
    }

    public function createProntuario(array $data): void {
        try {
            $this->prontuarioFacade->createProntuario($data);
            http_response_code(201);
            echo json_encode(["message" => "Prontuario criada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllProntuarios(): void {
        try {
            $prontuario = $this->prontuarioFacade->getprontuario();
            $response = array_map(fn($prontuario) => $prontuario->toArray(), $prontuario);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

     public function getProntuarioById(int $id): void {
        try {
            $prontuarioDto = $this->prontuarioFacade->getProntuarioById($id);

            if ($prontuarioDto) {
                http_response_code(200);
                echo json_encode($prontuarioDto->toArray()); 
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Prontuário não encontrado."]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao buscar prontuário: " . $e->getMessage()]);
        }
    }

    public function deleteProntuario($id){
        try {
            $this->prontuarioFacade->validateAndDeleteProntuario($id);
            http_response_code(201);
            echo json_encode(["message" => "Prontuario deletada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateProntuario($id, array $data): void {
        try {
            $this->prontuarioFacade->updateProntuario( $id, $data);
            http_response_code(201);
            echo json_encode(["message" => "Prontuario alterada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}