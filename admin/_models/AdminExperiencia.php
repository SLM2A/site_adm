<?php

/**
 * AdminExperiencia.class [MODEL ADMIN]
 * Responsavel por gerenciar as experiencias profissionais do usuario do Rental Easy!
 * 
 * @copyright (c) 2017, Rafael Milaré
 */

class AdminExperiencia{
    
    private $Data;
    private $ExperienciaUsuario;
    private $CadID;    
    private $idDelete;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'experienciaProfissionalUsuario';
    const EXPERIENCIAUSUARIO = 'experienciausuario';
    
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        
        
        if(in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Preencha todos os campos!', WS_ALERT];
        else:
            $this->setData();        
//          $this->setName();
            $this->Create();
        endif;        
    }
    
    
    public function InsereRelacao(array $ExperienciaUsuario) {
        
        $this->ExperienciaUsuario = $ExperienciaUsuario;
        
        if(in_array('', $this->ExperienciaUsuario))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Preencha todos os campos!', WS_ALERT];
        else:
            $this->setDataExp();
            $this->CreateExperiencia();
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
    
    public function ExeDelete($CadastroId) {
        $this->idDelete = (int) $CadastroId;
        $this->Delete();
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

    
    private function setDataExp() {
        $this->ExperienciaUsuario = array_map('strip_tags', $this->ExperienciaUsuario); //limpar array
        $this->ExperienciaUsuario = array_map('trim', $this->ExperienciaUsuario); //limpar array
        
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

    // Adiciona a relação Experiencia com o Usuario
    private function CreateExperiencia() {
        $Create = new Create;
        $Create->ExeCreate(self::EXPERIENCIAUSUARIO, $this->ExperienciaUsuario);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> a experiência foi cadastrada no sistema!", WS_ACCEPT];
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
    
    private function Delete() {
        $delete = new Delete();
        
        $delete->ExeDelete(self::ENTITY, "WHERE idExperiencia = :idExperiencia", "idExperiencia={$this->idDelete}");        
        $delete->ExeDelete(self::EXPERIENCIAUSUARIO, "WHERE idExperiencia = :idExperiencia", "idExperiencia={$this->idDelete}");        
        if ($delete->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> experiência deletada com sucesso!", RENTAL_ACCEPT];
        endif;
    }
}