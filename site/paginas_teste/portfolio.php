<?php
require_once('../../_app/Config.inc.php');
require_once('../../_app/Includes.php');
include 'menuHeader.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($post) && $post['SendPostForm']):
    $post = ($_FILES['portfolio']['tmp_name'] ? $_FILES['portfolio'] : NULL);
    unset($post['SendPostForm']);
    require('../../admin/_models/AdminGaleria.class.php');
    $sendGallery = new AdminGaleria;
    $sendGallery->ExeCreate($post, $_SESSION['userlogin']['idUsuario'], $_SESSION['userlogin']['nomeUsuario'] . '-' . $_SESSION['userlogin']['sobrenomeUsuario']);

    if (!$sendGallery->getResult()):
        RentalErro($sendGallery->getError()[0], $sendGallery->getError()[1]);
    else:
        echo "<script>location.href='portfolio.php';</script>";
    endif;


else:
    $read = new Read();
    $read->ExeRead("portfolio", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");
    if ($read->getResult()):
        $data = $read->getResult();
    endif;
endif;


?>
<!-- Plugin CSS -->
<link href="../../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" xmlns="http://www.w3.org/1999/html">


<link rel='stylesheet' href='package/unitegallery/css/unite-gallery.css' type='text/css'/>
<style>
    .mailbox-attachments li {
        float: left;
        width: 30%;
        border: 10px solid #eee;
        margin-bottom: 10px;
        margin-right: 10px;
        position: relative;
    }

    .mailbox-attachments img{
        width: 100%;
        height: auto;
        background-size: cover;

    }
</style>


<section class="content-header">
    <h1>
        Meu Book
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <form name="PostForm" method="POST" enctype="multipart/form-data">
        <input type="file" multiple name="portfolio[]" id="exampleInputFile"/>
        <br>
        <input type="submit" value="+ Adicionar Fotos" name="SendPostForm" button type="button"
               class="btn btn-block btn-primary btn-lg"/>
    </form>

    <small>Adicione fotos de seus trabolhos para que outros curtam e comentem</small>

    <p>

    <p>

    <p>

    <p>

    <div class="box-footer" id="portfolio">
        <ul class="mailbox-attachments clearfix">
            <div class="box box-info">
                <div class="popup-gallery">

                    <!-- Início da listagem de imagens -->
                    <?php
                    foreach ($read->getResult() as $fotos):
                        echo "
                                 <div class=\"col-lg-3 connectedSortable\">
                                    <div class=\"mailbox-attachment-info\">
                                        <div class=\"box-body\">
                                            <span class=\"mailbox-attachment-icon has-img\"><a href=\"../uploads/{$fotos['portfolioImagem']}\" class=\"portfolio-box\"><img src=\"../uploads/{$fotos['portfolioImagem']}\" alt=\"Attachment\" class=\"img-responsive\"></a></span>
                                            <div class=\"input-group\">
                                                <span class=\"input-group-addon\">Titulo</span>
                                                <input type=\"text\" class=\"form-control\">
                                            </div>
                                        </div>

                                        <div class=\"form-group\">
                                            <textarea class=\"form-control\" rows=\"3\" placeholder=\"{$fotos['idPortfolio']}\"></textarea>
                                            <div class=\"btn-group\">
                                                <button type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-save\"></i></button>
                                                <button type=\"button\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        ";
                    endforeach;
                    ?>
                    <!-- Fim da listagem de imagens -->

                </div>
            </div>
        </ul>
    </div>

</section>
<div class="row">
    <?php include 'menuFooter.php'; ?>

    <!-- GALERIA IMAGEM ABERTA INICIO-->
    <script src="../../vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="../../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="../../js/creative.js"></script>
    <!-- GALERIA IMAGEM ABERTA FIM -->


    <script type='text/javascript' src='package/unitegallery/js/unitegallery.js'></script>
    <script type='text/javascript' src='package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function () {

            jQuery("#gallery").unitegallery({
                theme_navigation_type: "arrows",
                tile_enable_textpanel: true,
                tile_textpanel_title_text_align: "center",
                tile_enable_icons: false,
                tile_enable_action: false,
                tile_as_link: true,
            });

        });

    </script>

    <script type="text/javascript">

        jQuery(document).ready(function () {

            jQuery("#gallery2").unitegallery({
                theme_navigation_type: "arrows",
                tile_enable_textpanel: true,
                tile_textpanel_title_text_align: "center",
                textpanel_enable_description: true,
            });

        });

        function teste() {

        }

    </script>

