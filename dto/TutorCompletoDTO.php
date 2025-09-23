<?php

require_once __DIR__ . '/../dto/EnderecoDTO.php';
require_once __DIR__ . '/../dto/TutorDTO.php';
require_once __DIR__ . '/../entity/Nome.php';
require_once __DIR__ . '/../entity/Cpf.php';
require_once __DIR__ . '/../dto/ContatoDTO.php';

class TutorCompletoDTO extends TutorDTO
{
    private ?EnderecoDTO $endereco;
    private array $contatos;

    public function __construct(Nome $nome, Cpf $cpf, ?EnderecoDTO $endereco, array $contatos = [])
    {
        parent::__construct($nome, $cpf);
        $this->endereco = $endereco;
        $this->contatos = $contatos;
    }

    public static function fromArray(array $data): TutorCompletoDTO
    {
        $nome = new Nome($data['nome'] ?? '');
        $cpf = new Cpf($data['cpf'] ?? '');
        
        $endereco = null;
        if (!empty($data['endereco'])) {
            $endereco = EnderecoDTO::fromArray($data['endereco']);
        }

        $contatos = [];
        if (!empty($data['contatos']) && is_array($data['contatos'])) {
            foreach ($data['contatos'] as $contatoData) {
                $contatos[] = ContatoDTO::fromArray($contatoData);
            }
        }

        return new self(
            $nome,
            $cpf,
            $endereco,
            $contatos
        );
    }

    public function getEndereco(): ?EnderecoDTO
    {
        return $this->endereco;
    }

    public function getContatos(): array
    {
        return $this->contatos;
    }
}