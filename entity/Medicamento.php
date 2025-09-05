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
    private ?float $dose_min = 0;
    private ?float $dose_max = 0;
    private ?int $quantidade;
    private ?Categoria_Medicamento $categoria_medicamento;


    public function __construct(
        ?int $id, 
        ?string $nome, 
        ?float $concentracao, 
        ?int $categoria_medicamento_id, 
        ?string $fabricante, 
        ?string $lote, 
        ?string $validade, 
        ?float $dose_min, 
        ?float $dose_max, 
        ?int $quantidade, 
        ?Categoria_Medicamento $categoria_medicamento
        ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->concentracao = $concentracao;
        $this->categoria_medicamento_id = $categoria_medicamento_id;
        $this->fabricante = $fabricante;
        $this->lote = $lote;
        $this->validade = $validade;
        $this->dose_min = $dose_min;
        $this->dose_max = $dose_max;
        $this->quantidade = $quantidade;
        $this->categoria_medicamento = $categoria_medicamento;
    }

    public static function fromArray(array $data): self {
        $categoria_medicamento = null;

        if (!empty($data["categoria_medicamento_id"]) && !empty($data["categoria_medicamento_descricao"])) {
        $categoria_medicamento = new Categoria_Medicamento($data["categoria_medicamento_id"], $data["categoria_medicamento_descricao"]);
        }


        return new Medicamento(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['concentracao'],
            $data['categoria_medicamento_id'],
            $data['fabricante'],
            $data['lote'],
            $data['validade'],
            $data['dose_min'],
            $data['dose_max'],
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
            'dose_min' => $this->dose_min,
            'dose_max' => $this->dose_max,
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
    public function getDoseMin() { return $this->dose_min; }
    public function getDoseMax() { return $this->dose_max; } 
    public function getQuantidade() { return $this->quantidade; }
}