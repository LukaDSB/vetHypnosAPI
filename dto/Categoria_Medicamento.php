<?php
class Categoria_Medicamento{
    private ? int $ID;
    private string $Descricao;


public function __construct(?int $ID, string $Descricao){
    $this->ID = $ID;
    $this->Descricao = $Descricao;
}

public function toArray(): array {
    return [
        'ID' => $this->ID,
        'Descricao' => $this->Descricao
    ];
}

public static function fromArray(array $data): self {
    return new self(
        isset($data['ID']) ? (int) $data['ID'] : null,
        $data['Descricao']
    );
}

public function getId() { return $this->ID; }
public function setId($ID) { $this->ID = $ID; }
public function getDescricao(){return $this->Descricao;}
public function setDescricao($Descricao){$this->Descricao = $Descricao;}




}

?>