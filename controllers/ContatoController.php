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
    public function deleteContato($id): void {
        try {
            $deletado = $this->contatoFacade->validateAndDeleteContato($id);
            http_response_code(200);
            echo json_encode(["message" => "Contato deletado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}