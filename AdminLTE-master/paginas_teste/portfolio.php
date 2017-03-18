<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($post) && $post['SendPostForm']):
    $post = ($_FILES['portfolio']['tmp_name'] ? $_FILES['portfolio'] : NULL );
    unset($post['SendPostForm']);
    require('../../admin/_models/AdminGaleria.class.php');
    $sendGallery = new AdminGaleria;
    $sendGallery->ExeCreate($post, $_SESSION['userlogin']['idUsuario'], $_SESSION['userlogin']['nomeUsuario'].'-'.$_SESSION['userlogin']['sobrenomeUsuario']);

    if (!$sendGallery->getResult()):
        RentalErro($sendGallery->getError()[0], $sendGallery->getError()[1]);
    else:
        echo "<script>location.href='portfolio.php';</script>";
    endif;


else:
    $read = new Read();
    $read->ExeRead("portfolio", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");
    if($read->getResult()):
    $data = $read->getResult();
    endif;
endif;


?>
<link rel='stylesheet' href='package/unitegallery/css/unite-gallery.css' type='text/css' />

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
            <input type="submit" value="+ Adicionar Fotos" name="SendPostForm" button type="button" class="btn btn-block btn-primary btn-lg"/>
        </form>
        
        <small>Adicione fotos de seus trabolhos para que outros curtam e comentem</small>
        
        <p>
        <p>
        <p>
        <p>

        <!-- INICIO form imagem -->
        <form role="form" action="" method="post" class="login-form">

            <!-- INICIO-->
            <!-- Default box -->

            <div class="box" closet id="editarImagem">


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

                                        <?php
                                        $readImagem = new Read();
                                        $readImagem->FullRead("Select * from portfolio where idPortfolio= :id", "id={$idImagem}");

                                        foreach ($read->getResult() as $fotos):

                                        echo   "<a href=\" \">
                                                <img alt=\"Lemon Slice\"
                                                 src=\"../uploads/{$fotos['portfolioImagem']}\"
                                                 data-image=\"../uploads/{$fotos['portfolioImagem']}\"
                                                 data-description=\"This is a Lemon Slice\"
                                                 style=\"display:none\">";
                                        echo "</a> ";
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
        <!-- Fechamento form imagem -->

        <div id="gallery" style="display:none;">

          <?php  foreach ($read->getResult() as $fotos):

            echo   " <a href=\" \">
                    <img alt=\"Lemon Slice\"
                     src=\"../uploads/{$fotos['portfolioImagem']}\"
                     data-image=\"../uploads/{$fotos['portfolioImagem']}\"
                     data-description=\"This is a Lemon Slice\"
                     style=\"display:none\">";

                     $idImagem = $fotos['idPortfolio'];
                    echo "</a> ";
          endforeach;
            ?>

        </div>
    </section>

<div class="row">
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

