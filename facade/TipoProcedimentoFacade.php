<?php
namespace App\Facade;

use App\Models\TipoProcedimentoModel;

class TipoProcedimentoFacade{
    private $tiposProcedimentoModel;

    public function __construct(){
        $this->tiposProcedimentoModel = new TipoProcedimentoModel();
    }

    public function getTiposProcedimento(){
        return $this->tiposProcedimentoModel->getTiposProcedimento();
    }

    public function getEspecie(int $id){
        try{
            return $this->tiposProcedimentoModel->getEspecie($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}