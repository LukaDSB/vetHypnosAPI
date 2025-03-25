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
    $id = (int) $data['ID'];
    $contato = Contato::fromArray($data);
    return $this->contatoModel->updateContato($id, $contato);
}
public function validateAndDeleteContato(int $id): bool {

    return $this->contatoModel->deleteContato($id);
}


}











?>