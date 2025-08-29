<?php
require_once __DIR__ . '/../entity/Endereco.php';
require_once __DIR__ .'/../dto/CidadeDTO.php';
error_reporting(E_ALL & ~E_NOTICE);
class EnderecoDTO extends Endereco{
    private ?int $cidade_id;
    private ?Cidade $cidade;

    public function __construct(
        ?int $id, 
        ?string $rua, 
        ?string $numero, 
        ?string $bairro, 
        ?int $cidade_id, 
        ?Cidade $cidade
        ){
        parent::__construct(
            $id, 
            $rua,
            $numero,
            $bairro,
            $cidade_id
            );
        $this->cidade = $cidade;
    }

    public static function fromArray($data):self{
        $cidade = null;

        if(isset($data['cidade_id'])&& isset($data['cidade_nome'])){
            $cidade = CidadeDTO::fromArray($data);
        }
        
        return new self(
            isset($data['endereco_id']) ? (int) $data['endereco_id']:null,
             $data['endereco_rua'],
              $data['endereco_numero'],
              $data['endereco_bairro'],
              $data['cidade_id'],
              $cidade
            );


    }

    public function toArray(){
        return [
            'endereco_id'=> $this->getId(),
            'rua'=> $this->getRua(),
            'numero'=> $this->getNumero(),
            'bairro'=> $this->getBairro(),
            'cidade' => $this->cidade ? $this->cidade->toArray() : null

        ];
    }

}