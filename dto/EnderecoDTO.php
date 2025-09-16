<?php
// Em dto/EnderecoDTO.php

require_once __DIR__ . '/../entity/Endereco.php';
require_once __DIR__ . '/../entity/Cidade.php'; // Incluímos a entidade Cidade que será usada

class EnderecoDTO extends Endereco {
    // As propriedades já são herdadas do pai, não precisa redefinir
    
    public function __construct(
        ?int $id,
        ?string $rua,
        ?string $numero,
        ?string $bairro,
        ?Cidade $cidade // Recebe o objeto Cidade, assim como o pai
    ) {
        // CORREÇÃO: Passa o OBJETO $cidade para o construtor do pai,
        // em vez de um ID.
        parent::__construct($id, $rua, $numero, $bairro, $cidade);
    }

    public static function fromArray($data): self {
        $cidade = null;
        if (!empty($data['cidade_id_ref'])) {
            // Aqui podemos usar a entidade Cidade diretamente para criar o objeto
            $cidade = Cidade::fromArray($data);
        }
        
        return new self(
            $data['endereco_id_ref'] ?? null,
            $data['endereco_rua'] ?? null,
            $data['endereco_numero'] ?? null,
            $data['endereco_bairro'] ?? null,
            $cidade // Passa o objeto criado
        );
    }

    // CORREÇÃO: Adiciona o tipo de retorno ": array" para ser compatível com o pai
    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'rua' => $this->getRua(),
            'numero' => $this->getNumero(),
            'bairro' => $this->getBairro(),
            // Usa o getter corrigido da classe pai para pegar o objeto e serializá-lo
            'cidade' => $this->getCidade() ? $this->getCidade()->toArray() : null
        ];
    }
}