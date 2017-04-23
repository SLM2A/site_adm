<?php

/**
 * AdminGaleria.class [MODEL ADMIN]
 * Responsavel por gerenciar a galeria do usuario do Rental Easy!
 * 
 * @copyright (c) 2017, Marcelo Lima
 */
class AdminVagaAluguelImagem {

    private $Data;
    private $File = Array();
    private $NomeCompletoUsuario;
    private $idVagaAluguel;
    private $idPortfolio;
    private $Msg;
    private $Result;
    private $SendFull;
    private $SendSmall;

    //Nome da tabela no banco de dados!
    const ENTITY = 'imagemvagaaluguel';

    public function ExeCreate(array $imagens, $postID, $NomeCompletoUsuario) {
        $this->Data = $imagens;
        $this->idVagaAluguel = $postID;
        $this->NomeCompletoUsuario = $NomeCompletoUsuario;

        if (in_array('', $this->Data))://Verifica se a algum campo em branco na array            
            $this->Msg = ['<b>Erro ao enviar!</b> Selecione uma ou mais imagens', RENTAL_INFOR];
            $this->Result = false;
        else:
            $this->setData();
            $this->Create();
        endif;
    }

    public function ExeUpdate($idPortfolio, array $Data) {
        $this->idPortfolio = (int) $idPortfolio;
        $this->Data = $Data;
        $this->Update();
    }

    public function ExeDelete($idPortfolio) {
        $this->idPortfolio = (int) $idPortfolio;
        $this->Delete();
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

        for ($gb = 0; $gb < $gbCont; $gb++):
            foreach ($gbKeys as $key):
                $this->File[$gb][$key] = $this->Data[$key][$gb];
            endforeach;
        endfor;
    }

    private function Create() {
        $ImgFullAndSmall = new Upload();

        foreach ($this->File as $gbUpload):
            $ImgName = "temp1";
            $ImgFullAndSmall->Image($gbUpload, $ImgName, null, $this->NomeCompletoUsuario . "-" . $this->idVagaAluguel);
            $this->ImagemFullandSmal($ImgFullAndSmall->getResult(), $ImgFullAndSmall->getSend());
            if ($ImgFullAndSmall->getResult()):
                $gbCreate = ["idVagaAluguel" => $this->idVagaAluguel, "fotoGrande" => $this->SendFull, "fotoPequena" => $this->SendSmall, "dataFoto" => date('Y-m-d H:i:s')];
                var_dump($gbCreate);
                $insertGb = new create();
                $insertGb->ExeCreate(self::ENTITY, $gbCreate);
                if ($insertGb->getResult()):
                    $this->Result = TRUE;
                    $this->Msg = ["<b>Sucesso:</b> a(s) imagem(s) imagens foram gravadas com sucesso!", RENTAL_ACCEPT];
                else:
                    $this->Result = FALSE;
                    $this->Msg = ["<b>Erro:</b> a(s) imagem(s) imagens não foram gravadas com sucesso!", RENTAL_ERROR];
                endif;
            endif;
        endforeach;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::ENTITY, $this->Data, "WHERE idPortfolio = :idport", "idport={$this->idPortfolio}");
        if ($update->getResult()):
            $this->Result = TRUE;
            $this->Msg = ["<b>Sucesso:</b> a imagem foi atualizada com sucesso!", RENTAL_ACCEPT];
        endif;
    }

    private function Delete() {
        $delete = new Delete();
        $delete->ExeDelete(self::ENTITY, "WHERE idPortfolio = :idport", "idport={$this->idPortfolio}");
        if ($delete->getResult()):
            $this->Result = TRUE;
            $this->Msg = ["<b>Sucesso:</b> ao deletar a imagem!", RENTAL_ACCEPT];
        endif;
    }

    private function ImagemFullandSmal($Endereço, $Caminho) {
        $rand = rand(5, 30);
        require_once('../../_app/WideImage/WideImage.php');
        $imgFull = WideImage::load("../uploads/" . $Endereço);
        $imgFull = $imgFull->resize(1500, 1500, 'outside');
        $this->SendFull = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->idVagaAluguel}-FULL-" . (substr(md5(time() + $rand), 0, 5)) . ".jpg";
        $imgFull->saveToFile("../uploads/" . $this->SendFull);
        $imgFull->destroy();
        
        sleep(0.5);
        
        list($width, $height, $type, $attr) = getimagesize("../uploads/" . $this->SendFull);
        $w = $width / 2;
        $h = $height / 2;
        $imgSmall = WideImage::load("../uploads/" . $this->SendFull);
        $imgSmall = $imgSmall->crop($w / 2, $h / 2, 1000, 1000);
        $this->SendSmall = "{$Caminho}/{$this->NomeCompletoUsuario}-{$this->idVagaAluguel}-SMALL-" . (substr(md5(time() + $rand), 0, 5)) . ".jpg";
        $imgSmall->saveToFile("../uploads/" . $this->SendSmall);
        $imgSmall->destroy();

        if (isset($imgSmall)):
            $this->Result = TRUE;
            $this->Msg = ["<b>Sucesso:</b> a imagem foi convertida para tamanho pequeno!", RENTAL_ACCEPT];
        else:
            $this->Result = FALSE;
            $this->Msg = ["<b>Erro:</b> a imagem não foi convertida para tamanho pequeno!", RENTAL_ERROR];
        endif;
    }

}
