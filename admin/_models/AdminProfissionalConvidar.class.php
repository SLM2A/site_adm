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
        $this->CreateAluguel();
        $this->CreateEmprego();
    }


    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;
    
            $this->UpdateAluguel();

    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    
    
    private function CreateAluguel() {
        $Create = new Create;
        $qntVagaAluguel = count($this->Data['idVagaAluguel']);
        for($i = 0; $i < $qntVagaAluguel; $i++):
            $idArray = ['idUsuarioEmpresario' => $this->Data['idUsuarioEmpresario'],  'idUsuarioProfissional' => $this->Data['idUsuarioProfissional'], 'situacao' => $this->Data['situacao'], 'idVagaAluguel'=>  $this->Data['idVagaAluguel'][$i] ];
            $Create->ExeCreate(self::ENTITY, $idArray);
          endfor;
        $this->Result = TRUE;
         if($Create->getResult()):
             $this->Error = ["<b>Sucesso:</b>  o usuário foi atualizado!", RENTAL_ACCEPT];
         endif;
    }

        private function CreateEmprego() {
        $Create = new Create;
        $qntVagaAluguel = count($this->Data['idVagaEmprego']);
        for($i = 0; $i < $qntVagaAluguel; $i++):
            $idArray = ['idUsuarioEmpresario' => $this->Data['idUsuarioEmpresario'],  'idUsuarioProfissional' => $this->Data['idUsuarioProfissional'], 'situacao' => $this->Data['situacao'], 'idVagaEmprego'=>  $this->Data['idVagaEmprego'][$i]];
            $Create->ExeCreate(self::ENTITY, $idArray);
          endfor;
        $this->Result = TRUE;
         if($Create->getResult()):
             $this->Error = ["<b>Sucesso:</b>  o usuário foi atualizado!", RENTAL_ACCEPT];
         endif;
    }
    
    private function UpdateAluguel() {
        $update = new Update();
        $qntVagaAluguel = count($this->Data['idVagaAluguel']);
        for($i = 0; $i < $qntVagaAluguel; $i++):
            $idArray = [ 'idUsuarioProfissional' => $this->Data['idUsuarioProfissional'], 'situacao' => $this->Data['situacao'], 'idVagaAluguel'=>  $this->Data['idVagaAluguel'][$i]];
            $update->ExeUpdate(self::ENTITY, $idArray , "WHERE idVagaAluguel = {$this->Data['idVagaAluguel'][$i]} and idUsuarioProfissional=:cadid", "cadid={$this->CadID}");
        endfor;
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> a categoria foi atualizada no sistema!",WS_ACCEPT];
        endif;
    }
}