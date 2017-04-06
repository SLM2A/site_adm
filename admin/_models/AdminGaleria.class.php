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
    private $Msg;
    private $Result;
    private $SendFull;
    private $SendSmall;
    private $idPortfolio;

    //Nome da tabela no banco de dados!
    const ENTITY = 'portfolio';

    public function ExeCreate(array $imagens, $postID, $NomeCompletoUsuario ) {
        $this->Data = $imagens;
        $this->Post = $postID;
        $this->NomeCompletoUsuario = $NomeCompletoUsuario;
        
        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array            
            $this->Msg = ['<b>Erro ao enviar!</b> Selecione uma ou mais imagens', RENTAL_INFOR];
            $this->Result = false;
        else:            
            $this->setData();
            $this->Create();
        endif;
    }
    
    /*public function gbSend(array $imagens, $postID, $NomeCompletoUsuario ){
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
            
        
        
    }*/

    public function ExeUpdate($CategoryId, array $Data) {
        $this->CadID = (int) $CategoryId;
        $this->Data = $Data;

        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array
            $this->Result = FALSE;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria {$this->Data['category_title']}, preencha todos os campos!", RENTAL_ERROR];
        else:
            $this->Update();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getMsg() {
        return $this->Msg;
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
        $ImagemFull = new Upload();
        $ImagemSmall = new Upload();
        
        foreach ($this->File as $gbUpload):
            $ImgNameFull = "temp1";
            $ImagemFull->Image($gbUpload, $ImgNameFull,null,$this->NomeCompletoUsuario."-".$this->Post);
            $this->ImagemFull($ImagemFull->getResult(), $ImagemFull->getSend());

           $ImgNameSmall = "temp2";
           $ImagemSmall->Image($gbUpload, $ImgNameSmall,null,$this->NomeCompletoUsuario."-".$this->Post);
           $this->ImagemSmall($ImagemSmall->getResult(), $ImagemSmall->getSend());

           if ($ImagemFull->getResult()):
               $gbCreate = ["idUsuario" => $this->Post, "portfolioImagemFull"=> $this->SendFull, "portfolioImagemSmall"=> $this->SendSmall, "dataImagem"=> date('Y-m-d H:i:s')];
               $insertGb = new create();
               $insertGb->ExeCreate(self::ENTITY, $gbCreate);
               if($insertGb->getResult()):
                   $this->Result = TRUE;
                   $this->Msg = ["<b>Sucesso:</b> a(s) imagem(s) imagens foram gravadas com sucesso!",RENTAL_ACCEPT];
               else:
                   $this->Result = FALSE;
                   $this->Msg = ["<b>Erro:</b> a(s) imagem(s) imagens não foram gravadas com sucesso!",RENTAL_ERROR];
               endif;
           endif;
        endforeach;


    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idPortfolio = :idport", "idport={$this->idPortfolio}");
        if($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b>, a imagem foi atualizada com sucesso!",RENTAL_ACCEPT];
        endif;
    }

    private function ImagemFull ($Endereço, $Caminho){
        $rand = rand(5, 30);
        require_once('../../_app/WideImage/WideImage.php');
        $img = WideImage::load("../uploads/".$Endereço);
        $img = $img->resize(800, 600, 'outside');
        $this->SendFull = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->Post}-FULL-".(substr(md5(time() + $rand), 0,5)).".jpg";
        $img->saveToFile("../uploads/".$this->SendFull);
        $img->destroy();

        if(isset($img)):
            $this->Result = TRUE;
            $this->Msg = ["<b>Sucesso:</b> a imagem foi convertida para tamanho grande!",RENTAL_ACCEPT];
        else:
            $this->Result = FALSE;
            $this->Msg = ["<b>Erro:</b> a imagem não foi convertida para tamanho grande!",RENTAL_ERROR];
        endif;
    }

    private function ImagemSmall ($Endereço, $Caminho){
        $rand = rand(5, 30);
        require_once('../../_app/WideImage/WideImage.php');
        $img = WideImage::load("../uploads/".$Endereço);
        $img = $img->resize(1500, 1500, 'outside');
        $this->SendSmall = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->Post}-SMALL-".(substr(md5(time() + $rand), 0,5)).".jpg";
        $img->saveToFile("../uploads/".$this->SendSmall);
        $img->destroy();

        list($width, $height, $type, $attr) = getimagesize("../uploads/".$this->SendSmall);
        $w = $width / 2;
        $h = $height / 2;
        $img = WideImage::load("../uploads/".$this->SendSmall);
        $img = $img->crop($w/2, $h/2, 1000, 1000);
        $img->saveToFile("../uploads/".$this->SendSmall);
        $img->destroy();

        if(isset($img)):
            $this->Result = TRUE;
            $this->Msg = ["<b>Sucesso:</b> a imagem foi convertida para tamanho pequeno!",RENTAL_ACCEPT];
        else:
            $this->Result = FALSE;
            $this->Msg = ["<b>Erro:</b> a imagem não foi convertida para tamanho pequeno!",RENTAL_ERROR];
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
