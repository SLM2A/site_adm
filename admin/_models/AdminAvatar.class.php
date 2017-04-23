<?php

/**
 * AdminGaleria.class [MODEL ADMIN]
 * Responsavel por gerenciar a galeria do usuario do Rental Easy!
 * 
 * @copyright (c) 2017, Marcelo Lima
 */
class AdminAvatar {

    private $Data;
    private $NomeCompletoUsuario;
    private $idUsuario;
    private $Msg;
    private $Result;
    private $SendAvatar;

    //Nome da tabela no banco de dados!
    const ENTITY = 'usuario';

    public function ExeCreate(array $imagens, $postID, $NomeCompletoUsuario) {
        $this->Data = $imagens;
        $this->idUsuario = $postID;
        $this->NomeCompletoUsuario = $NomeCompletoUsuario;
        $this->Create();
    }
    
        public function ExeCreateSalao(array $imagens, $postID, $NomeCompletoUsuario) {
        $this->Data = $imagens;
        $this->idUsuario = $postID;
        $this->NomeCompletoUsuario = $NomeCompletoUsuario;
        $this->CreateSalao();
    }


    function getResult() {
        return $this->Result;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getSendAvatar(){
        return $this->SendAvatar;
    }

    //PRIVATE
    private function Create() {
        $ImgName = "temp1";
        $ImgAvatar = new Upload();
        $ImgAvatar->Image($this->Data, $ImgName, null, $this->NomeCompletoUsuario . "-" . $this->idUsuario);
        $this->ImagemAvatar($ImgAvatar->getResult(), $ImgAvatar->getSend());
    }
      private function CreateSalao() {
        $ImgName = "temp1";
        $ImgAvatar = new Upload();
        $ImgAvatar->Image($this->Data, $ImgName, null, $this->NomeCompletoUsuario . "-" . $this->idUsuario);
        $this->ImagemSalao($ImgAvatar->getResult(), $ImgAvatar->getSend());
    }

    private function ImagemAvatar($Endereço, $Caminho) {
        $rand = rand(5, 30);
        require_once('../../_app/WideImage/WideImage.php');
        $img = WideImage::load("../uploads/" . $Endereço);
        $img = $img->resize(220, 220, 'outside');
        $this->SendAvatar = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->idUsuario}-AVATAR-" . (substr(md5(time() + $rand), 0, 5)) . ".jpg";
        $img->saveToFile("../uploads/" . $this->SendAvatar);
        $img->destroy();
        list($width, $height, $type, $attr) = getimagesize("../uploads/" . $this->SendAvatar);
        $w = $width / 2;
        $h = $height / 2;
        $imgSmall = WideImage::load("../uploads/" . $this->SendAvatar);
        $imgSmall = $imgSmall->crop($w / 2, $h / 2, 128, 128);
        $this->SendAvatar = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->idUsuario}-AVATAR-" . (substr(md5(time() + $rand), 0, 5)) . ".jpg";
        $imgSmall->saveToFile("../uploads/" . $this->SendAvatar);
        $imgSmall->destroy();

        if (isset($img)):
            $this->Result = TRUE;
            $this->Msg = ["<b>Sucesso:</b> a imagem foi convertida para tamanho avatar!", RENTAL_ACCEPT];
        else:
            $this->Result = FALSE;
            $this->Msg = ["<b>Erro:</b> a imagem não foi convertida para tamanho avatar!", RENTAL_ERROR];
        endif;
    }
    
    private function ImagemSalao($Endereço, $Caminho) {
        $rand = rand(5, 30);
        require_once('../../_app/WideImage/WideImage.php');
        $img = WideImage::load("../uploads/" . $Endereço);
        $img = $img->resize(220, 220, 'outside');
        $this->SendAvatar = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->idUsuario}-SALAO-" . (substr(md5(time() + $rand), 0, 5)) . ".jpg";
        $img->saveToFile("../uploads/" . $this->SendAvatar);
        $img->destroy();
        list($width, $height, $type, $attr) = getimagesize("../uploads/" . $this->SendAvatar);
        $w = $width / 2;
        $h = $height / 2;
        $imgSmall = WideImage::load("../uploads/" . $this->SendAvatar);
        $imgSmall = $imgSmall->crop($w / 2, $h / 2, 128, 128);
        $this->SendAvatar = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->idUsuario}-SALAO-" . (substr(md5(time() + $rand), 0, 5)) . ".jpg";
        $imgSmall->saveToFile("../uploads/" . $this->SendAvatar);
        $imgSmall->destroy();

        if (isset($img)):
            $this->Result = TRUE;
            $this->Msg = ["<b>Sucesso:</b> a imagem foi convertida para tamanho avatar!", RENTAL_ACCEPT];
        else:
            $this->Result = FALSE;
            $this->Msg = ["<b>Erro:</b> a imagem não foi convertida para tamanho avatar!", RENTAL_ERROR];
        endif;
    }
}
