<?php
require_once __DIR__ . '/ContatoDTO.php';
require_once __DIR__ . '/EnderecoDTO.php';
require_once __DIR__ . '/TutorDTO.php';

class TutorCompletoDTO extends TutorDTO{
    private Nome $nome;
    private Cpf $cpf;
    private array $contatos = [];
    private ?EnderecoDTO $endereco; 

    public function __construct(Nome $nome, Cpf $cpf, array $contatos, ?EnderecoDTO $endereco) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->contatos = $contatos;
        $this->endereco = $endereco;
    }

    public static function fromArray(array $data): self {
        $contatosDTO = [];
        if (!empty($data['contatos'])) {
            foreach ($data['contatos'] as $contatoData) {
                $contatosDTO[] = ContatoDTO::fromArray($contatoData);
            }
        }

        $enderecoDTO = isset($data['endereco']) ? EnderecoDTO::fromArray($data['endereco']) : null;

        $nomeVO = new Nome($data['nome'] ?? ''); 
        $cpfVO = new Cpf($data['cpf'] ?? '');

        return new self($nomeVO, $cpfVO, $contatosDTO, $enderecoDTO);
    }
    
    public function getNome(): Nome { return $this->nome; }
    public function getCpf(): Cpf { return $this->cpf; }
    public function getContatos(): array { return $this->contatos; }
    public function getEndereco(): ?EnderecoDTO { return $this->endereco; }
}