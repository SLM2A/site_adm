<?php

/**
 * AdminCategory.class [MODEL ADMIN]
 * Responsavel por gerenciar as cadegorias do sistema no admin!
 * 
 * @copyright (c) 2016, Marcelo Lima Doe
 */

class AdminAreaAtuacao{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'areaatuacao';
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        
        if(in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma categoria preencha todos os campos!', WS_ALERT];
        else:
            $this->setData();        
            $this->setName();
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
            $this->setName();
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
        $this->Data ['nomeProfissao'] = Check::Name($this->Data ['nomeProfissao']);//criar o nome da área de atuacao para o titulo        
    }
    
    private function setName() {
        $Where = ( !empty($this->cadID)?"idAreaAtuacao != {$this->CadID} AND " : ''); //verifica se existir cadID
        
        $readName = new Read;
        $readName->ExeRead(self::ENTITY, "WHERE {$Where} nomeProfissao = :t", "t={$this->Data['nomeProfissao']}");
        if ($readName->getResult()):
        $this->Data['nomeProfissao'] = $this->Data['nomeProfissao'] . '-' . $readName->getRowCount(); 
        endif;
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
        $this->Result = $Create->getResult();
        $this->Error = ["<b>Sucesso:</b> {$this->Data['nomeProfissao']}, a área de atuação foi cadastrada no sistema!",WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idAreaAtuacao = :catid", "catid={$this->CadID}");
        if($update->getResult()):
        $this->Result = TRUE;
        $this->Error = ["<b>Sucesso:</b> {$this->Data['nomeProfissao']}, a categoria foi atualizada no sistema!",WS_ACCEPT];
        endif;
    }
}