<?php
require_once __DIR__ . '/../entity/Clinica.php';
require_once __DIR__ .'/../dto/EnderecoDTO.php';
require_once __DIR__ .'/../dto/ContatoDTO.php';

error_reporting(E_ALL & ~E_NOTICE);
class ClinicaDTO extends Clinica{

    private ?EnderecoDTO $endereco;
    private ?ContatoDTO $contato;

    public function __construct(
        ?int $id, 
        string $nome, 
        ?int $endereco_id,
        ?int $contato_id, 
        ?EnderecoDTO $endereco,
        ?ContatoDTO $contato
        ){
        parent::__construct(
            $id, 
            $nome,
            $endereco_id,
            $contato_id
            );
        $this->endereco = $endereco;
        $this->contato = $contato;
    }

    public static function fromArray($data):self{
        $endereco = null;
        $contato = null;

        if(isset($data['endereco_id']) && isset($data['endereco_rua'])){
            $endereco = EnderecoDTO::fromArray($data);
        }
        if(isset($data['contato_id'])&& isset($data['contato_descricao'])){
            $contato = ContatoDTO::fromArray($data);
        }

        
        return new self(
            isset($data['clinica_id']) ? (int) $data['clinica_id']:null,
             $data['clinica_nome'],
              $data['endereco_id'],
              $data['contato_id'],
              $endereco,
              $contato
            );


    }

    public function toArray(){
        return [
            'clinica_id'=> $this->getId(),
            'clinica_nome'=> $this->getNome(),
            'endereco_id'=> $this->getEnderecoId(),
            'contato_id'=> $this->getContatoId(),
            'endereco' => $this->endereco ? $this->endereco->toArray() : null,
            'contato' => $this->contato ? $this->contato->toArray() : null
        ];
    }

}