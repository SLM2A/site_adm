<?php

/**
 * AdminCategory.class [MODEL ADMIN]
 * Responsavel por gerenciar as cadegorias do sistema no admin!
 * 
 * @copyright (c) 2016, Marcelo Lima Doe
 */

class AdminCategory{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'ws_categories';
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        
        if(in_array('', $this->Data)):
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma categoria preencha todos os campos!', WS_ALERT];
        else:
            $this->setData();        
            $this->setName();
        endif;        
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
        $this->Data ['category_name'] = Check::Name($this->Data ['cateory_title']);//criar o nome da categoria para o titulo
        $this->Data ['category_date'] = Check::Data($this->Data ['cateory_date']);//Rescrever data no formato TIME STAMP
        $this->Data ['category_parent'] = ($this->Data['category_parent'] == 'null' ? NULL : $this->Data['category_parent'] == $this->Data['category_parent']);
    }
    
    private function setName() {
        $Where = ( !empty($this->cadID)?"category_id != {$this->CadID} AND " : ''); //se existir cadID esta editando 
    }


    
}