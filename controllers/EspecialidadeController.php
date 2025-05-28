<?php

require_once __DIR__ .'/../facade/EspecialidadeFacade.php';


class EspecialidadeController{
    private $especialidadeFacade;
    public function __construct(){
        $this->especialidadeFacade = new EspecialidadeFacade();
    }

    public function createEspecialidade(array $data){
        try{
            $this->especialidadeFacade->validateAndCreateEspecialidade($data);
            http_response_code(201);
            echo json_encode(["message" => "Especialidade criada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateEspecialidade(array $data, $id){
        try{
            $this->especialidadeFacade->validateAndUpdateEspecialidade($data, $id);
            http_response_code(200);
            echo json_encode(["message" => "Especialidade atualizada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function getAllEspecialidades(){
        try {
            $especialidades = $this->especialidadeFacade->getEspecialidade();
            $response = array_map(fn($especialidade) => $especialidade->toArray(), $especialidades);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    public function deleteEspecialidade($id): void {
        try {
            $deletada = $this->especialidadeFacade->validateAndDeleteEspecialidade($id);
            http_response_code(200);
            echo json_encode(["message" => "Especialidade deletada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}