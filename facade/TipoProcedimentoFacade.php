<?php
namespace App\Facade;

use App\Models\TipoProcedimentoModel;
use App\DTO\TipoProcedimentoContagemDTO; // CORRIGIDO: Namespace maiúsculo

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

    /**
     * Busca os procedimentos com contagem e força a serialização 
     * para array antes de retornar à Controller.
     */
   public function getProcedimentosComContagem(): array {
    $dtos = $this->tiposProcedimentoModel->getProcedimentosComContagem();
    
    // Força a serialização para array (resolve o problema do JSON)
    return array_map(function(TipoProcedimentoContagemDTO $dto) {
        return $dto->toArray();
    }, $dtos);
}
}