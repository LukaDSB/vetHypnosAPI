<?php
require_once __DIR__ . '/../dao/TipoProcedimentoDAO.php';

class TipoProcedimentoModel{

    private $tiposProcedimentoDAO;
    public function __construct(){
        $this->tiposProcedimentoDAO = new TipoProcedimentoDAO();
    }

    public function getTiposProcedimento(){
        return $this->tiposProcedimentoDAO->getTiposProcedimento();
    }

    public function getProntuarioById(int $id){
        return $this->tiposProcedimentoDAO->getProntuarioById($id);
    }
}