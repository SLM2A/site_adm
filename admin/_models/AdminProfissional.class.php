<?php

/**
 * AdminCategory.class [MODEL ADMIN]
 * Responsavel por gerenciar as cadegorias do sistema no admin!
 * 
 * @copyright (c) 2016, Marcelo Lima Doe
 */


class AdminProfissional{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'usuario';
    const DB_AREAATUACAO = 'areaatuacao';
    
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
        $this->Data ['nomeUsuario'] = Check::Name($this->Data ['nomeUsuario']);//criar o nome da categoria para o titulo
        }
    
    private function setName() {
        $Where = ( !empty($this->cadID)?"idUsuario != {$this->CadID} AND " : ''); //verifica se existir cadID
        
        $readName = new Read;
        $readName->ExeRead(self::ENTITY, "WHERE {$Where} nomeUsuario = :t", "t={$this->Data['nomeUsuario']}");
        if ($readName->getResult()):
        $this->Data['nomeUsuario'] = $this->Data['nomeUsuario'] . '-' . $readName->getRowCount(); 
        endif;
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
        $this->Result = $Create->getResult();
        $this->Error = ["<b>Sucesso:</b> {$this->Data['nomeUsuario']}, a categoria foi cadastrada no sistema!",WS_ACCEPT];
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

