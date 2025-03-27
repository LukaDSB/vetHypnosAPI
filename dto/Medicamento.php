<?php
class Medicamento {
    private ?int  $id;
    private string $nome;
    private float $concentracao;
    private ?int $categoria_id;
    private ?string $fabricante;
    private ?string $lote;
    private ?string $validade;
    private ?int $quantidade;


    public function __construct(?int $id, string $nome, float $concentracao, ?int $categoria_id, ?string $fabricante, ?string $lote, ?string $validade, ?int $quantidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->concentracao = $concentracao;
        
        $this->categoria_id = $categoria_id;
        $this->fabricante = $fabricante;
        $this->lote = $lote;
        $this->validade = $validade;
        $this->quantidade = $quantidade;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['concentracao'],
            $data['categoria_id'],
            $data['fabricante'],
            $data['lote'],
            $data['validade'],
            $data['quantidade']
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'concentracao' => $this->concentracao,
            'categoria_id' => $this->categoria_id,
            'fabricante' => $this->fabricante,
            'lote' => $this->lote,
            'validade' => $this->validade,
            'quantidade' => $this->quantidade
        ];
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getConcentracao() { return $this->concentracao;}
    public function setConcentracao($concentracao) { $this->concentracao = $concentracao; }
    public function getCategoria_id() { return $this->Categoria_ID; }
    public function setCategoria_id($categoria_id) { $this->categoria_id = $categoria_id; }
    public function getFabricante() { return $this->fabricante; }
    public function setFabricante($fabricante) { $this->fabricante = $fabricante;}
    public function getLote() { return $this->lote; }
    public function setLote($lote) { $this->lote = $lote; }
    public function getValidade() { return $this->validade; }
    public function setValidade($validade) { $this->validade = $validade; }
    public function getQuantidade() { return $this->quantidade; }
    public function setQuantidade($quantidade) { $this->quantidade = $quantidade; }
}
?>
