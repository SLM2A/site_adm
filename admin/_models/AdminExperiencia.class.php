<?php

/**
 * AdminExperiencia.class [MODEL ADMIN]
 * Responsavel por gerenciar as experiencias profissionais do usuario do Rental Easy!
 * 
 * @copyright (c) 2017, Rafael Milaré
 */

class AdminCategory{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'experienciaProfissionalUsuario';
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        
        if(in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Preencha todos os campos!', WS_ALERT];
        else:
            $this->setData();        
//            $this->setName();
            $this->Create();
        endif;        
    }
    
    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;
        
        if(in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->Data['category_title']}, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();        
//            $this->setName();
            $this->Update();
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
        $this->Data ['cargoExperiencia'] = Check::Name($this->Data ['cargoExperiencia']); //criar o nome da categoria para o titu
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
        $this->Error = ["<b>Sucesso:</b> a experiência foi cadastrada no sistema!",WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE category_id = :catid", "catid={$this->CadID}");
        if($update->getResult()):
        $this->Result = TRUE;
        $this->Error = ["<b>Sucesso:</b> {$this->Data['category_title']}, a categoria foi atualizada no sistema!",WS_ACCEPT];
        endif;
    }
}