<?php
require_once('../../_app/Config.inc.php');
require_once('../../_app/Includes.php');
include 'menuHeader.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/**
 * modal retorna* /
 */
if (array_key_exists('idPortfolio', $_GET)):
    $_SESSION['userlogin']['idPortfolio'] = $_GET['idPortfolio'];
    $_SESSION['userlogin']['ModalPortfolioOk'] = "ok";
endif;

if (!empty($_SESSION['userlogin']['msg'])):
    RentalErro($_SESSION['userlogin']['msg'], $_SESSION['userlogin']['tipoMsg']);
    $_SESSION['userlogin']['msg'] = '';
    $_SESSION['userlogin']['tipoMsg'] = '';
endif;

if (isset($post) && array_key_exists("SendPostForm", $post)):
    $post = ($_FILES['portfolio']['tmp_name'] ? $_FILES['portfolio'] : NULL);
    unset($post['SendPostForm']);
    require('../../admin/_models/AdminGaleria.class.php');
    $sendGallery = new AdminGaleria;
    $sendGallery->ExeCreate($post, $_SESSION['userlogin']['idUsuario'], $_SESSION['userlogin']['nomeUsuario'] . '-' . $_SESSION['userlogin']['sobrenomeUsuario']);

    if ($sendGallery->getMsg()):
        $_SESSION['userlogin']['msg'] = $sendGallery->getMsg()[0];
        $_SESSION['userlogin']['tipoMsg'] = $sendGallery->getMsg()[1];
    endif;

    echo "<script>location.href='portfolio.php';</script>";
else:
    $read = new Read();
    $read->ExeRead("portfolio", "WHERE idUsuario = :id ORDER BY idPortfolio DESC ", "id={$userlogin['idUsuario']}");
    if ($read->getResult()):
        $data = $read->getResult();
    endif;
endif;

if (isset($post) && array_key_exists("UpdatePostForm", $post)):
    var_dump($post);
    unset($post['UpdatePostForm']);
    $idPortfolio = $post['idPortfolio'];
    unset($post['idPortfolio']);
    require('../../admin/_models/AdminGaleria.class.php');
    $updateGallery = new AdminGaleria;
    $updateGallery->ExeUpdate($idPortfolio, $post);

    if ($updateGallery->getMsg()):
        $_SESSION['userlogin']['msg'] = $updateGallery->getMsg()[0];
        $_SESSION['userlogin']['tipoMsg'] = $updateGallery->getMsg()[1];
    endif;

//echo "<script>location.href='portfolio.php';</script>";

endif;

if (isset($post) && array_key_exists("DeletePostForm", $post)):
    unset($post['DeletePostForm']);
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a imagem", "Cancelar", "Excluir", "Excluir");
endif;

if (!empty($_SESSION['userlogin']['ModalPortfolioOk'])):
    unset($_SESSION['userlogin']['ModalPortfolioOk']);
    require('../../admin/_models/AdminGaleria.class.php');
    $deleteGallery = new AdminGaleria;
    $deleteGallery->ExeDelete($_SESSION['userlogin']['idPortfolio']);
    unset($_SESSION['userlogin']['idPortfolio']);

    if ($deleteGallery->getMsg()):
        $_SESSION['userlogin']['msg'] = $deleteGallery->getMsg()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteGallery->getMsg()[1];
    endif;

    echo "<script>location.href='portfolio.php';</script>";
endif;

//var_dump($post);    
//    if (isset($post)):
//        $_SESSION['userlogin']['modal_titulo']= "Titulo";
//        $_SESSION['userlogin']['modal_msg']= "Menssagem";
//        $_SESSION['userlogin']['modal_botalDiscordo']= "Discordo";
//        $_SESSION['userlogin']['modal_botalAceito']= "Aceito";      
//        var_dump($_SESSION);
//    endif;
?>

<!-- Plugin CSS -->
<link href="../../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

<section class="content-header">
    <h1>
        <i class="ion ion-camera"></i> Minhas Fotos
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <form name="PostForm" method="POST" enctype="multipart/form-data">

        <div class="input-group">
            <label class="input-group-btn">
                    <span class="btn btn-primary">
                        <i class="fa fa-folder"></i> Arquivos&hellip; <input type="file" style="display: none;" multiple name="portfolio[]" id="exampleInputFile"/>
                    </span>
            </label>
            <input type="text" class="form-control" readonly/>
        </div>

        <br>

        <input type="submit" value="+ Adicionar Fotos" name="SendPostForm" button type="button" class="btn btn-block btn-primary btn-lg"/>
    </form>


</section>
<div class="row">
    <?php include 'menuFooter.php'; ?>

    <!-- GALERIA IMAGEM ABERTA INICIO-->
    <script src="../../vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="../../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="../../js/creative.js"></script>
    <!-- GALERIA IMAGEM ABERTA FIM -->



<script>
    $(function() {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
    var input = $(this),
    numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {

    var input = $(this).parents('.input-group').find(':text'),
    log = numFiles > 1 ? numFiles + ' files selected' : label;

    if( input.length ) {
    input.val(log);
    } else {
    if( log ) alert(log);
    }

    });
    });

    });
    

    
    </script>
