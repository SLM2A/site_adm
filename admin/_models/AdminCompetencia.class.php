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
    private $Result = false;

    //Nome da tabela no banco de dados!
    const ENTITY = 'habilidadeusuario';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->Create();

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
             $this->Result = TRUE;
             $this->Error = ["As Competência foram atualizadas no sistema", RENTAL_ACCEPT];
         
    }

}
