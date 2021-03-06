<?php

/**
 * AdminCertificado.class [MODEL ADMIN]
 * Responsavel por gerenciar os certificados do usuario do Rental Easy!
 * 
 * @copyright (c) 2017, Rafael Milaré
 */
class AdminCertificado {

    private $Data;
    private $CertificadoUsuario;
    private $CadID;
    private $idDelete;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ENTITY = 'certificadoprofissionalusuario';
    const CERTIFICADOUSUARIO = 'certificadousuario';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;


        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Preencha todos os campos!', RENTAL_ALERT];
        else:
            $this->setData();
//          $this->setName();
            $this->Create();
        endif;
    }

    public function InsereRelacao(array $CertificadoUsuario) {

        $this->CertificadoUsuario = $CertificadoUsuario;

        if (in_array('', $this->CertificadoUsuario))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ['<b>Erro ao cadastrar:</b> Preencha todos os campos!', RENTAL_ALERT];
        else:
            $this->setDataExp();
            $this->CreateExperiencia();
        endif;
    }

    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;

        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = false;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->Data['category_title']}, preencha todos os campos!", RENTAL_ALERT];
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
        $this->Data ['instituicaoCertificado'] = Check::Name($this->Data ['instituicaoCertificado']); //criar o nome da categoria para o titu
    }

    private function setDataExp() {
        $this->CertificadoUsuario = array_map('strip_tags', $this->CertificadoUsuario); //limpar array
        $this->CertificadoUsuario = array_map('trim', $this->CertificadoUsuario); //limpar array
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
            $this->Error = ["A certificação foi cadastrada no sistema!", RENTAL_ACCEPT];
        endif;
    }

    // Adiciona a relação Experiencia com o Usuario
    private function CreateExperiencia() {
        $Create = new Create;
        $Create->ExeCreate(self::CERTIFICADOUSUARIO, $this->CertificadoUsuario);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE category_id = :catid", "catid={$this->CadID}");
        if ($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> {$this->Data['category_title']}, a categoria foi atualizada no sistema!", RENTAL_ACCEPT];
        endif;
    }
    
    private function Delete() {
        $delete = new Delete();
        
        $delete->ExeDelete(self::ENTITY, "WHERE idCertificado = :idCertificado", "idCertificado={$this->idDelete}");        
        $delete->ExeDelete(self::CERTIFICADOUSUARIO, "WHERE idCertificado = :idCertificado", "idCertificado={$this->idDelete}");        
        if ($delete->getResult()):
            $this->Result = TRUE;
            $this->Error = ["A certificação foi deletada do sistema!", RENTAL_ACCEPT];
        endif;
    }

}
