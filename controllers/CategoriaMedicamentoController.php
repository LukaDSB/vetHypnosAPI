<?php
namespace App\Controllers;

use App\Facade\CategoriaMedicamentoFacade;

class CategoriaMedicamentoController{
    private $categoriaMedicamentoFacade;
    public function __construct(){
        $this->categoriaMedicamentoFacade = new CategoriaMedicamentoFacade();
    }

    public function createCategoriaMedicamento(array $data){
        try{
            $this->categoriaMedicamentoFacade->validateAndCreateCategoriaMedicamento($data);
            http_response_code(201);
            echo json_encode(["message" => "Categoria de medicamento criada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateCategoriaMedicamento(array $data, int $id){
        try{
            $this->categoriaMedicamentoFacade->validateAndUpdateCategoriaMedicamento($data, $id);
            http_response_code(200);
            echo json_encode(["message" => "Categoria de medicamento atualizada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function getAllCategoriaMedicamento(){
        try {
            $categoriaMedicamentos = $this->categoriaMedicamentoFacade->getCategoriaMedicamentos();
            $response = array_map(fn($categoriaMedicamento) => $categoriaMedicamento->toArray(), $categoriaMedicamentos);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function deleteCategoriaMedicamento($id): void {

    
        if (empty($id)) {
            http_response_code(400);
            echo json_encode(["error" => "id do medicamento é obrigatório."]);
        }
    
        try {
            $deletado = $this->categoriaMedicamentoFacade->validateAndDeleteCategoriaMedicamento($id);
    
            if ($deletado) {
                http_response_code(200);
                echo json_encode(["message" => "Categoria deletado com sucesso."]);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Categoria não encontrado."]);
                } 
                http_response_code(200);
                echo json_encode(["message" => "Categoria deletado com sucesso."]);
            
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}