<?php

/**
 * AdminCategory.class [MODEL ADMIN]
 * Responsavel por gerenciar as cadegorias do sistema no admin!
 * 
 * @copyright (c) 2016, Marcelo Lima Doe
 */


class AdminRedeSocial{
    
    private $Data;
    private $id;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'redesocial';
       
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        
        
            $this->setData();        
            $this->Create();
     }
    
    public function ExeUpdate($id, array $Data) {
        $this->id = (int) $id;
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
    

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
        $this->Result = $Create->getResult();
        $this->Error = ["<b>Sucesso:</b> as redes sociais foram cadastradas no RentalEasy!",WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idRedeSocial = :catid", "catid={$this->id}");
        if($update->getResult()):
        $this->Result = TRUE;
        $this->Error = ["<b>Sucesso:</b> as redes sociais foram atualizadas no RentalEasy!",WS_ACCEPT];
        endif;
    }
}

