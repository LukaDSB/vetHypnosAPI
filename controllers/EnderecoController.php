<?php
namespace App\Controllers;

use App\Facade\EnderecoFacade;

require_once __DIR__ ."/../facade/EnderecoFacade.php";

class EnderecoController{
    
    private $enderecoFacade;
    public function __construct(){
        $this->enderecoFacade = new EnderecoFacade();
    }

    public function createEndereco($data){
        try{
            $this->enderecoFacade->createEndereco($data);
            http_response_code(201);
            echo json_encode(["message" => "Endereco criado com sucesso(a)."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllEnderecos(){
       try {
            $enderecos = $this->enderecoFacade->getAllEnderecos();
            $response = array_map(fn($endereco) => $endereco->toArray(), $enderecos);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getEndereco($id){
        try{
            $estado = $this->enderecoFacade->getEnedereco($id);
            $response = $estado->toArray();
            http_response_code(200);
            echo json_encode($response);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

    public function updateEndereco($id, $data){
        try{
            $this->enderecoFacade->updateEndereco($id, $data);
            http_response_code(201);
            echo json_encode(["message" => "Endereco atualizado com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteEndereco($id){
        try{
            $this->enderecoFacade->deleteEndereco($id);
            http_response_code(200);
            echo json_encode(["message"=> "Endereco deletado com sucesso"]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

}