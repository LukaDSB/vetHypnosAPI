<?php
class Medicamento {
    private ?int  $ID;
    private string $nome;
    private float $concentracao;
    private ?int $Categoria_ID;
    private ?string $fabricante;
    private ?string $lote;
    private ?string $validade;
    private ?int $quantidade;


    public function __construct(?int $ID, string $nome, float $concentracao, ?int $Categoria_ID, ?string $fabricante, ?string $lote, ?string $validade, ?int $quantidade) {
        $this->ID = $ID;
        $this->nome = $nome;
        $this->concentracao = $concentracao;
        $this->Categoria_ID = $Categoria_ID;
        $this->fabricante = $fabricante;
        $this->lote = $lote;
        $this->validade = $validade;
        $this->quantidade = $quantidade;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['ID']) ? (int) $data['ID'] : null,
            $data['nome'],
            $data['concentracao'],
            $data['Categoria_ID'],
            $data['fabricante'],
            $data['lote'],
            $data['validade'],
            $data['quantidade']
        );
    }

    public function toArray(): array {
        return [
            'ID' => $this->ID,
            'nome' => $this->nome,
            'concentracao' => $this->concentracao,
            'Categoria_ID' => $this->Categoria_ID,
            'fabricante' => $this->fabricante,
            'lote' => $this->lote,
            'validade' => $this->validade,
            'quantidade' => $this->quantidade
        ];
    }

    public function getId() { return $this->ID; }
    public function setId($ID) { $this->ID = $ID; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getConcentracao() { return $this->concentracao; }
    public function setConcentracao($concentracao) { $this->concentracao = $concentracao; }
    public function getCategoria_id() { return $this->Categoria_ID; }
    public function setCategoria_id($Categoria_ID) { $this->Categoria_ID = $Categoria_ID; }
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
