<?php
namespace App\DAO;

use App\Entity\Especialidade;
use App\Config\Database;
use PDO;

class EspecialidadeDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }   

    public function getEspecialidades(){
        $sql = "
        select *
        from especialidade e
        order by e.nome;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Especialidade::fromArray($row);
        }
        return $result;
    }
}