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
    
endif;
?>

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
        <section class="no-padding" id="portfolio">
            <div class="container-fluid">
                <div class="row no-gutter popup-gallery">
                    <div class="col-lg-4 col-sm-6">
                        <a href="..\dist\img\portfolio\fullsize\1.jpg" class="portfolio-box">
                            <img src="..\dist\img\portfolio\fullsize\1.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Fenix Cabeleireiro
                                    </div>
                                    <div class="project-name">
                                        Corte verão
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                            <img src="..\dist\img\portfolio\fullsize\2.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Onix Studio
                                    </div>
                                    <div class="project-name">
                                        Undercurt
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                            <img src="..\dist\img\portfolio\fullsize\3.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Espaço Milaré
                                    </div>
                                    <div class="project-name">
                                        Corte 3
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="..\dist\img\portfolio\fullsize\4.jpg" class="portfolio-box">
                            <img src="..\dist\img\portfolio\fullsize\4.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Espaço Farias
                                    </div>
                                    <div class="project-name">
                                        Corte 4
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/5.jpg" class="portfolio-box">
                            <img src="..\dist\img\portfolio\fullsize\5.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Portela Studio
                                    </div>
                                    <div class="project-name">
                                        Corte 5
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/fullsize/6.jpg" class="portfolio-box">
                            <img src="..\dist\img\portfolio\fullsize\6.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Dadalto Cortes
                                    </div>
                                    <div class="project-name">
                                        Corte 6
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </section>

<div class="row">
<?php include 'menuFooter.php'; ?>