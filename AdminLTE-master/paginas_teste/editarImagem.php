<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 17/03/2017
 * Time: 22:18
 */


require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idImagem = $_GET['id'];
$readImagem = new Read();
$readImagem->FullRead("Select * from portfolio where idPortfolio=:id", "id={$idImagem}");

?>
<form role="form" action="" method="post" class="login-form">

            <!-- INICIO-->
            <!-- Default box -->

            <div class="box" closet id="editarImagem">
                <?php


                ?>

<div class="box-header with-border">
    <h3 class="box-title"><i class="ion-plus"></i> Dados da Imagem </h3>

    <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
            <i class="fa fa-plus"></i></button>

    </div>
</div>
<div class="box-body" style="display: none;">
    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->

            <div id="gallery2" style="display:none;">

                <?php  foreach ($readImagem->getResult() as $fotos):

                    echo   " <a href=\"#editarImagem?id={$fotos['idPortfolio']}\">
                                                    <img alt=\"Lemon Slice\"
                                                     src=\"../uploads/{$fotos['portfolioImagem']}\"
                                                     data-image=\"../uploads/{$fotos['portfolioImagem']}\"
                                                     data-description=\"This is a Lemon Slice\"
                                                     style=\"display:none\">
                                                    </a> ";
                endforeach;
                ?>

            </div>


        </div>
    </section>

    <section class="col-lg-6 connectedSortable">
        <label>Titulo:</label>
        <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario"  required>
        <label>Descrição:</label>
        <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario"  required>
    </section>

    <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-plus"></i> Enviar e Ir para localização</button>
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</form>


<?php include 'menuFooter.php'; ?>
<script type='text/javascript' src='package/unitegallery/js/unitegallery.js'></script>
<script type='text/javascript' src='package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

<script type="text/javascript">

    jQuery(document).ready(function(){

        jQuery("#gallery").unitegallery({
            theme_navigation_type:"arrows",
            tile_enable_textpanel:true,
            tile_textpanel_title_text_align: "center",
            tile_enable_icons: false,
            tile_enable_action:	false,
            tile_as_link: true,
        });

    });

</script>

<script type="text/javascript">

    jQuery(document).ready(function(){

        jQuery("#gallery2").unitegallery({
            theme_navigation_type:"arrows",
            tile_enable_textpanel:true,
            tile_textpanel_title_text_align: "center",
            textpanel_enable_description: true,
        });

    });

    function teste(){

    }

</script>