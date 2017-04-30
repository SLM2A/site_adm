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
    private $idDelete;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ENTITY = 'salao';
    const salaoempresario = 'salaoempresario';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->Create();

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

    private function setDataSalao() {
        $this->SalaoEmpresario = array_map('strip_tags', $this->SalaoEmpresario); //limpar array
        $this->SalaoEmpresario = array_map('trim', $this->SalaoEmpresario); //limpar array
    }

    private function Create() {
        $Create = new Create;
        $Create->ExeCreate(self::ENTITY, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["O salão foi cadastrado no sistema!", RENTAL_ACCEPT];
        endif;
    }

    // Adiciona a relação Experiencia com o Usuario
    private function CreateExperiencia() {
        $Create = new Create;
        $Create->ExeCreate(self::salaoempresario, $this->SalaoEmpresario);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> a experiência foi cadastrada no sistema!", RENTAL_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idSalao = :cadId", "cadId={$this->CadID}");
        if ($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["O salão foi atualizado no sistema!", RENTAL_ACCEPT];
        endif;
    }
    
     private function Delete() {
        $delete = new Delete();
        
        $ProcuraVagaAluguel = new Read();
        $ProcuraVagaAluguel->FullRead("SELECT * FROM vagaaluguel WHERE idSalao={$this->idDelete}");
        $ProcuraVagaEmprego = new Read();
        $ProcuraVagaEmprego->FullRead("SELECT * FROM vagaemprego WHERE idSalao={$this->idDelete}");
        
        if((!$ProcuraVagaAluguel->getResult()) && (!$ProcuraVagaEmprego->getResult()) ):        
            $delete->ExeDelete(self::ENTITY, "WHERE idSalao = :idSalao", "idSalao={$this->idDelete}");        
            $delete->ExeDelete(self::salaoempresario, "WHERE idSalao = :idSalao", "idSalao={$this->idDelete}");
        else:
            $this->Result = TRUE;
            $this->Error = ["O Salão não pode ser deletado, existem vagas cadastradas!", RENTAL_ALERT];
        endif;    
        if ($delete->getResult()):
            $this->Result = TRUE;
            $this->Error = ["O Salão foi deletado do sistema!", RENTAL_ACCEPT];
        endif;
    }

}
