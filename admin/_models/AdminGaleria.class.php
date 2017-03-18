<?php

/**
 * AdminGaleria.class [MODEL ADMIN]
 * Responsavel por gerenciar a galeria do usuario do Rental Easy!
 * 
 * @copyright (c) 2017, Marcelo Lima
 */

class AdminGaleria {

    private $Data;
    private $File = Array();
    private $NomeCompletoUsuario;
    private $Post;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados!
    const ENTITY = 'portfolio';

    public function ExeCreate(array $imagens, $postID, $NomeCompletoUsuario ) {
        $this->Data = $imagens;
        $this->Post = $postID;
        $this->NomeCompletoUsuario = $NomeCompletoUsuario;
        
        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array            
            $this->Error = ['<b>Erro ao enviar!</b> Selecione uma ou mais imagens', WS_INFOR];
            $this->Result = false;
        else:            
            $this->setData();
            $this->Create();
            
            if($this->getResult()):
                //WSErro("<b>Sucesso:</b> a imagem foi inserida com sucesso!", WS_ACCEPT);
                RentalErro("<b>Sucesso:</b> a imagem foi inserida com sucesso!", RENTAL_ERROR);
            else:
                WSErro("<b>Erro:</b> a imagem não pode ser inserida!", WS_ERROR);
            endif;                      
        endif;
    }
    
    public function gbSend(array $imagens, $postID, $NomeCompletoUsuario ){
        $this->Post = (int) $postID;
        $this->Data = $imagens;
        
        $gbCont = count($this->Data['tmp_name']);
        $gbKeys = array_keys($this->Data);

        for($gb = 0; $gb < $gbCont; $gb++):
            foreach ($gbKeys as $key):
                $this->File[$gb][$key] = $this->Data[$key][$gb];
            endforeach;
        endfor;
        
        $gbSend = new Upload();
        $i = 0;
        
        foreach ($this->File as $gbUpload):
            $i++;
            $ImgName = "{$NomeCompletoUsuario}-gb-{$this->Post}-".(substr(md5(time() + $i), 0,5));
            $gbSend->Image($gbUpload, $ImgName);
            
            if ($gbSend->getResult()):
                $gbImage = $gbSend->getResult();
                $gbCreate = ["idUsuario" => $this->Post, "portfolioImagem"=> $gbImage, "dataImagem"=> date('Y-m-d H:i:s')];
                $insertGb = new create();
                $insertGb->ExeCreate(self::ENTITY, $gbCreate);
            endif;
        endforeach;
            
        
        
    }

//    public function ExeUpdate($CategoryId, array $Data) {
//        $this->CadID = (int) $CategoryId;
//        $this->Data = $Data;
//
//        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array
//            $this->Result = false;
//            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->Data['category_title']}, preencha todos os campos!", WS_ALERT];
//        else:
//            $this->setData();
////            $this->setName();
//            $this->Update();
//        endif;
//    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }
    
    

    //PRIVATE    
    private function setData() {
        $gbCont = count($this->Data['tmp_name']);
        $gbKeys = array_keys($this->Data);

        for($gb = 0; $gb < $gbCont; $gb++):
            foreach ($gbKeys as $key):
                $this->File[$gb][$key] = $this->Data[$key][$gb];
            endforeach;
        endfor;
    }

    private function Create() {
        $gbSend = new Upload();
        $i = 0;
        
        foreach ($this->File as $gbUpload):
            $i++;
            $ImgName = "{$this->NomeCompletoUsuario}-gb-{$this->Post}-".(substr(md5(time() + $i), 0,5));
            $gbSend->Image($gbUpload, $ImgName);
            
            if ($gbSend->getResult()):
                $gbImage = $gbSend->getResult();
                $gbCreate = ["idUsuario" => $this->Post, "portfolioImagem"=> $gbImage, "dataImagem"=> date('Y-m-d H:i:s')];
                $insertGb = new create();
                $insertGb->ExeCreate(self::ENTITY, $gbCreate);
            endif;
        endforeach;
        
        if ($insertGb->getResult()):            
            $this->Result = $insertGb->getResult();
            
       endif;
    }

//    // Adiciona a relação Experiencia com o Usuario
//    private function CreateExperiencia() {
//        $Create = new Create;
//        $Create->ExeCreate(self::salaoempresario, $this->CertificadoUsuario);
//        if ($Create->getResult()):
//            $this->Result = $Create->getResult();
//            $this->Error = ["<b>Sucesso:</b> a experiência foi cadastrada no sistema!", WS_ACCEPT];
//        endif;
//    }
//
//    private function Update() {
//        $update = new Update();
//        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE category_id = :catid", "catid={$this->CadID}");
//        if ($update->getResult()):
//            $this->Result = TRUE;
//            $this->Error = ["<b>Sucesso:</b> {$this->Data['category_title']}, a categoria foi atualizada no sistema!", WS_ACCEPT];
//        endif;
//    }

}
