<?php
require_once('../../_app/Config.inc.php');
require_once('../../_app/Includes.php');
include 'menuHeader.php';

if (!empty($_SESSION['userlogin']['msg'])):
    RentalErro($_SESSION['userlogin']['msg'],$_SESSION['userlogin']['tipoMsg']);
    $_SESSION['userlogin']['msg'] = '';
    $_SESSION['userlogin']['tipoMsg'] = '';
endif;

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$update = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($post) && $post['SendPostForm']):
    $post = ($_FILES['portfolio']['tmp_name'] ? $_FILES['portfolio'] : NULL);
    unset($post['SendPostForm']);
    require('../../admin/_models/AdminGaleria.class.php');
    $sendGallery = new AdminGaleria;
    $sendGallery->ExeCreate($post, $_SESSION['userlogin']['idUsuario'], $_SESSION['userlogin']['nomeUsuario'] . '-' . $_SESSION['userlogin']['sobrenomeUsuario']);

    if ($sendGallery->getMsg()):
        $_SESSION['userlogin']['msg']= $sendGallery->getMsg()[0];
        $_SESSION['userlogin']['tipoMsg']= $sendGallery->getMsg()[1];
    endif;

    echo "<script>location.href='portfolio.php';</script>";
else:
    $read = new Read();
    $read->ExeRead("portfolio", "WHERE idUsuario = :id ORDER BY idPortfolio DESC ", "id={$userlogin['idUsuario']}");
    if ($read->getResult()):
        $data = $read->getResult();
    endif;
endif;

if (isset($post) && $post['UpdatePostForm']):

var_dump($post);
endif;

?>



<!-- Plugin CSS -->
<link href="../../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html">

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

    <small>Adicione fotos de seus trabolhos para que outros curtam e comentem</small>

    <p>

    <p>

    <p>

    <p>


    <div class="box-footer">
        <div class="popup-gallery">

        <?php
        if(!empty ($read)) {
            foreach ($read->getResult() as $fotos):
                $post['idPortfolio'] = $fotos['idPortfolio'];
                echo "
                <div class=\"col-lg-3 connectedSortable\">
                    <div class=\"box box-primary\">
                        <div class=\"mailbox-attachment-info\">
                            <div class=\"mailbox-attachment-info\">
                                <span class=\"mailbox-attachment-icon has-img\">
                                    <a href=\"../uploads/{$fotos['portfolioImagemFull']}\" class=\"portfolio-box\">
                                        <img src=\"../uploads/{$fotos['portfolioImagemSmall']}\" alt=\"Attachment\" class=\"img-responsive\">
                                    </a>
                                </span>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\">Titulo</span>
                                    <input type=\"text\" class=\"form-control\">
                                </div>
                                <textarea class=\"form-control\" rows=\"3\" placeholder=\"Descrição...\"></textarea>
                            </div>
                        <center>
                            <button input type=\"submit\" class=\"btn btn-app\" name=\"UpdatePostForm\"><i class=\"fa fa-save\"></i> Save </button>
                            <button input class=\"btn btn-app\"><i class=\"fa fa-trash-o\" name=\"DeletePostForm\"></i> Delete </button>
                        </center>
                        </div>
                    </div>
                </div>
            ";
            endforeach;
        }
        ?>

        </div>
    </div>

</section>
<div class="row">
    <?php include 'menuFooter.php'; ?>

    <!-- GALERIA IMAGEM ABERTA INICIO-->
    <script src="../../vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="../../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="../../js/creative.js"></script>
    <!-- GALERIA IMAGEM ABERTA FIM -->

    <script>

        function removeMensagem(){
            setTimeout(function(){
                var msg = document.getElementById("msg-success");
                msg.parentNode.removeChild(msg);
            }, 3000);
        }
        document.onreadystatechange = ($) => {
            if (document.readyState === 'complete') {
                // toda vez que a página carregar, vai limpar a mensagem (se houver) após 5 segundos
                removeMensagem();
            }
        };

    </script>


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
