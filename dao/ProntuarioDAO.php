<?php
require_once __DIR__ . '/../dto/ProntuarioDetalhadoDTO.php';
require_once __DIR__ . '/../config/Database.php';

class ProntuarioDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createCompleto(ProntuarioDetalhadoDTO $prontuarioDto): int|false
    {
        $this->conn->beginTransaction();
        try {
            $queryProntuario =
                "   INSERT INTO prontuario (animal_id, usuario_id, data_prontuario, observacoes, tipo_procedimento_id, statusProntuario) 
                VALUES (:animal_id, :usuario_id, :data_prontuario, :observacoes, :tipo_procedimento_id, :statusProntuario)
            ";

            $stmtProntuario = $this->conn->prepare($queryProntuario);
            $stmtProntuario->bindValue(":animal_id", $prontuarioDto->getAnimalId());
            $stmtProntuario->bindValue(":usuario_id", $prontuarioDto->getUsuarioId());
            $stmtProntuario->bindValue(":data_prontuario", $prontuarioDto->getDataProntuario());
            $stmtProntuario->bindValue(":observacoes", $prontuarioDto->getObservacoes());
            $stmtProntuario->bindValue(":tipo_procedimento_id", $prontuarioDto->getTipoProcedimentoId());
            $stmtProntuario->bindValue(":statusProntuario", $prontuarioDto->getStatusProntuario());
            $stmtProntuario->execute();

            $prontuarioId = $this->conn->lastInsertId();

            if (!empty($prontuarioDto->getMedicamentos())) {
                $queryDosagem =
                    "   INSERT INTO dosagem (prontuario_id, medicamento_id, volume_min, volume_max) 
                    VALUES (:prontuario_id, :medicamento_id, :volume_min, :volume_max)
                ";
                $stmtDosagem = $this->conn->prepare($queryDosagem);
                foreach ($prontuarioDto->getMedicamentos() as $medicamento) {
                    $stmtDosagem->execute([
                        ':prontuario_id' => $prontuarioId,
                        ':medicamento_id' => $medicamento['medicamento_id'],
                        ':volume_min' => $medicamento['volume_min'],
                        ':volume_max' => $medicamento['volume_max']
                    ]);
                }
            }

            if (!empty($prontuarioDto->getMedicoesClinicas())) {
                $queryMedicoes =
                    "   INSERT INTO medicoes_clinicas (prontuario_id, parametro_id, valor, horario) 
                    VALUES (:prontuario_id, :parametro_id, :valor, :horario)
                ";
                $stmtMedicoes = $this->conn->prepare($queryMedicoes);
                foreach ($prontuarioDto->getMedicoesClinicas() as $medicao) {
                    $stmtMedicoes->execute([
                        ':prontuario_id' => $prontuarioId,
                        ':parametro_id' => $medicao['parametro_id'],
                        ':valor' => $medicao['valor'],
                        ':horario' => $medicao['horario']
                    ]);
                }
            }

            $this->conn->commit();
            return $prontuarioId;

        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Erro ao criar prontuário: " . $e->getMessage());
            return false;
        }
    }

    public function updateCompleto(int $id, ProntuarioDetalhadoDTO $prontuarioDto): bool
    {
        $this->conn->beginTransaction();
        try {
            $queryProntuario =
                "   UPDATE prontuario
                SET animal_id = :animal_id,
                    usuario_id = :usuario_id,
                    data_prontuario = :data_prontuario,
                    observacoes = :observacoes,
                    tipo_procedimento_id = :tipo_procedimento_id,
                    statusProntuario = :statusProntuario
                WHERE id = :id
            ";
            $stmtProntuario = $this->conn->prepare($queryProntuario);
            $stmtProntuario->bindValue(":animal_id", $prontuarioDto->getAnimalId());
            $stmtProntuario->bindValue(":usuario_id", $prontuarioDto->getUsuarioId());
            $stmtProntuario->bindValue(":data_prontuario", $prontuarioDto->getDataProntuario());
            $stmtProntuario->bindValue(":observacoes", $prontuarioDto->getObservacoes());
            $stmtProntuario->bindValue(":tipo_procedimento_id", $prontuarioDto->getTipoProcedimentoId());
            $stmtProntuario->bindValue(":statusProntuario", $prontuarioDto->getStatusProntuario());
            $stmtProntuario->bindValue(":id", $id);
            $stmtProntuario->execute();

            $this->conn->prepare("DELETE FROM dosagem WHERE prontuario_id = :prontuario_id")->execute([':prontuario_id' => $id]);
            $this->conn->prepare("DELETE FROM medicoes_clinicas WHERE prontuario_id = :prontuario_id")->execute([':prontuario_id' => $id]);

            if (!empty($prontuarioDto->getMedicamentos())) {
                $queryDosagem =
                    "   INSERT INTO dosagem (prontuario_id, medicamento_id, volume_min, volume_max) 
                    VALUES (:prontuario_id, :medicamento_id, :volume_min, :volume_max)
                ";
                $stmtDosagem = $this->conn->prepare($queryDosagem);
                foreach ($prontuarioDto->getMedicamentos() as $medicamento) {
                    $stmtDosagem->execute([
                        ':prontuario_id' => $id,
                        ':medicamento_id' => $medicamento['medicamento_id'],
                        ':volume_min' => $medicamento['volume_min'],
                        ':volume_max' => $medicamento['volume_max']
                    ]);
                }
            }

            if (!empty($prontuarioDto->getMedicoesClinicas())) {
                $queryMedicoes =
                    "   INSERT INTO medicoes_clinicas (prontuario_id, parametro_id, valor, horario) 
                    VALUES (:prontuario_id, :parametro_id, :valor, :horario)
                ";
                $stmtMedicoes = $this->conn->prepare($queryMedicoes);
                foreach ($prontuarioDto->getMedicoesClinicas() as $medicao) {
                    $stmtMedicoes->execute([
                        ':prontuario_id' => $id,
                        ':parametro_id' => $medicao['parametro_id'],
                        ':valor' => $medicao['valor'],
                        ':horario' => $medicao['horario']
                    ]);
                }
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Erro ao atualizar prontuário: " . $e->getMessage());
            return false;
        }
    }

    public function getProntuarioById(int $id): ?ProntuarioDetalhadoDTO
    {
        $queryProntuario = "SELECT * FROM prontuario WHERE id = :id";
        $stmtProntuario = $this->conn->prepare($queryProntuario);
        $stmtProntuario->execute([':id' => $id]);
        $prontuarioData = $stmtProntuario->fetch(PDO::FETCH_ASSOC);

        if (!$prontuarioData) {
            return null;
        }

        $queryMedicamentos =
            "   SELECT d.medicamento_id, d.volume_min, d.volume_max, m.nome as medicamento_nome
            FROM dosagem d
            INNER JOIN medicamento m ON d.medicamento_id = m.id
            WHERE d.prontuario_id = :prontuario_id
        ";
        $stmtMedicamentos = $this->conn->prepare($queryMedicamentos);
        $stmtMedicamentos->execute([':prontuario_id' => $id]);
        $prontuarioData['medicamentos'] = $stmtMedicamentos->fetchAll(PDO::FETCH_ASSOC);

        $queryMedicoes =
            "   SELECT mc.id, mc.parametro_id, pc.nome as parametro_nome, mc.valor, mc.horario
            FROM medicoes_clinicas mc
            INNER JOIN parametros_clinicos pc ON mc.parametro_id = pc.id
            WHERE mc.prontuario_id = :prontuario_id
            ORDER BY mc.horario ASC
        ";
        $stmtMedicoes = $this->conn->prepare($queryMedicoes);
        $stmtMedicoes->execute([':prontuario_id' => $id]);
        $prontuarioData['medicoes_clinicas'] = $stmtMedicoes->fetchAll(PDO::FETCH_ASSOC);

        return ProntuarioDetalhadoDTO::fromArray($prontuarioData);
    }

    public function delete(int $id): bool
    {
        $this->conn->beginTransaction();
        try {
            $this->conn->prepare("DELETE FROM dosagem WHERE prontuario_id = :id")->execute([':id' => $id]);
            $this->conn->prepare("DELETE FROM medicoes_clinicas WHERE prontuario_id = :id")->execute([':id' => $id]);
            $this->conn->prepare("DELETE FROM prontuario WHERE id = :id")->execute([':id' => $id]);

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Erro ao deletar prontuário: " . $e->getMessage());
            return false;
        }
    }

    public function getAllProntuarios(): array
    {
        $query =
            "   SELECT p.id, u.nome as usuario_nome, u.id as usuario_id, a.nome as animal_nome, a.id as animal_id, p.data_prontuario, p.tipo_procedimento_id, p.statusProntuario, p.observacoes, tp.tipo_procedimento as procedimento
            FROM prontuario p
            INNER JOIN usuario u ON p.usuario_id = u.id
            INNER JOIN animal a ON p.animal_id = a.id
            JOIN tipo_procedimento tp ON p.tipo_procedimento_id = tp.id
            ORDER BY p.data_prontuario DESC, p.id DESC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $prontuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($prontuarios)) {
            return [];
        }

        $prontuarioIds = array_column($prontuarios, 'id');

        $placeholders = implode(',', array_fill(0, count($prontuarioIds), '?'));

        $queryMedicamentos =
            "   SELECT d.prontuario_id, d.medicamento_id, d.volume_min, d.volume_max, m.nome as medicamento_nome
            FROM dosagem d
            INNER JOIN medicamento m ON d.medicamento_id = m.id
            WHERE d.prontuario_id IN ($placeholders)
        ";
        $stmtMedicamentos = $this->conn->prepare($queryMedicamentos);
        $stmtMedicamentos->execute($prontuarioIds);
        $allMedicamentos = $stmtMedicamentos->fetchAll(PDO::FETCH_ASSOC);

        $queryMedicoes =
            "   SELECT mc.prontuario_id, mc.id, mc.parametro_id, pc.nome as parametro_nome, mc.valor, mc.horario
            FROM medicoes_clinicas mc
            INNER JOIN parametros_clinicos pc ON mc.parametro_id = pc.id
            WHERE mc.prontuario_id IN ($placeholders)
            ORDER BY mc.horario ASC
        ";
        $stmtMedicoes = $this->conn->prepare($queryMedicoes);
        $stmtMedicoes->execute($prontuarioIds);
        $allMedicoes = $stmtMedicoes->fetchAll(PDO::FETCH_ASSOC);

        $medicamentosPorProntuario = [];
        foreach ($allMedicamentos as $medicamento) {
            $medicamentosPorProntuario[$medicamento['prontuario_id']][] = $medicamento;
        }

        $medicoesPorProntuario = [];
        foreach ($allMedicoes as $medicao) {
            $medicoesPorProntuario[$medicao['prontuario_id']][] = $medicao;
        }

        $result = [];
        foreach ($prontuarios as $prontuarioData) {
            $prontuarioId = $prontuarioData['id'];
            $prontuarioData['medicamentos'] = $medicamentosPorProntuario[$prontuarioId] ?? [];
            $prontuarioData['medicoes_clinicas'] = $medicoesPorProntuario[$prontuarioId] ?? [];
            $result[] = ProntuarioDetalhadoDTO::fromArray($prontuarioData);
        }

        return $result;
    }

    public function checkId(int $id): bool
    {
        $query = "SELECT 1 FROM prontuario WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return (bool) $stmt->fetch(PDO::FETCH_COLUMN);
    }
}