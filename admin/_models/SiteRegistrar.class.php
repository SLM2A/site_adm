<?php

/**
 * AdminCategory.class [MODEL ADMIN]
 * Responsavel por gerenciar as cadegorias do sistema no admin!
 * 
 * @copyright (c) 2016, Marcelo Lima Doe
 */


class SiteRegistrar{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'usuario';
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $readEmail = new Read;
        
        if(in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma categoria preencha todos os campos!', RENTAL_ACCEPT];
        else:
            $this->setData();     
            $this->setEmail();
            if($this->setEmail()==1):
                $this->Error = ['<b>O E-mail escolhido já está em uso</b>', RENTAL_ALERT];
           else:        
            $this->Create();
           endif;
        endif;
    }
    
    public function ExeUpdate($idUsuario, array $Data) {
        $this->CadID = (int) $idUsuario;
        $this->Data = $Data;
       
            $this->Update();
             
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
        $this->Data ['nomeUsuario'] = Check::Name($this->Data['nomeUsuario']);//criar o nome da categoria para o titulo
        }
    
    private function setName() {
        $Where = ( !empty($this->cadID)?"idUsuario != {$this->CadID} AND " : ''); //verifica se existir cadID
        
        $readName = new Read;
        $readName->ExeRead(self::ENTITY, "WHERE {$Where} nomeUsuario = :t", "t={$this->Data['nomeUsuario']}");
        if ($readName->getResult()):
        $this->Data['nomeUsuario'] = $this->Data['nomeUsuario'] . '-' . $readName->getRowCount(); 
        endif;
    }

       private function setEmail() {
        $Where = ( !empty($this->cadID)?"idUsuario != {$this->CadID} AND " : ''); //verifica se existir cadID
        $readEmail = new Read;
        $readEmail->ExeRead(self::ENTITY, "WHERE {$Where} email = :t", "t={$this->Data['email']}");
        if ($readEmail->getResult()):
            return 1;
        endif;
    }
    
    
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
        $this->Result = $Create->getResult();
        $this->Error = ["O Perfil foi registrado no sistema!",RENTAL_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idUsuario = :cadId", "cadId={$this->CadID}");
        if($update->getResult()):
        $this->Result = TRUE;
        $this->Error = ["O Perfil foi atualizado no sistema!",RENTAL_ACCEPT];
        endif;
    }
    
    private function Delete() {
        $delete = new Delete();
        
        $delete->ExeDelete(self::ENTITY, "WHERE idUsuario = :idUsuario", "idUsuario={$this->idDelete}");        
        
        if ($delete->getResult()):
            $this->Result = TRUE;
            $this->Error = ["O Perfil foi deletado do sistema!", RENTAL_ACCEPT];
        endif;
    }

}

