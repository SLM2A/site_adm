<?php

/**
 * AdminMensagem.class [MODEL ADMIN]
 * Responsavel por enviar, alterar e excluir mensagens do sistema no admin!
 * 
 * @copyright (c) 2017, Rafael Milaré
 */
class AdminMensagem {

    private $Data;
    private $CadID;
    private $idDelete;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ENTITY = 'mensagem';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->Create();
    }

    public function ExeUpdate($idUsuario, array $Data) {
        $this->CadID = $idUsuario;
        $this->Data = $Data;

        $this->Update();
    }

    public function ExeUpdateLida($idUsuario, array $Data) {
        $this->CadID = $idUsuario;
        $this->Data = $Data;

        $this->UpdateLida();
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    public function ExeDelete($CadastroId) {
        $this->idDelete = $CadastroId;
        $this->Delete();
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["Mensagem Enviada com Sucesso! ", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        foreach ($this->CadID as $id):
            $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idMensagem = :cadId", "cadId={$id}");
        endforeach;
        if ($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["Mensagens deletadas do sistema!", RENTAL_ACCEPT];
        endif;
    }

    private function UpdateLida() {
        $update = new Update();

        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idMensagem = :cadId", "cadId={$this->CadID}");
            
        if ($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b>  o usuário foi atualizado!", RENTAL_ACCEPT];
        endif;
    }

    private function Delete() {
        $delete = new Delete();
        foreach ($this->idDelete as $id):
            $delete->ExeDelete(self::ENTITY, "WHERE idMensagem = :idMensagem", "idMensagem={$id}");
        endforeach;

        if ($delete->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Mensagem</b> deletada!", RENTAL_ACCEPT];
        endif;
    }

}
