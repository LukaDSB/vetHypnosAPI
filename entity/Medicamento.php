<?php
require_once __DIR__ .'/../entity/Estoque.php';
error_reporting(E_ALL & ~E_NOTICE);
class Medicamento {
    private ?int  $id;
    private ?string $nome;
    private ?float $concentracao;
    private ?int $categoria_medicamento_id;
    private ?string $fabricante;
    private ?string $lote;
    private ?string $validade;
    private ?int $quantidade;
    private ?Categoria_Medicamento $categoria_medicamento;


    public function __construct(?int $id, ?string $nome, ?float $concentracao, ?int $categoria_medicamento_id, ?string $fabricante, ?string $lote, ?string $validade, ?int $quantidade, ?Categoria_Medicamento $categoria_medicamento) {
        $this->id = $id;
        $this->nome = $nome;
        $this->concentracao = $concentracao;
        
        $this->categoria_medicamento_id = $categoria_medicamento_id;
        $this->fabricante = $fabricante;
        $this->lote = $lote;
        $this->validade = $validade;
        $this->quantidade = $quantidade;
        $this->categoria_medicamento = $categoria_medicamento;
    }

    public static function fromArray(array $data): self {
        $categoria_medicamento = null;

        if (!empty($data["categoria_medicamento_id"]) && !empty($data["categoria_medicamento_descricao"])) {
        $categoria_medicamento = new Categoria_Medicamento($data["categoria_medicamento_id"], $data["categoria_medicamento_descricao"]);
        }


        return new MedicamentoDTO(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['concentracao'],
            $data['categoria_medicamento_id'],
            $data['fabricante'],
            $data['lote'],
            $data['validade'],
            $data['quantidade'],
            $categoria_medicamento

        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'concentracao' => $this->concentracao,
            'categoria_medicamento_id' => $this->categoria_medicamento_id,
            'fabricante' => $this->fabricante,
            'lote' => $this->lote,
            'validade' => $this->validade,
            'quantidade' => $this->quantidade,
            'categoria_medicamento'=> $this->categoria_medicamento ? $this->categoria_medicamento->toArray() : null
        ];
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getConcentracao() { return $this->concentracao;}
    public function getCategoria_medicamento_id() { return $this->categoria_medicamento_id; }
    public function getFabricante() { return $this->fabricante; }
    public function getLote() { return $this->lote; }
    public function getValidade() { return $this->validade; }
    public function getQuantidade() { return $this->quantidade; }
}
?>
