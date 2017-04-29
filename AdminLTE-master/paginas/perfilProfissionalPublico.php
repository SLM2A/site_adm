<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idProfissional = $_GET['id'];

$readProfissional = new Read;
$readProfissional->FullRead("select * from usuario where idUsuario = :id", "id={$idProfissional}");


$readConvidado = new Read();
$readConvidado->FullRead("Select * From usuarioconvidado where idUsuarioEmpresario = {$userlogin['idUsuario']} and idUsuarioProfissional = {$idProfissional}");

$readFoto = new Read();
$readFoto->ExeRead("portfolio", "WHERE idUsuario = :id", "id={$idProfissional}");
?>

<link rel='stylesheet' href='package/unitegallery/css/unite-gallery.css' type='text/css' />

<section class="content">
    <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data"  >

        <div class="col-lg-3 connectedSortable">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="../dist/img/user2-160x160.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center"><?php echo $readProfissional->getResult()[0]['nomeUsuario'];
echo " ";
echo $readProfissional->getResult()[0]['sobrenomeUsuario']; ?></h3>
                    <hr>

                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-body box-profile" style="height: 63px">
                    <center>
                        <div class="btn-group">
                            
                                <?php
                                

                                echo"  
                                        <a href=\"criarMensagem.php?desr={$idProfissional}&remr={$userlogin['idUsuario']}\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-envelope\"></i> Enviar Mensagem</button></a>";
                                ?>
                        </div>
                    </center>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- Fim Profile Image -->

        <!-- About Me Box -->
        <div class="col-lg-9 connectedSortable">   
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
        </div>
        <!-- Fim About Me Box -->	

        <!-- Inicio Minhas Experiências -->	
        <div class="col-md-12">	
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

                            $readSes->FullRead("select * from experienciaprofissionalusuario exp inner join experienciausuario ex on exp.idExperiencia = ex.idExperiencia where ex.idUsuario= :catid order by exp.deExperiencia", "catid={$idProfissional}");
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
        </div> 
        <!-- Fim Minhas Experiências -->	

        <!-- Inicio Minhas Experiências -->	
        <div class="col-md-12">	
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

                            $readSes->FullRead("select * from certificadoprofissionalusuario cpu inner join certificadousuario cu on cpu.idCertificado = cu.idCertificado where cu.idUsuario= :catid order by cpu.anoInicioCertificado", "catid={$idProfissional}");
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
        </div> 
        <!-- Fim Minhas Experiências -->


        <div class="col-md-12">	
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-camera"></i> Portfólio</h3>


                </div>

                <div class="box-footer">
                    
                    <div id="gallery" >

                        <?php
                        if ($readFoto->getResult()):
                            foreach ($readFoto->getResult() as $fotos):
                                echo "<img alt=\"{$fotos['descricaoImagem']}\"
                                                 src=\"../uploads/{$fotos['portfolioImagemFull']}\"
                                                 data-image=\"../uploads/{$fotos['portfolioImagemFull']}\"
                                                 data-description=\"{$fotos['descricaoImagem']}\"
                                                 style=\"display:none\">";
                            endforeach;
                        else:
                            echo "Usuário não tem foto cadastrada!";
                        endif;
                        ?>


                    </div>

                </div>
            </div>
        </div>


<?php
//    if(!$readConvidado->getResult()):
echo "
    <div class=\"col-lg-12 connectedSortable\">
    <a href=\"escolhervaga.php?id={$idProfissional}\"><button type=\"button\" class=\"btn btn-block btn-warning btn-lg\"><i class=\"fa fa-building\"></i> Enviar proposta de emprego</button></a>
    </div>";
//    else:
//        echo "
//    <div class=\"col-lg-12 connectedSortable\">
//    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\" disabled><i class=\"fa fa-check\"></i> Aguarde contato do Profissional</button>
//    </div>";
//    endif;
?>
    </form>

</section>
<div class="row">
        <?php include 'menuFooter.php'; ?>

    
    <script type='text/javascript' src='package/unitegallery/js/unitegallery.min.js'></script>
    <script type='text/javascript' src='package/unitegallery/themes/tilesgrid/ug-theme-tilesgrid.js'></script>

    <script type="text/javascript">

        jQuery(document).ready(function () {

            jQuery("#gallery").unitegallery({
                theme_navigation_type: "arrows",
                tile_enable_textpanel: true,
                tile_textpanel_title_text_align: "center",
                textpanel_enable_description: true,
            });

        });

    </script>
