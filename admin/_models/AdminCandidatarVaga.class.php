<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 22/03/2017
 * Time: 18:46
 */

class AdminCandidatarVaga{

    private $Data;
    private $CadID;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ALUGUEL = 'vagaaluguelcandidatada';
    const EMPREGO = 'vagaempregocandidata';

    public function ExeCreateAluguel(array $Data) {
        $this->Data = $Data;
        $this->CreateAluguel();
    }
      public function ExeCreateArray(array $Data) {
        
        if(empty($this->Data['idVagaAluguel'])):
            $this->CreateEmpregoArray();
        elseif (empty($this->Data['idVagaEmprego'])):
            $this->CreateAluguelArray();
        else:
            $this->CreateAluguelArray();
            $this->CreateEmpregoArray();  
        endif;
       }

    public function ExeCreateEmprego(array $Data) {
        $this->Data = $Data;
        $this->CreateEmprego();
    }
    

    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;

        if(in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar,</b>  preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
//            $this->setName();
            $this->Update();
        endif;
    }
    
    public function ExeUpdateVisualizacaoAluguel($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;
        $this->UpdateVisualizacaoAluguel();        
    }
    public function ExeUpdateVisualizacaoEmprego($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;
        $this->UpdateVisualizacaoEmprego();        
    }
    

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    private function CreateAluguel() {
        $Create = new Create;
        $Create->ExeCreate(self::ALUGUEL, $this->Data);
        
            $this->Result = TRUE;
            $this->Error = ["Você acaba de se candidatar a vaga, aguarde contato do salão!",RENTAL_ACCEPT];
        
    }
    
    private function CreateAluguelArray() {
        $Create = new Create;
        $qntVagaAluguel = count($this->Data['idVagaAluguel']);
        for($i = 0; $i < $qntVagaAluguel; $i++):
            $idArray = ['idUsuarioProfissional' => $this->Data['idUsuarioProfissional'], 'idVagaAluguel'=>  $this->Data['idVagaAluguel'][$i]];
            $Create->ExeCreate(self::ALUGUEL, $idArray);
         endfor;
        
            $this->Result = TRUE;
            $this->Error = ["Você acaba de se candidatar a vaga, aguarde contato do salão!",RENTAL_ACCEPT];
       
    }

    private function CreateEmprego() {
        $Create = new Create;
        $Create->ExeCreate(self::EMPREGO, $this->Data);
        $this->Result = TRUE;
        $this->Error = ["Você acaba de se candidatar a vaga, aguarde contato do salão!",RENTAL_ACCEPT];
        
    }
    
    private function CreateEmpregoArray() {
        $Create = new Create;
        $qntVagaEmprego = count($this->Data['idVagaEmprego']);
        for($i = 0; $i < $qntVagaEmprego; $i++):
            $idArray = ['idUsuario' => $this->Data['idUsuarioProfissional'], 'idVagaEmprego'=>  $this->Data['idVagaEmprego'][$i]];
            $Create->ExeCreate(self::EMPREGO, $idArray);
         endfor;
        
            $this->Result = TRUE;
            $this->Error = ["Você acaba de se candidatar as vagas, aguarde contato do salão!",RENTAL_ACCEPT];
        
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ALUGUEL, $this->Data, "WHERE category_id = :catid", "catid={$this->CadID}");
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> {$this->Data['category_title']}, a categoria foi atualizada no sistema!",RENTAL_ACCEPT];
        endif;
    }
    
    private function UpdateVisualizacaoAluguel() {
        
        $update = new Update();
        $fim = count($this->Data);
        for($i = 0; $i < $fim; $i++):
            $idArray = ['situacao' => 1] ;
            $update->ExeUpdate(self::ALUGUEL, $idArray , "WHERE idVagaAluguel =:id ", "id={$this->Data[$i]['idVagaAluguel']}");
        endfor;
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> a categoria foi atualizada no sistema!",RENTAL_ACCEPT];
        endif;
    }
     
    private function UpdateVisualizacaoEmprego() {
        
        $update = new Update();
        $fim = count($this->Data);
        for($i = 0; $i < $fim; $i++):
            $idArray = ['situacao' => 1] ;
            $update->ExeUpdate(self::EMPREGO, $idArray , "WHERE idVagaEmprego =:id ", "id={$this->Data[$i]['idVagaEmprego']}");
        endfor;
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> a categoria foi atualizada no sistema!",RENTAL_ACCEPT];
        endif;
    }
}