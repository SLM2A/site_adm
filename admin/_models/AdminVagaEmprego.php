<?php

/**
 * AdminVagaEmprego.class [MODEL ADMIN]
 * Responsavel por gerenciar as vagas de emprego de um salão!
 * 
 * @copyright (c) 2017, Rafael Milaré
 */

class AdminVagaEmprego{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'vagaemprego';
    const experienciausuario = 'experienciausuario';
    
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->setData();        
         $this->Create();
    }
    
    
    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;
        $this->setData();        
        $this->Update();    
    }
    
    function getResult() {
        return $this->Result;
    }
        
    function getError() {
        return $this->Error;
    }
    
    //PRIVATE    
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data); //limpar array
        $this->Data = array_map('trim', $this->Data); //limpar array
           }

//    private function setName() {
//        $Where = ( !empty($this->cadID)?"idExperiencia != {$this->CadID} AND " : ''); //verifica se existir cadID
//        
//        $readName = new Read;
//        $readName->ExeRead(self::ENTITY, "WHERE {$Where} category_title = :t", "t={$this->Data['category_title']}");
//        if ($readName->getResult()):
//        $this->Data['category_title'] = $this->Data['category_title'] . '-' . $readName->getRowCount(); 
//        endif;
//    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
        $this->Result = $Create->getResult();
        $this->Error = ["<b>Sucesso:</b> a vaga foi cadastrada no sistema!",WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idVagaEmprego = :cadid", "cadid={$this->CadID}");
        if($update->getResult()):
        $this->Result = TRUE;
        $this->Error = ["<b>Sucesso:</b>, a vaga foi atualizada no sistema!",WS_ACCEPT];
        endif;
    }
}