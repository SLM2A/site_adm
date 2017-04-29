<?php

/**
 * AdminCategory.class [MODEL ADMIN]
 * Responsavel por gerenciar as cadegorias do sistema no admin!
 * 
 * @copyright (c) 2016, Marcelo Lima Doe
 */

class AdminEndereco{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'enderecousuario';
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->setData();        
        $this->Create();      
    }
    
    public function ExeUpdate($EnderecoId, array $Data) {
        $this->CadID = (int) $EnderecoId;
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
        $this->Error = ["O endereco foi cadastrado no sistema!",RENTAL_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idEndereco = :cadId", "cadId={$this->CadID}");
        if($update->getResult()):
        $this->Result = TRUE;
        $this->Error =["O endereco foi atualizado no sistema!",RENTAL_ACCEPT];
        endif;
    }
}

?>