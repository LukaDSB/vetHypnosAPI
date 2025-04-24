<?php
require_once __DIR__ . '/../facade/AnimalFacade.php';

class AnimalController {
    private $animalFacade;

    public function __construct() {
        $this->animalFacade = new AnimalFacade();
    }

    public function createAnimal(array $data): void {
        try {
            $this->animalFacade->createAnimal($data);
            http_response_code(201);
            echo json_encode(["message" => "Paciente criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllAnimais(): void {
        try {
            $animal = $this->animalFacade->getAnimais();
            $response = array_map(fn($animal) => $animal->toArray(), $animal);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function delete(int $id){
        try {
            $this->animalFacade->delete($id);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}
?>
