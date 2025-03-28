<?php


require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dto/Contato.php';

class ContatoDAO{
    private $conn;
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function delete(Int $id) : bool{
        $query = "DELETE FROM contato WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update(int $id, Contato $contato): bool {
         
        $sql = "UPDATE protocolos SET 
                    telefone = :telefone,
                    celular = :celular,
                    email = :email,
                    facebook = :facebook,
                    twitter = :twitter,
                    instagram = :instagram,
                    linkedin = :linkedin,
                    lattes = :lattes,
                    site = :site
                WHERE id = :id";
        
        
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindParam(':telefone', $contato->getTelefone());
        
        $stmt->bindParam(':celular', $contato->getCelular());
        $stmt->bindParam(':email', $contato->getEmail());
        $stmt->bindParam(':facebook', $contato->getFacebook());
        $stmt->bindParam(':twitter', $contato->getTwitter());
        $stmt->bindParam(':instagram', $contato->getInstagram());
        $stmt->bindParam(':linkedin', $contato->getLinkedin());
        $stmt->bindParam(':lattes', $contato->getLattes());
        $stmt->bindParam(':site', $contato->getSite());
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        
        return $stmt->execute();
    }

    public function insert(Contato $contato): bool {
        $query = "INSERT INTO contato (telefone, celular, email, facebook, twitter, instagram, linkedin, lattes, site) VALUES (:telefone, :celular, :email, :facebook, :twitter, :instagram, :linkedin, :lattes, :site)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':telefone', $contato->getTelefone());
        $stmt->bindParam(':celular', $contato->getCelular());
        $stmt->bindParam(':email', $contato->getEmail());
        $stmt->bindParam(':facebook', $contato->getFacebook());
        $stmt->bindParam(':twitter', $contato->getTwitter());
        $stmt->bindParam(':instagram', $contato->getInstagram());
        $stmt->bindParam(':linkedin', $contato->getLinkedin());
        $stmt->bindParam(':lattes', $contato->getLattes());
        $stmt->bindParam(':site', $contato->getSite());

        
        return $stmt->execute();
    }
    public function selectById(int $id): array {
        $query = "SELECT * FROM contato WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $contato = new Contato($result['id'],$result['telefone'], $result['celular'], $result['email'], $result['facebook'], $result['twitter'], $result['instagram'], $result['linkedin'], $result['lattes'], $result['site']);
        return $contato->toArray();
    }

    public function getAllContatos(): array {
        $query = "SELECT * FROM contato";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Contato::fromArray($row);
        }

        return $result;
    }


}












?>