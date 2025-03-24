<?php

require_once __DIR__ .'/../facade/ContatoFacade.php';


class ContatoController{
    private $contatoFacade;
    public function __construct(){
        $this->contatoFacade = new ContatoFacade();
    }

    public function createContato(array $data){
        try{
            $this->contatoFacade->validateAndCreateContato($data);
            http_response_code(201);
            echo json_encode(["message" => "Contato criado com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateContato(array $data){
        try{
            $this->contatoFacade->validateAndUpdateContato($data);
            http_response_code(200);
            echo json_encode(["message" => "Contato atualizado com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function getAllContatos(){
        try {
            $contatos = $this->contatoFacade->getContato();
            $response = array_map(fn($contato) => $contato->toArray(), $contatos);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function deleteContato(): void {

        $requestData = json_decode(file_get_contents("php://input"), true);
    
        // Verifica se o ID foi passado
        if (empty($requestData['ID'])) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "ID do contato é obrigatório."]);
            return;
        }
    
        try {
            $deletado = $this->contatoFacade->validateAndDeleteContato($requestData);
    
            if ($deletado) {
                http_response_code(200); // OK
                echo json_encode(["message" => "Contato deletado com sucesso."]);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(["error" => "Contato não encontrado."]);
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}













?>