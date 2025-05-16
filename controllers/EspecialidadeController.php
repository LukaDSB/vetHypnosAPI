<?php
require_once __DIR__ . '/../facade/EspecialidadeFacade.php';

class EspecialidadeController {
    private $especialidadeFacade;

    public function __construct() {
        $this->especialidadeFacade = new EspecialidadeFacade();
    }

    public function getAllEspecialidades(): void {
        try {
            $especialidades = $this->especialidadeFacade->getAllEspecialidades();
            $response = array_map(fn($especialidade) => $especialidade->toArray(), $especialidades);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getEspecialidade($id): void {
        
        try {
            $especialidade = $this->especialidadeFacade->getEspecialidade($id);
            if($especialidade == null){
                throw new Exception("Nenhuma especialiade com esse id foi encontrada", 404);
            }
            
            $response = $especialidade->toArray(  );
            http_response_code(200);
            echo json_encode($response);
        
        } catch (Exception $e) {
        http_response_code($e->getCode());
        echo json_encode(["message" => $e->getMessage()]);
    }

    }


    
    
}
?>
