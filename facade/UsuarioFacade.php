<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioFacade {
    private $userModel;

    public function __construct() {
        $this->userModel = new UsuarioModel();
    }

    public function validateAndCreateUser(array $data): bool {
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            throw new Exception("Campos nome, email e senha são obrigatórios.");
        }
        try{
            $user = Usuario::fromArray($data);
            return $this->userModel->createUser(user: $user);

        }
        catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function validateAndUpdateUser(array $data): bool {
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            throw new Exception("Campos nome, email e senha são obrigatórios.");
        }
        try{
        $id = $data['id'];
        $user = Usuario::fromArray($data);
        if(!$this->userModel->checkId($id)){
            throw new Exception('O usuario com este id nao existe');
        }
        return $this->userModel->updateUser($user, $id);
        }
        catch(Exception $e){
            throw new Exception($e->getMessage());
        }
        
    }

    public function getUsers(): array {
        return $this->userModel->getAllUsers();
    }
    

    public function getUser($id) {
        $user =  $this->userModel->getUser($id);
         try {
            if($user == null){
                throw new Exception("Nenhum usuario com esse id foi encontrado", 404);
            }
           return $user;
        
        } catch (Exception $e) {
        http_response_code($e->getCode());
        echo json_encode(["message" => $e->getMessage()]);
        exit();
    }
    }

    public function deleteUser($id){
        try {
            if(empty($id)){
                throw new Exception("O ID do usuario e obrigatorio",404);
            }

            if($this->userModel->checkId($id) == null){
                throw new Exception("O usuario com este id nao existe",404);
            }
            $this->userModel->deleteUser($id);
            http_response_code(200);
            echo json_encode(["message" => "Usuário deletado com sucesso."]);
        }
        catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

    public function checkUser($id){
        return $this->userModel->checkId($id);
    }


    }
?>
