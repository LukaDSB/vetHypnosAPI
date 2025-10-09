<?php
namespace App\Entity;

class Estoque{
    private ?int $id;
private ?int $quantidade;
private ?int $medicamento_id;
    public function __construct(
        ?int $id,
        ?int $quantidade,
        ?int $medicamento_id
    ){
        $this->id = $id;
        $this->quantidade = $quantidade;
        $this->medicamento_id = $medicamento_id;
    }




    public function getId(){return $this->id;}
    public function getQuantidade(){return $this->quantidade;}
    public function getMedicamento_id(){return $this->medicamento_id;}

}