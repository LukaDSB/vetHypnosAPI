<?php 

require_once __DIR__ . '/../models/ContatoModel.php';

class ContatoFacade{
    private $contatoModel ; 

    public function __construct(){
        $this->contatoModel = new ContatoModel();
    }

    public function validateAndCreateContato(array $data): bool {
        $contato = Contato::fromArray($data);
        return $this->contatoModel->createContato($contato);
    }
 

    public function getContato(): array {
        return $this->contatoModel->getAllContatos();
    }

    public function validateAndUpdateContato(array $data): bool {
        $id = (int) $data['id'];
        $contato = Contato::fromArray($data);
        return $this->contatoModel->updateContato($id, $contato);
    }
<<<<<<< HEAD

    public function validateAndDeleteContato(int $id): bool {
        if (empty($id)) {
            throw new InvalidArgumentException("O id do contato é obrigatório para a exclusão.");
        }
        if(!$this->contatoModel->checkId($id)) {
            throw new InvalidArgumentException("O contato com este id nao existe.");
        }
        return $this->contatoModel->deleteContato($id);
=======
    if(!$this->contatoModel->checkId($id)) {
        throw new InvalidArgumentException("O contato com este id nao existe.");
    }
    return $this->contatoModel->deleteContato($id);
>>>>>>> 0096c58 (Ajustes de comentário)
    }
}











?>