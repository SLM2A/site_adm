﻿<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

?>

<link rel='stylesheet' href='package/unitegallery/css/unite-gallery.css' type='text/css' />

<section class="content">
             
      <section class="col-lg-3 connectedSortable">
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="../dist/img/user2-160x160.jpg" alt="User profile picture">

                                    <h3 class="profile-username text-center"><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></h3>
                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i>Áreas de Atuação</strong>
                                    <p class="text-muted text-center">Cabelereiro, Barbeiro e Hair Design</p>
                                    <hr>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- Fim Profile Image -->

                        <!-- About Me Box -->
                        <section class="col-lg-9 connectedSortable">   
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion-person"></i> Sobre Mim</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i> O que acho sobre mim</strong>

                                    <p class="text-muted">
                                        <?= $userlogin['descricao']; ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i> Competências</strong>
                                    <p>
                                        <span class="label label-danger">Pigmentação</span>
                                        <span class="label label-success">Navalhado</span>
                                    </p>
                                    <hr>						  
                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Localidade</strong>
                                    <p class="text-muted">São Paulo, Brasil</p>

                                </div>
                            </div>
                        </section>
                        <!-- Fim About Me Box -->	

                        <!-- Inicio Minhas Experiências -->	
                        <section class="col-md-12">	
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="ion-briefcase"></i> Minhas Experiências</h3>

                                        
                                </div>

                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Cargo</th>
                                                <th>Empresa</th>
                                                <th>De</th>
                                                <th>Até</th>
                                                <th>Descrição</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $readSes = new Read;

                                            $readSes->FullRead("select * from experienciaprofissionalusuario exp inner join experienciausuario ex on exp.idExperiencia = ex.idExperiencia where ex.idUsuario= :catid", "catid={$userlogin['idUsuario']}");
                                            foreach ($readSes->getResult() as $ses):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


                                                echo "<tr><td> {$ses['cargoExperiencia']} </td>
                                                              <td> {$ses['empresaExperiencia']} </td>
                                                              
                                                              <td> {$ses['deExperiencia']} </td>
                                                              <td> {$ses['ateExperiencia']} </td>
                                                              <td> {$ses['descricao']} </td>
                                                                 </tr>
                                                        ";
                                                               
                                            endforeach;
                                            ?>
                                        </tbody>  

                                    </table>
                                </div>
                            </div>
                        </section> 
                        <!-- Fim Minhas Experiências -->

    <!-- Inicio Minhas Experiências -->

    <!-- Fim Minhas Experiências -->


                        <!-- Inicio Minhas Experiências -->	
                        <section class="col-md-12">	
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="ion-ios-bookmarks"></i> Meus Certificados</h3>


                                </div>

                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Instituição</th>
                                                <th>Curso</th>
                                                <th>Nível</th>
                                                <th>Duração</th>
                                                <th>Ano de ínicio</th>
                                                <th>Ano de conclusão</th>
                                                <th>Ferramentas</th>
                                            </tr>
                                        </thead>    
                                        <tbody>
<?php
$readSes = new Read;

$readSes->FullRead("select * from certificadoprofissionalusuario cpu inner join certificadousuario cu on cpu.idCertificado = cu.idCertificado where cu.idUsuario= :catid", "catid={$userlogin['idUsuario']}");
foreach ($readSes->getResult() as $ses):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


    echo "<tr><td> {$ses['instituicaoCertificado']} </td>
                                                              <td> {$ses['cursoCertificado']} </td>
                                                              
                                                              <td> {$ses['nivelCertificado']} </td>
                                                              <td> {$ses['duracaoCertificado']} </td>
                                                              <td> {$ses['anoInicioCertificado']} </td>
                                                              <td> {$ses['anoConclusaoCertificado']} </td></tr>
                                                        ";

endforeach;
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section> 
                        <!-- Fim Minhas Experiências -->

    <section class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="ion-briefcase"></i> Minhas Experiências</h3>
            </div>

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <div id="gallery" style="display:none;">

                        <?php

                        $read = new Read();
                        $read->ExeRead("portfolio", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");

                        foreach ($read->getResult() as $fotos):
                            echo   " <a href=\"portfolio.php?id={$fotos['idPortfolio']}\" onclick=\"teste()\">
                            <img alt=\"Lemon Slice\"
                             src=\"../uploads/{$fotos['portfolioImagem']}\"
                             data-image=\"../uploads/{$fotos['portfolioImagem']}\"
                             data-description=\"This is a Lemon Slice\"
                             style=\"display:none\">
                            </a> ";
                        endforeach;
                        ?>


                    </div>

                </table>
            </div>
        </div>
    </section>



		
    </section>
<div class="row">
<?php include 'menuFooter.php'; ?>
    <script type='text/javascript' src='package/unitegallery/js/jquery-11.0.min.js'></script>
    <script type='text/javascript' src='package/unitegallery/js/unitegallery.min.js'></script>
    <script type='text/javascript' src='package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function(){

            jQuery("#gallery").unitegallery({
                theme_navigation_type:"arrows",
                tile_enable_textpanel:true,
                tile_textpanel_title_text_align: "center",
                textpanel_enable_description: true,
            });

        });

    </script>