<?php

/**
 * AdminMensagem.class [MODEL ADMIN]
 * Responsavel por enviar, alterar e excluir mensagens do sistema no admin!
 * 
 * @copyright (c) 2017, Rafael Milaré
 */


class AdminMensagem{
    
    private $Data;
    private $CadID;
    private $Error;
    private $Result;
    
    //Nome da tabela no banco de dados!
    const ENTITY = 'mensagem';
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->Create();    
    }
    
    public function ExeUpdate($idUsuario, array $Data) {
        $this->CadID = (int) $idUsuario;
        $this->Data = $Data;
       
            $this->Update();
                
    }
    
    function getResult() {
        return $this->Result;
    }
        
    function getError() {
        return $this->Error;
    }
    
       
    
    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
        $this->Result = $Create->getResult();
        $this->Error = ["Mensagem Enviada com Sucesso! ",WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idMensagem = :cadId", "cadId={$this->CadID}");
        if($update->getResult()):
        $this->Result = TRUE;
        $this->Error = ["<b>Sucesso:</b>  o usuário foi atualizado!",RENTAL_ACCEPT];
        endif;
    }
}

