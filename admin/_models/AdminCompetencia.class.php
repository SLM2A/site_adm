<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 17/03/2017
 * Time: 19:00
 */

class AdminCompetencia{

    private $Data;
    private $CadID;
    private $File = Array();
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ENTITY = 'habilidadeusuario';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->Create();

    }

    public function ExeUpdate($idUsuario, array $Data) {
        $this->CadID = (int) $idUsuario;
        $this->Data = $Data;

        if(in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar o cliente, preencha todos os campos!", WS_ALERT];
        else:
            $this->Update();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }


     private function Create() {
        $Create = new Create;
         $Delet = new Delete();

         $Delet->ExeDelete(self::ENTITY, "Where idUsuario = :id", "id={$this->Data['idUsuario']}");

         $qntAreaAtuacao = count($this->Data['idAreaAtuacao']);

         for($i = 0; $i < $qntAreaAtuacao; $i++):
            $idArray = ['idAreaAtuacao'=>  $this->Data['idAreaAtuacao'][$i], 'idUsuario' => $this->Data['idUsuario']];
            $Create->ExeCreate(self::ENTITY, $idArray);
         endfor;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idUsuario = :cadId", "cadId={$this->CadID}");
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b>  o usuário foi atualizado!",RENTAL_ACCEPT];
        endif;
    }
}
