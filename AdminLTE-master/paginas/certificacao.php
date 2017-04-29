<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/*
 * Insere no banco a Certificação 
 */
if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/AdminCertificado.php';
    $cadastra = new AdminCertificado;

    $cadastra->ExeCreate($data);
    $readCertificado = new Read;

    $readCertificado->FullRead("SELECT MAX(idCertificado) FROM certificadoprofissionalusuario");
    $idCertificado = $readCertificado->getResult()[0]['MAX(idCertificado)'];


    $CertificadoUsuario['idCertificado'] = $idCertificado;
    $CertificadoUsuario['idUsuario'] = $userlogin['idUsuario'];


    $cadastra->InsereRelacao($CertificadoUsuario);
    
      if ($cadastra->getResult()):
            $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
            $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
            echo "<script>location.href='certificacao.php';</script>";
        endif;
endif;
/*
 * Fim Insere no banco a Certificação
 */

/*
 * DELETE CERTICAÇÃO
 */

//Chamar a Modal.
if (isset($post) && array_key_exists("DeleteCertificado", $post)):
    unset($post['DeleteCertificado']);
    $idCerticacao = $post['CadastroId'];
    $_SESSION['userlogin']['DeleteCertificado'] = "ok";
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a cartificação: <b>{$post['nomeCertificado']}</b>?", "Cancelar", "Excluir", "Excluir");
endif;

/**
 * Condição * /
 */

if (array_key_exists('id', $_GET)):
       $CadastroId = $_GET['id'];        
endif;

/**
 * DELETAR MENSSAGEM* /
 */


//Se na modal for clicado em excluir executa o bloco abaixo 
if (isset($CadastroId) and isset($_SESSION['userlogin']['DeleteCertificado'])):
    unset($_SESSION['userlogin']['DeleteCertificado']);
    require('../../admin/_models/AdminCertificado.php');
    
    $deleteSalao = new AdminCertificado();    
    $deleteSalao->ExeDelete($CadastroId);
    
    unset($_SESSION['userlogin']['$this->CadID']);
   
    if ($deleteSalao->getError()):
        $_SESSION['userlogin']['msg'] = $deleteSalao->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteSalao->getError()[1];
    endif;

    echo "<script>location.href='certificacao.php';</script>";
endif;



?>

<section class="content-header">
                    <h1> <i class="fa fa-graduation-cap"></i> Certificados</h1>  
                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" action="" method="post" class="login-form">
                                                <!-- INICIO-->
                        <!-- Default box -->

                        <div class="box box-solid collapsed-box" >

                            <div class="box-header with-border">
                                <h3 class="box-title"><i class=""></i> Cadastrar Certificado</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
                                        <i class="fa fa-plus"></i></button>

                                </div>
                            </div>
                            <div style="display: none;" class="box-body" >
                                <section class="col-lg-6 connectedSortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class="nav-tabs-custom">
                                        <!-- Tabs within a box -->
                                        <ul class="nav nav-tabs pull-right">                  
                                            <li class="pull-left header"><i class="ion-person"></i> Dados Gerais</li>
                                        </ul>
                                        <div class="tab-content no-padding">
                                            <!-- Morris chart - Sales -->
                                            <br>
                                            <div ></div>
                                            <div class="box-body box-profile" id="sales-chart" required >
                                                <div class="form-group">
                                                    <label>Instituição:</label>
                                                    <input type="text" class="form-control" required name="instituicaoCertificado"  <?php (isset($data['instituicaoCertificado'])) ? $data['instituicaoCertificado'] : $data['instituicaoCertificado'] = null ;?> >
                                                    <label>Curso:</label>
                                                    <input type="text" class="form-control" required name="cursoCertificado"  <?php (isset($data['cursoCertificado'])) ? $data['cursoCertificado'] : $data['cursoCertificado'] = null ;?> >
                                                    <label>Nível:</label>
                                                    <select class="form-control" required name="nivelCertificado">
                                                        <option></option>
                                                        <option>Técnico</option>
                                                        <option>Especialização</option>
                                                        <option>Bacharelado</option>
                                                    </select>
                                                    <?php (isset($data['nivelCertificado'])) ? $data['nivelCertificado'] : $data['nivelCertificado'] = null ;?>
                                                </div>
                                            </div>
                                        </div>
                                </section>

                                <!-- /.Left col -->
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                <section class="col-lg-6 connectedSortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class="nav-tabs-custom">
                                        <!-- Tabs within a box -->
                                        <ul class="nav nav-tabs pull-right">                  
                                            <li class="pull-left header"><i class="ion-plus"></i> Sobre</li>
                                        </ul>
                                        <div class="tab-content no-padding">
                                            <!-- Morris chart - Sales -->
                                            <br>
                                            <div class="box-body box-profile" id="sales-chart" >
                                                <div class="form-group">
                                                    <label>Duração:</label>
                                                    <select class="form-control" required name="duracaoCertificado">
                                                        <option></option>
                                                        <option>3 meses</option>
                                                        <option>6 meses</option>
                                                        <option>12 meses</option>
                                                        <option>15 meses</option>
                                                        <option>18 meses</option>
                                                        <option>2 anos</option>
                                                        <option>3 anos</option>
                                                        <option>4 anos</option>
                                                        <option>5 anos</option>
                                                    </select>
                                                    <?php (isset($data['duracaoCertificado'])) ? $data['duracaoCertificado'] : $data['duracaoCertificado'] = null ; ?>
                                                    <label>Ano de Inicio:</label>
                                                    <select class="form-control" required name="anoInicioCertificado">
                                                        <option></option>
                                                        <option>1999</option>
                                                        <option>2001</option>
                                                        <option>2002</option>
                                                        <option>2003</option>
                                                        <option>2004</option>
                                                        <option>2005</option>
                                                        <option>2006</option>
                                                        <option>2007</option>
                                                        <option>2008</option>
                                                        <option>2009</option>
                                                        <option>2010</option>
                                                        <option>2011</option>
                                                        <option>2012</option>
                                                        <option>2013</option>
                                                        <option>2014</option>
                                                        <option>2015</option>
                                                        <option>2016</option>
                                                        <option>2017</option>
                                                    </select>
                                                     <?php (isset($data['anoInicioCertificado'])) ? $data['anoInicioCertificado'] : $data['anoInicioCertificado'] = null ;?>
                                                    <label>Ano de Conclusão:</label>
                                                    <select class="form-control" required name="anoConclusaoCertificado">
                                                        <option></option>
                                                        <option>1999</option>
                                                        <option>2001</option>
                                                        <option>2002</option>
                                                        <option>2003</option>
                                                        <option>2004</option>
                                                        <option>2005</option>
                                                        <option>2006</option>
                                                        <option>2007</option>
                                                        <option>2008</option>
                                                        <option>2009</option>
                                                        <option>2010</option>
                                                        <option>2011</option>
                                                        <option>2012</option>
                                                        <option>2013</option>
                                                        <option>2014</option>
                                                        <option>2015</option>
                                                        <option>2016</option>
                                                        <option>2017</option>
                                                    </select>
                                                     <?php (isset($data['anoConclusaoCertificado'])) ? $data['anoConclusaoCertificado'] : $data['anoConclusaoCertificado'] = null ;?>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </section>

                                <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-floppy-o"></i> Salvar</button>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </form>

                    <!-- FIM -->


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Meus Certificados</h3>


                                </div>
                                <!-- /.box-header -->
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

                                                $readSes->FullRead("select * from certificadoprofissionalusuario cpu inner join certificadousuario cu on cpu.idCertificado = cu.idCertificado where cu.idUsuario= :catid", "catid={$userlogin['idUsuario']}");
                                                     foreach ($readSes->getResult() as $ses):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


                                                        echo "<tr><td> {$ses['instituicaoCertificado']} </td>
                                                              <td> {$ses['cursoCertificado']} </td>
                                                              
                                                              <td> {$ses['nivelCertificado']} </td>
                                                              <td> {$ses['duracaoCertificado']} </td>
                                                              <td> {$ses['anoInicioCertificado']} </td>
                                                              <td> {$ses['anoConclusaoCertificado']} </td>
                                                              <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\">        
                                                                    <td>
                                                                       
                                                                        <input type=\"hidden\" name=\"CadastroId\" value=\"{$ses['idCertificado']}\">
                                                                        <input type=\"hidden\" name=\"nomeCertificado\" value=\"{$ses['cursoCertificado']}\">
                                                                        <button input name=\"DeleteCertificado\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>
                                                                        
                                                                    </td> 
                                                              </form>
                                                              </tr>
                                                        ";                                                        
                                                        
                                                    endforeach;
                                               
                                                ?>
                                        <tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>

                    
                     <center> 
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="experiencia.php" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <li><a href="perfil.php"><i class="ion-person"></i> Perfil</a></li>
                            <li><a href="redeSocial.php"><i class="fa fa-commenting-o"></i> Redes Sociais</a></li>
                            <li><a href="endereco.php"><i class="fa fa-map-marker"></i> Localização</a></li>
                            <li><a href="experiencia.php"><i class="ion-briefcase"></i> Experiências</a></li>
                            <li><a href="#"><i class="fa fa-graduation-cap"></i> Certificados</a></li>
                            <li><a href="competencia.php"><i class="fa fa-toggle-off"></i> Competências</a></li>
                            <li>
                                <a href="competencia.php" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </center>
                    
                </section>

               

 <div class="row">
<?php include 'menuFooter.php'; ?>

<script>

    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="certificacao.php?id=<?php print $idCerticacao;?>"
    };
    
    function Cancelar(){
        location.href="certificacao.php"
    };         
</script>