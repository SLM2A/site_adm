<?php

/**
 * AdminSalao.class [MODEL ADMIN]
 * Responsavel por cadastrar os salões dos Empresarios!
 * 
 * @copyright (c) 2017, Rafael Milaré
 */
class AdminSalao {

    private $Data;
    private $SalaoEmpresario;
    private $CadID;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ENTITY = 'salao';
    const salaoempresario = 'salaoempresario';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;


        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Preencha todos os campos!', WS_ALERT];
        else:
            $this->setData();
//          $this->setName();
            $this->Create();
        endif;
    }

    public function InsereRelacao(array $SalaoEmpresario) {

        $this->SalaoEmpresario = $SalaoEmpresario;

        if (in_array('', $this->SalaoEmpresario))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Preencha todos os campos!', WS_ALERT];
        else:
            $this->setDataSalao();
            $this->CreateExperiencia();
        endif;
    }

    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;

        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array
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

    //PRIVATE    
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data); //limpar array
        $this->Data = array_map('trim', $this->Data); //limpar array
        $this->Data ['nomeSalao'] = Check::Name($this->Data ['nomeSalao']); //criar o nome da categoria para o titu
    }

    private function setDataSalao() {
        $this->SalaoEmpresario = array_map('strip_tags', $this->SalaoEmpresario); //limpar array
        $this->SalaoEmpresario = array_map('trim', $this->SalaoEmpresario); //limpar array
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
            $this->Error = ["<b>Sucesso:</b> a experiência foi cadastrada no sistema!", WS_ACCEPT];
        endif;
    }

    // Adiciona a relação Experiencia com o Usuario
    private function CreateExperiencia() {
        $Create = new Create;
        $Create->ExeCreate(self::salaoempresario, $this->SalaoEmpresario);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> a experiência foi cadastrada no sistema!", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE category_id = :catid", "catid={$this->CadID}");
        if ($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> {$this->Data['category_title']}, a categoria foi atualizada no sistema!", WS_ACCEPT];
        endif;
    }

}
