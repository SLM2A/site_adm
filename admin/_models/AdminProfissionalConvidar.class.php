<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 22/03/2017
 * Time: 20:05
 */


class AdminProfissionalConvidar{

    private $Data;
    private $CadID;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ENTITY = 'usuarioconvidado';


    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        //$this->CreateAluguel();
        $this->CreateEmprego();
    }

     public function ExeUpdateVisualizada($CategoryId, array $Data) {
        $this->Data = $Data;
        $this->CadID = (int) $CategoryId;
        $this->UpdateVisualizada();
    }
       public function ExeUpdateVisualizadaEmpresario($CategoryId, array $Data) {
        $this->Data = $Data;
        $this->CadID = (int) $CategoryId;
        $this->UpdateVisualizadaEmpresario();
    }
    
    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;
        if(empty($this->Data['idVagaAluguel'])):
        $this->UpdateEmprego();
        elseif (empty($this->Data['idVagaEmprego'])):
        $this->UpdateAluguel();
        else:
         $this->UpdateAluguel();
         $this->UpdateEmprego();    
            
        endif;
    }
    

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    

        private function CreateEmprego() {
        $Create = new Create;
        $qntVagaAluguel = count($this->Data['idVagaEmprego']);
        for($i = 0; $i < $qntVagaAluguel; $i++):
            $idArray = ['idUsuarioEmpresario' => $this->Data['idUsuarioEmpresario'],  'idUsuarioProfissional' => $this->Data['idUsuarioProfissional'], 'situacao' => $this->Data['situacao'], 'idVagaEmprego'=>  $this->Data['idVagaEmprego'][$i], 'visualizadoProfissional'=> $this->Data['visualizadoProfissional']];
            $Create->ExeCreate(self::ENTITY, $idArray);
          endfor;
        $this->Result = TRUE;
        
             $this->Error = ["Propostas de emprego enviada, aguarde aceitação do Profissional!", RENTAL_ACCEPT];
        
    }
    
    private function UpdateAluguel() {
        $update = new Update();
        $qntVagaAluguel = count($this->Data['idVagaAluguel']);
        for($i = 0; $i < $qntVagaAluguel; $i++):
            $idArray = [ 'idUsuarioProfissional' => $this->Data['idUsuarioProfissional'], 'situacao' => $this->Data['situacao'], 'idVagaAluguel' =>  $this->Data['idVagaAluguel'][$i]];
            $update->ExeUpdate(self::ENTITY, $idArray , "WHERE idVagaAluguel = {$this->Data['idVagaAluguel'][$i]} and idUsuarioProfissional=:cadid", "cadid={$this->CadID}");
        endfor;
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> a categoria foi atualizada no sistema!",RENTAL_ACCEPT];
        endif;
    }
    
    private function UpdateVisualizada() {
        
        $update = new Update();
        $fim = count($this->Data);
        for($i = 0; $i < $fim; $i++):
            $idArray = ['visualizadoProfissional' => 1] ;
            $update->ExeUpdate(self::ENTITY, $idArray , "WHERE idVagaEmprego = {$this->Data[$i]['idVagaEmprego']} and idUsuarioProfissional=:cadid", "cadid={$this->CadID}");
        endfor;
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> a categoria foi atualizada no sistema!",RENTAL_ACCEPT];
        endif;
    }
    
     private function UpdateVisualizadaEmpresario() {
         
        $update = new Update();
      
        $fim = count($this->Data);
        
        for($i = 0; $i < $fim; $i++):
            $idArray = ['visualizadoEmpresario' => 1] ;
            $update->ExeUpdate(self::ENTITY, $idArray , "WHERE idVagaEmprego = {$this->Data[$i]['idVagaEmprego']} and idUsuarioEmpresario=:cadid", "cadid={$this->CadID}");
        endfor;
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> a categoria foi atualizada no sistema!",RENTAL_ACCEPT];
        endif;
    }
    
        private function UpdateEmprego() {
        $update = new Update();
        $qntVagaEmprego = count($this->Data['idVagaEmprego']);
        for($i = 0; $i < $qntVagaEmprego; $i++):
            $idArray = [ 'idUsuarioProfissional' => $this->Data['idUsuarioProfissional'], 'situacao' => $this->Data['situacao'], 'visualizadoEmpresario' => $this->Data['visualizadoEmpresario'], 'idVagaEmprego' =>  $this->Data['idVagaEmprego'][$i]];
            //var_dump($idArray);
                
        $update->ExeUpdate(self::ENTITY, $idArray , "WHERE idVagaEmprego = {$this->Data['idVagaEmprego'][$i]} and idUsuarioProfissional=:cadid", "cadid={$this->CadID}");
        endfor;
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["Você aceitou a proposta, aguarde o contato do salão!",RENTAL_ACCEPT];
        endif;
    }
}