<?php

require_once __DIR__ .'/../facade/Categoria_MedicamentoFacade.php';


class Categoria_MedicamentoController{
    private $categoria_medicamentoFacade;
    public function __construct(){
        $this->categoria_medicamentoFacade = new Categoria_MedicamentoFacade();
    }

    public function createCategoria_Medicamento(array $data){
        try{
            $this->categoria_medicamentoFacade->validateAndCreateCategoria_Medicamento($data);
            http_response_code(201);
            echo json_encode(["message" => "Categoria de medicamento criada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateCategoria_Medicamento(array $data){
        try{
            $this->categoria_medicamentoFacade->validateAndUpdateCategoria_Medicamento($data);
            http_response_code(200);
            echo json_encode(["message" => "Categoria de medicamento atualizada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function getAllCategoria_Medicamento(){
        try {
            $categoria_medicamentos = $this->categoria_medicamentoFacade->getCategoria_Medicamentos();
            $response = array_map(fn($categoria_medicamento) => $categoria_medicamento->toArray(), $categoria_medicamentos);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function deleteCategoria_Medicamento(): void {
        // Captura o corpo da requisição (esperando um JSON)
        $requestData = json_decode(file_get_contents("php://input"), true);
    
        // Verifica se o ID foi passado
        if (empty($requestData['ID'])) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "ID do medicamento é obrigatório."]);
            return;
        }
    
        try {
            $deletado = $this->categoria_medicamentoFacade->validateAndDeleteCategoria_Medicamento($requestData);
    
            if ($deletado) {
                http_response_code(200); // OK
                echo json_encode(["message" => "Categoria deletado com sucesso."]);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(["error" => "Categoria não encontrado."]);
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}













?>