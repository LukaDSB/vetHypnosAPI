<?php
require_once __DIR__ .'/../entity/Endereco.php';
require_once __DIR__ .'/../entity/Contato.php';
class Tutor{
    private ?int $id;
    private ?string $nome;
    private ?string $cpf;
    private ?int $endereco_id;
    private ?int $contato_id;
    private ?Endereco $endereco;
    private ?Contato $contato;
    
    public function __construct(
        ?int $id, 
        ?string $nome, 
        ?string $cpf, 
        ?int $endereco_id,
        ?int $contato_id,
        ?Endereco $endereco,
        ?Contato $contato
        ){
            $this->id = $id;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->endereco_id = $endereco_id;
            $this->contato_id = $contato_id;
            $this->endereco = $endereco;
            $this->contato = $contato;
        }

        public static function fromArray(array $data):self{
            $endereco = null;
            $contato = null;

            if(!empty($data['contato_id']) && !empty($data['tipo_contato_id'])){
                $contato = ContatoDTO::fromArray($data);
            }
            

            if(!empty($data['endereco_id'])){
                $endereco = new Endereco();
            }


          
            return new Tutor(
                isset($data['tutor_id']) ? (int) $data['tutor_id'] : null,
                $data['tutor_nome'],
                $data['tutor_cpf'],
                $data['endereco_id'],
                $data['contato_id'],
                $endereco,
                $contato
            );

        }

        public function toArray(): array {
            return [
                'id' => $this->id,
                'tutor_nome' => $this->nome,
                'tutor_cpf' => $this->cpf,
                'endereco_id' => $this->endereco_id,
                'contato_id' => $this->contato_id,
                'endereco' => $this->endereco ? $this->endereco->toArray() : null,
                'contato' => $this->contato ? $this->contato->toArray() : null,
            ];
        }

        public function getId(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function getEnderecoId(){
            return $this->endereco_id;
        }

        public function getContatoId(){
            return $this->contato_id;
        }

        
}











