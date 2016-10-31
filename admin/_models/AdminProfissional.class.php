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
    const ENTITY = 'ws_categories';
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
        $this->Data ['category_name'] = Check::Name($this->Data ['category_title']);//criar o nome da categoria para o titulo
        $this->Data ['category_date'] = Check::Data($this->Data ['category_date']);//Rescrever data no formato TIME STAMP
        $this->Data ['category_parent'] = ($this->Data['category_parent'] == 'null' ? NULL : $this->Data['category_parent'] == $this->Data['category_parent']);
    }
    
    private function setName() {
        $Where = ( !empty($this->cadID)?"category_id != {$this->CadID} AND " : ''); //verifica se existir cadID
        
        $readName = new Read;
        $readName->ExeRead(self::ENTITY, "WHERE {$Where} category_title = :t", "t={$this->Data['category_title']}");
        if ($readName->getResult()):
        $this->Data['category_title'] = $this->Data['category_title'] . '-' . $readName->getRowCount(); 
        endif;
    }

  //  puxando area de atuação para o autocomplete - qual sua profissão
    public function readAreaAtuacao() {
        $search = mysql_real_escape_string($_GET['term']);
        $readName = new Read;
        $readName->ExeRead(self::DB_AREAATUACAO, "WHERE nome LIKE '%$search%' ORDER BY nomeProfissao", "");
        
        $resJson="[";
        $first = true;
     
        while($res = mysql_fetch_assoc($readName->getResult())):
            if(!$first):
                $resJson .=', ';
            else:
                $first = false;
            endif;
           
        $resJson .= json_encode($res['nomeProfissao']);  
        
        endwhile;      
                
       $resJson .=']';
       
       echo $resJson;
              
    }
    
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
        $this->Result = $Create->getResult();
        $this->Error = ["<b>Sucesso:</b> {$this->Data['category_title']}, a categoria foi cadastrada no sistema!",WS_ACCEPT];
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