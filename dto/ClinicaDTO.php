<?php
// Em dto/ClinicaDTO.php

require_once __DIR__ . '/../entity/Clinica.php';
// Inclua as entidades que serão usadas para criar os objetos
require_once __DIR__ . '/../entity/Endereco.php'; 
require_once __DIR__ . '/../entity/Contato.php';

class ClinicaDTO extends Clinica {

    // CORREÇÃO: O construtor deve receber os OBJETOS, assim como o pai.
    public function __construct(
        ?int $id,
        ?string $nome,
        ?Endereco $endereco, // Recebe o objeto Endereco
        ?Contato $contato     // Recebe o objeto Contato
    ) {
        // CORREÇÃO: Passa os OBJETOS recebidos para o construtor do pai.
        parent::__construct($id, $nome, $endereco, $contato);
    }

    public static function fromArray($data): self {
        $endereco = null;
        if (!empty($data['endereco_id_ref'])) {
            // Usamos a Entidade Endereco para criar o objeto
            $endereco = Endereco::fromArray($data);
        }

        $contato = null;
        if (!empty($data['contato_id_ref'])) {
            // Usamos a Entidade Contato para criar o objeto
            $contato = Contato::fromArray($data);
        }

        return new self(
            $data['clinica_id_ref'] ?? null,
            $data['clinica_nome'] ?? null,
            $endereco, // Passa o objeto Endereco criado
            $contato   // Passa o objeto Contato criado
        );
    }

    // CORREÇÃO: Adiciona o tipo de retorno ": array" para ser compatível com o pai
    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            // CORREÇÃO: Usa os getters corretos da classe pai
            'endereco' => $this->getEndereco() ? $this->getEndereco()->toArray() : null,
            'contato' => $this->getContato() ? $this->getContato()->toArray() : null
        ];
    }
}