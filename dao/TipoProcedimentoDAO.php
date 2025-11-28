<?php
namespace App\DAO;

use App\Config\Database;
use App\Entity\TipoProcedimento;
use App\DTO\TipoProcedimentoContagemDTO; // CORRIGIDO: Namespace maiúsculo
use PDO;

class TipoProcedimentoDAO{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTiposProcedimento(): array {
        $query = "SELECT * FROM tipo_procedimento";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = TipoProcedimento::fromArray($row);
        }
        return $result;
    }

    public function getProcedimentosComContagem(): array {
    // APENAS SELECIONA TUDO DA VIEW!
    $query = "SELECT * FROM v_procedimentos_contagem ORDER BY total_procedimentos DESC"; 
    
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $result = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Ainda criamos o DTO para padronizar o retorno e evitar o bug de serialização!
        $result[] = TipoProcedimentoContagemDTO::fromArray($row);
    }
    return $result;
}

    public function selectById(int $id) {
        // [CÓDIGO OMITIDO POR NÃO SER RELEVANTE PARA O BUG]
        // Se precisar do código, consulte sua versão anterior
        return $result;
    }
}