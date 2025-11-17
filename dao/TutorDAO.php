<?php
namespace App\DAO;

use App\Config\Database;
use App\DTO\TutorDTO;
use App\DTO\TutorCompletoDTO;
use App\DTO\EnderecoDTO;
use App\DTO\ContatoDTO;
use App\Entity\Tutor;
use PDO;
use InvalidArgumentException;
use Throwable;

class TutorDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    private function findOrCreateEstado(?string $nomeEstado, ?int $estadoId = null): int
    {
        if (empty($nomeEstado)) {
            throw new InvalidArgumentException("O nome do estado não pode ser vazio.");
        }

        if ($estadoId) {
            $query = "SELECT id FROM estado WHERE id = :id AND nome = :nome";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $estadoId, PDO::PARAM_INT);
            $stmt->bindValue(':nome', $nomeEstado);
            $stmt->execute();
            if ($stmt->fetchColumn()) {
                return $estadoId; 
            }
        }
        
        $query = "SELECT id FROM estado WHERE nome = :nome";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $nomeEstado);
        $stmt->execute();
        $id = $stmt->fetchColumn();

        if ($id) {
            return (int) $id;
        }

        $insertQuery = "INSERT INTO estado (nome) VALUES (:nome)";
        $insertStmt = $this->conn->prepare($insertQuery);
        $insertStmt->bindValue(':nome', $nomeEstado);
        $insertStmt->execute();

        return (int) $this->conn->lastInsertId();
    }

    private function findOrCreateCidade(?string $nomeCidade, int $estadoId, ?int $cidadeId = null): int
    {
        if (empty($nomeCidade)) {
            throw new InvalidArgumentException("O nome da cidade não pode ser vazio.");
        }

        if ($cidadeId) {
            $query = "SELECT id FROM cidade WHERE id = :id AND nome = :nome AND estado_id = :estado_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $cidadeId, PDO::PARAM_INT);
            $stmt->bindValue(':nome', $nomeCidade);
            $stmt->bindValue(':estado_id', $estadoId, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->fetchColumn()) {
                return $cidadeId;
            }
        }

        $query = "SELECT id FROM cidade WHERE nome = :nome AND estado_id = :estado_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $nomeCidade);
        $stmt->bindValue(':estado_id', $estadoId, PDO::PARAM_INT);
        $stmt->execute();
        $id = $stmt->fetchColumn();

        if ($id) {
            return (int) $id;
        }

        $insertQuery = "INSERT INTO cidade (nome, estado_id) VALUES (:nome, :estado_id)";
        $insertStmt = $this->conn->prepare($insertQuery);
        $insertStmt->bindValue(':nome', $nomeCidade);
        $insertStmt->bindValue(':estado_id', $estadoId, PDO::PARAM_INT);
        $insertStmt->execute();

        return (int) $this->conn->lastInsertId();
    }

    private function upsertEndereco(EnderecoDTO $enderecoDTO): ?int
    {
        $cidadeDTO = $enderecoDTO->cidade;
        
        if (!$enderecoDTO->rua || !$enderecoDTO->numero || !$enderecoDTO->bairro || 
            !$cidadeDTO || empty($cidadeDTO->cidade_nome) || !$cidadeDTO->estado || empty($cidadeDTO->estado->estado_nome)
        ) {
             return null;
        }

        $estadoId = $this->findOrCreateEstado($cidadeDTO->estado->estado_nome, $cidadeDTO->estado->id);
        $cidadeId = $this->findOrCreateCidade($cidadeDTO->cidade_nome, $estadoId, $cidadeDTO->id);

        if ($enderecoDTO->id) {
            $query = "UPDATE endereco SET cidade_id = :cidade_id, rua = :rua, numero = :numero, bairro = :bairro WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $enderecoDTO->id, PDO::PARAM_INT);
        } else {
            $query = "INSERT INTO endereco (cidade_id, rua, numero, bairro) VALUES (:cidade_id, :rua, :numero, :bairro)";
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->bindValue(':cidade_id', $cidadeId, PDO::PARAM_INT);
        $stmt->bindValue(':rua', $enderecoDTO->rua);
        $stmt->bindValue(':numero', $enderecoDTO->numero);
        $stmt->bindValue(':bairro', $enderecoDTO->bairro);
        $stmt->execute();

        return $enderecoDTO->id ?? (int) $this->conn->lastInsertId();
    }

    private function upsertContato(ContatoDTO $contatoDTO, int $tutorId): int
    {
        if ($contatoDTO->id) {
            $query = "
                UPDATE contato SET descricao = :desc, tipo_contato_id = :tipo_id
                WHERE id = :id
            ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $contatoDTO->id, PDO::PARAM_INT);
        } else {
            $query = "
                INSERT INTO contato (descricao, tipo_contato_id)
                VALUES (:desc, :tipo_id)
            ";
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->bindValue(':desc', $contatoDTO->getDescricao());
        $stmt->bindValue(':tipo_id', $contatoDTO->getTipoContatoId(), PDO::PARAM_INT); 
        $stmt->execute();

        $contatoId = $contatoDTO->id ?? (int) $this->conn->lastInsertId();

        $junctionQuery = "
            INSERT IGNORE INTO tutor_contatos (tutor_id, contato_id) 
            VALUES (:tutor_id, :contato_id)
        ";
        $junctionStmt = $this->conn->prepare($junctionQuery);
        $junctionStmt->bindValue(':tutor_id', $tutorId, PDO::PARAM_INT);
        $junctionStmt->bindValue(':contato_id', $contatoId, PDO::PARAM_INT);
        $junctionStmt->execute();
        
        return $contatoId;
    }

    public function insert(TutorDTO $tutor): bool
    {
        if (!($tutor instanceof TutorCompletoDTO)) {
            return false; 
        }

        $this->conn->beginTransaction();
        try {
            $enderecoId = null;
            if ($tutor->getEndereco()) {
                $enderecoId = $this->upsertEndereco($tutor->getEndereco());
            }

            $query = "INSERT INTO tutor (nome, cpf, endereco_id, ativo) VALUES (:nome, :cpf, :endereco_id, 1)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':nome', $tutor->getNome()->getValue());
            $stmt->bindValue(':cpf', $tutor->getCpf()->getValue());
            $stmt->bindValue(':endereco_id', $enderecoId, PDO::PARAM_INT);
            $stmt->execute();
            $tutorId = $this->conn->lastInsertId();

            foreach ($tutor->getContatos() as $contatoDTO) {
                if (!($contatoDTO instanceof ContatoDTO)) continue;
                $this->upsertContato($contatoDTO, (int)$tutorId);
            }

            $this->conn->commit();
            return true;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            error_log("Erro ao inserir tutor: " . $e->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        $query = "
            SELECT 
                t.id AS tutor_id, t.nome AS tutor_nome, t.cpf AS tutor_cpf,
                e.id AS endereco_id, e.rua AS endereco_rua, e.numero AS endereco_numero, e.bairro AS endereco_bairro,
                ci.id AS cidade_id, ci.nome AS cidade_nome,
                es.id AS estado_id, es.nome AS estado_nome
            FROM tutor t
            LEFT JOIN endereco e ON e.id = t.endereco_id
            LEFT JOIN cidade ci ON ci.id = e.cidade_id
            LEFT JOIN estado es ON es.id = ci.estado_id
            WHERE t.ativo = 1
            ORDER BY t.id DESC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $tutorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($tutorsData)) {
            return [];
        }

        $tutorIds = array_column($tutorsData, 'tutor_id');
        $placeholders = implode(',', array_fill(0, count($tutorIds), '?'));

        $contatosQuery = "
            SELECT
                co.id AS contato_id_ref, co.descricao AS contato_descricao,
                tc.id AS tipo_contato_id_ref, tc.descricao AS tipo_contato_descricao,
                tc_j.tutor_id
            FROM contato co
            JOIN tutor_contatos tc_j ON co.id = tc_j.contato_id
            LEFT JOIN tipo_contato tc ON tc.id = co.tipo_contato_id
            WHERE tc_j.tutor_id IN ($placeholders)
        ";
        $contatosStmt = $this->conn->prepare($contatosQuery);
        $contatosStmt->execute($tutorIds);
        $contatosResult = $contatosStmt->fetchAll(PDO::FETCH_ASSOC);

        $contatosByTutorId = [];
        foreach ($contatosResult as $contato) {
            $contatosByTutorId[$contato['tutor_id']][] = $contato;
        }

        $result = [];
        foreach ($tutorsData as $tutorData) {
            $tutorId = $tutorData['tutor_id'];
            $tutorData['contatos'] = $contatosByTutorId[$tutorId] ?? [];
            $result[] = \App\Entity\Tutor::fromArray($tutorData); 
        }

        return $result;
    }

    public function selectById(int $id): ?Tutor
    {
        $query = "
            SELECT 
                t.id AS tutor_id, t.nome AS tutor_nome, t.cpf AS tutor_cpf,
                e.id AS endereco_id, e.rua AS endereco_rua, e.numero AS endereco_numero, e.bairro AS endereco_bairro,
                ci.id AS cidade_id, ci.nome AS cidade_nome,
                es.id AS estado_id, es.nome AS estado_nome, es.sigla AS estado_sigla
            FROM tutor t
            LEFT JOIN endereco e ON e.id = t.endereco_id
            LEFT JOIN cidade ci ON ci.id = e.cidade_id
            LEFT JOIN estado es ON es.id = ci.estado_id
            WHERE t.id = :id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tutorData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tutorData) {
            return null;
        }

        $contatosQuery = "
            SELECT
                co.id AS contato_id_ref, co.descricao AS contato_descricao,
                tc.id AS tipo_contato_id_ref, tc.descricao AS tipo_contato_descricao
            FROM contato co
            JOIN tutor_contatos tc_j ON co.id = tc_j.contato_id
            LEFT JOIN tipo_contato tc ON tc.id = co.tipo_contato_id
            WHERE tc_j.tutor_id = :tutor_id
        ";
        $contatosStmt = $this->conn->prepare($contatosQuery);
        $contatosStmt->bindParam(':tutor_id', $id);
        $contatosStmt->execute();
        $contatosData = $contatosStmt->fetchAll(PDO::FETCH_ASSOC);

        $tutorData['contatos'] = $contatosData;
        return \App\Entity\Tutor::fromArray($tutorData);
    }

    public function update(int $id, TutorCompletoDTO $tutor): bool
    {
        $this->conn->beginTransaction();
        try {
            $enderecoId = null;
            if ($tutor->getEndereco()) {
                $enderecoId = $this->upsertEndereco($tutor->getEndereco());
            }

            $query = "UPDATE tutor SET nome = :nome, cpf = :cpf, endereco_id = :endereco_id WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':nome', $tutor->getNome()->getValue());
            $stmt->bindValue(':cpf', $tutor->getCpf()->getValue());
            $stmt->bindValue(':endereco_id', $enderecoId, PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $contatoIdsRecebidos = [];
            foreach ($tutor->getContatos() as $contatoDTO) {
                if (!($contatoDTO instanceof ContatoDTO)) continue;
                $contatoIdsRecebidos[] = $this->upsertContato($contatoDTO, $id);
            }
            
             $oldContatosQuery = "SELECT contato_id FROM tutor_contatos WHERE tutor_id = :tutor_id";
             $oldContatosStmt = $this->conn->prepare($oldContatosQuery);
             $oldContatosStmt->bindValue(':tutor_id', $id, PDO::PARAM_INT);
             $oldContatosStmt->execute();
             $oldContatoIds = $oldContatosStmt->fetchAll(PDO::FETCH_COLUMN);

             $idsToDelete = array_diff($oldContatoIds, $contatoIdsRecebidos);
             
             if (!empty($idsToDelete)) {
                $deletePlaceholders = implode(',', array_fill(0, count($idsToDelete), '?'));
                $deleteJunctionQuery = "DELETE FROM tutor_contatos WHERE tutor_id = :tutor_id AND contato_id IN ($deletePlaceholders)";
                $deleteJunctionStmt = $this->conn->prepare($deleteJunctionQuery);
                $deleteJunctionStmt->bindValue(':tutor_id', $id, PDO::PARAM_INT);
                $deleteJunctionStmt->execute($idsToDelete);
             } elseif (empty($contatoIdsRecebidos) && !empty($oldContatoIds)) {
                 $deleteJunctionQuery = "DELETE FROM tutor_contatos WHERE tutor_id = :tutor_id";
                 $deleteJunctionStmt = $this->conn->prepare($deleteJunctionQuery);
                 $deleteJunctionStmt->bindValue(':tutor_id', $id, PDO::PARAM_INT);
                 $deleteJunctionStmt->execute();
             }


            $this->conn->commit();
            return true;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            error_log("Erro ao atualizar tutor: " . $e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        $this->conn->beginTransaction();
        try {
            $deleteJunctionQuery = "DELETE FROM tutor_contatos WHERE tutor_id = :tutor_id";
            $deleteStmt = $this->conn->prepare($deleteJunctionQuery);
            $deleteStmt->bindValue(':id', $id);
            $deleteStmt->execute();
            
            $query = "UPDATE tutor SET ativo = 0 WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            error_log("Erro ao deletar tutor: " . $e->getMessage());
            return false;
        }
    }

    public function checkId(int $id)
    {
        $query = "SELECT 1 FROM tutor WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}