<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 22/03/2017
 * Time: 18:46
 */

class AdminCandidatarVaga{

    private $Data;
    private $CadID;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ALUGUEL = 'vagaaluguelcandidatada';
    const EMPREGO = 'vagaempregocandidata';

    public function ExeCreateAluguel(array $Data) {
        $this->Data = $Data;
        $this->CreateAluguel();
    }

    public function ExeCreateEmprego(array $Data) {
        $this->Data = $Data;
        $this->CreateEmprego();
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

    private function CreateAluguel() {
        $Create = new Create;
        $Create->ExeCreate(self::ALUGUEL, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> você está concorrendo a vaga, aguarde contato do Salão!",RENTAL_ACCEPT];
        endif;
    }

    private function CreateEmprego() {
        $Create = new Create;
        $Create->ExeCreate(self::EMPREGO, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> você está concorrendo a vaga, aguarde contato do Salão!",RENTAL_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ALUGUEL, $this->Data, "WHERE category_id = :catid", "catid={$this->CadID}");
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> {$this->Data['category_title']}, a categoria foi atualizada no sistema!",WS_ACCEPT];
        endif;
    }
}