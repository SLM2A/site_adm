<?php

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$readFotos = new Read();
$readFotos->ExeRead("portfolio", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");
          
$readCadastro = new Read();
$readCadastro->FullRead("SELECT * FROM usuario u inner join enderecousuario e on u.idUsuario=e.idUsuario WHERE u.idUsuario={$userlogin['idUsuario']}");
//var_dump($readCadastro->getResult());

$readAreaAtuacao = new Read();
$readAreaAtuacao->FullRead("SELECT * FROM habilidadeusuario hu inner join areaatuacao aa on hu.idAreaAtuacao=aa.idAreaAtuacao inner join usuario u on u.idUsuario=hu.idUsuario WHERE hu.idUsuario={$userlogin['idUsuario']}");
//var_dump($readAreaAtuacao->getResult());
?>

<link rel='stylesheet' href='package/unitegallery/css/unite-gallery.css' type='text/css' />

<section class="content">

    <section class="col-lg-3 connectedSortable">
        <!-- Profile Image -->
        <div class="box box-primary" style="height: 291px">
            <div class="box-body box-profile">
                <?php if($readUsuario->getResult()[0]['avatar']==null):
                                        echo "<img src=\"../dist/img/userpadrao.png\" class=\"profile-user-img img-responsive img-circle\" alt=\"User profile picture\"> ";  
                                    else:
                                        echo "<img class=\"profile-user-img img-responsive img-circle\" src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" alt=\"User profile picture\">"; 
                                    endif;?>

                <h3 class="profile-username text-center">
                    <?php if($readCadastro->getResult()): 
                              echo "{$readCadastro->getResult()[0]['nomeUsuario']}"; 
                              echo " "; echo "{$readCadastro->getResult()[0]['sobrenomeUsuario']}"; 
                          else: 
                              echo $userlogin['nomeUsuario']." ".$userlogin['sobrenomeUsuario'];  
                          endif;  ?></h3>
                <center><a href="perfil.php"><span class="label label-primary">editar perfil</span></a></center>
                <hr>
                
                <strong><i class="fa fa-pencil margin-r-5"></i>Áreas de Atuação</strong>
                <p class="text-muted text-center">
                    <?php 
                            
                            foreach ($readAreaAtuacao->getResult() as $areaatuacao):
                                    echo "<span class=\"label label-danger\">{$areaatuacao['nomeProfissao']}</span> ";
                            endforeach;
                    ?>  </p>
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
                    <?php if($readCadastro->getResult()): 
                             echo "{$readCadastro->getResult()[0]['descricao']}";
                          else: 
                              echo "Sem descrição cadastrada!";  
                          endif;?>
                </p>    
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Redes Sociais</strong>
                <p>
                    <?php 
                    $readRedeSocial = new Read();
                    $readRedeSocial->FullRead("SELECT * FROM redesocial rs inner join usuario u on rs.idUsuario=u.idUsuario WHERE rs.idUsuario={$userlogin['idUsuario']}");
                    //var_dump($readRedeSocial->getResult());
                    if($readRedeSocial->getResult()):
                        if($readRedeSocial->getResult()[0]['facebook']):
                            echo "<a class=\"btn btn-social-icon btn-facebook\" href=\"https://www.facebook.com/{$readRedeSocial->getResult()[0]['facebook']}\"><i class=\"fa fa-facebook\"></i></a> ";
                        endif;
                        if($readRedeSocial->getResult()[0]['instagram']):
                            echo "<a class=\"btn btn-social-icon btn-instagram\" href=\"https://www.instagram.com/{$readRedeSocial->getResult()[0]['instagram']}\"><i class=\"fa fa-instagram\"></i></a> ";
                        endif;
                        if($readRedeSocial->getResult()[0]['twitter']):
                            echo "<a class=\"btn btn-social-icon btn-twitter\"  href=\"https://twitter.com/{$readRedeSocial->getResult()[0]['twitter']}\"><i class=\"fa fa-twitter\"></i></a> ";
                        endif;
                    else:
                        echo "Usuário não possui redes sociais cadastradas!";
                    endif;
                    
                    
                    ?>
                    
                    
                </p>
                <hr>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Localidade</strong>
                <p class="text-muted">
                    <?php 
                        if($readCadastro->getResult()): 
                            echo "{$readCadastro->getResult()[0]['cidade']}"; echo "/"; echo "{$readCadastro->getResult()[0]['estado']}";
                        else: 
                            echo "Sem localização cadastrada!";  
                        endif;
                          ?></p>

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

                    $readSes->FullRead("select * from experienciaprofissionalusuario exp inner join experienciausuario ex on exp.idExperiencia = ex.idExperiencia where ex.idUsuario= :catid order by exp.deExperiencia", "catid={$userlogin['idUsuario']}");
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
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $readSes = new Read;

                    $readSes->FullRead("select * from certificadoprofissionalusuario cpu inner join certificadousuario cu on cpu.idCertificado = cu.idCertificado where cu.idUsuario= :catid order by cpu.anoInicioCertificado", "catid={$userlogin['idUsuario']}");
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
                <h3 class="box-title"><i class="ion-camera"></i> Meu Portfólio</h3>
            </div>

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <div id="gallery" style="display:none;">

                        <?php

                        
                        foreach ($readFotos->getResult() as $fotos):
                            echo   " <a href=\"portfolio.php?id={$fotos['idPortfolio']}\" onclick=\"teste()\">
                            <img alt=\"{$fotos['tituloImagem']}\"
                             src=\"../uploads/{$fotos['portfolioImagemFull']}\"
                             data-image=\"../uploads/{$fotos['portfolioImagemFull']}\"
                             data-description=\"{$fotos['descricaoImagem']}\"
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