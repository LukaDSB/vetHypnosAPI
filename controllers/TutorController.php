<?php
require_once __DIR__ . '/../facade/TutorFacade.php';

class TutorController {
    private $tutorFacade;

    public function __construct() {
        $this->tutorFacade = new TutorFacade();
    }

    public function createTutor(array $data): void {
        try {
            $this->tutorFacade->createTutor($data);
            http_response_code(201);
            echo json_encode(["message" => "Tutor criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllTutores(): void {
        try {
            $tutores = $this->tutorFacade->getAll();
            $response = array_map(fn($animal) => $animal->toArray(), $tutores);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getTutorById(int $id) {
        try {
            $tutor = $this->tutorFacade->getById($id);
            $response = $tutor->toArray();
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateTutor($id, array $data): void {
        try {
            $this->tutorFacade->update($id, $data);
            http_response_code(200);
            echo json_encode(["message" => "Tutor atualizado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function delete($id){
        try {
            $this->tutorFacade->delete($id);
            http_response_code(200);
            echo json_encode(["message" => "Tutor excluído com sucesso."]);
        } catch (\Throwable $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}