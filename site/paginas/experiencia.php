<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/*
 * Insere no banco a experiencia 
 */
if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    if($data['deExperiencia']<$data['ateExperiencia']):
        require '../../admin/_models/AdminExperiencia.php';
        $cadastra = new AdminExperiencia;

        $cadastra->ExeCreate($data);
        $readEndereco = new Read;

        $readEndereco->FullRead("SELECT MAX(idExperiencia) FROM experienciaprofissionalusuario");
        $idExperiencia = $readEndereco->getResult()[0]['MAX(idExperiencia)'];


        $ExperienciaUsuario['idExperiencia'] = $idExperiencia;
        $ExperienciaUsuario['idUsuario'] = $userlogin['idUsuario'];


        $cadastra->InsereRelacao($ExperienciaUsuario);

             if ($cadastra->getResult()):
                $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
                $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
                echo "<script>location.href='experiencia.php';</script>";
            endif;
    else:
        
                $_SESSION['userlogin']['msg'] = "Não foi possível cadastrar, pois o campo 'DE' é maior que o campo 'ATÉ'!";
                $_SESSION['userlogin']['tipoMsg'] = RENTAL_ALERT;
                echo "<script>location.href='experiencia.php';</script>";
    endif;

    
endif;

/*
 * Fim insere no banco a experiencia 
 */

/*
 * DELETE CERTICAÇÃO
 */

//Chamar a Modal.
if (isset($post) && array_key_exists("DeleteExperiencia", $post)):
    unset($post['DeleteExperiencia']);
    $idExperiencia = $post['CadastroId'];
    $_SESSION['userlogin']['DeleteExperiencia'] = "ok";
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a experiencia: {$post['cargoExperiencia']}?", "Cancelar", "Excluir", "Excluir");
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
if (isset($CadastroId) and isset($_SESSION['userlogin']['DeleteExperiencia'])):
    unset($_SESSION['userlogin']['DeleteExperiencia']);
    require('../../admin/_models/AdminExperiencia.php');
    
    $deleteExperiencia = new AdminExperiencia();    
    $deleteExperiencia->ExeDelete($CadastroId);
    
    unset($_SESSION['userlogin']['$this->CadID']);
   
    if ($deleteExperiencia->getError()):
        $_SESSION['userlogin']['msg'] = $deleteExperiencia->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteExperiencia->getError()[1];
    endif;

    echo "<script>location.href='experiencia.php';</script>";
endif;

?>



<section class="content-header">
    <h1> <i class="ion-briefcase"></i> Experiências</h1>  
</section>

<!-- Main content -->
<section class="content">
    <form role="form" action="" method="post" class="login-form">



        <!-- INICIO-->
        <!-- Default box -->

        <div class="box box-solid collapsed-box" >

            <div class="box-header with-border">
                <h3 class="box-title"><i class=""></i> Cadastrar Experiência</h3>

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
                        <ul class="nav nav-tabs pull-right">                  
                            <li class="pull-left header"><i class="ion-person"></i> Dados da empresa</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->

                            <div class="box-body box-profile" id="sales-chart" >
                                <div class="form-group">
                                    <label>Cargo:</label>
                                    <select class="form-control" name="cargoExperiencia">
                                        <option></option>
                                        <?php
                                                $readAreaAtuacao = new Read;

                                                $readAreaAtuacao->FullRead("select * from areaatuacao");
                                                if (!$readAreaAtuacao->getResult()):
                                                    echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                                else:
                                                    foreach ($readAreaAtuacao->getResult() as $area):
                                                        echo "<option value=\"{$area['nomeProfissao']}\" ";

                                                        if ($area['idAreaAtuacao'] == $data['idAreaAtuacao']):
                                                            echo ' selected="selected" ';
                                                        endif;

                                                        echo "> {$area['nomeProfissao']} </option>";
                                                    endforeach;
                                                endif;
                                                ?>
                                    </select>
<?php if (isset($data)) echo $data['cargoExperiencia']; ?>
                                    <label>Empresa:</label>
                                    <input type="text" maxlength=60  class="form-control" name="empresaExperiencia" id="empresaExperiencia" value="<?php if (isset($data)) echo $data['empresaExperiencia']; ?>">
                                </div>
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
                            <li class="pull-left header"><i class="ion-calendar"></i> Periodo</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->

                            <div class="box-body box-profile" id="sales-chart" >
                                <div class="form-group">
                                    <label>De:</label>
                                    <select class="form-control" name="deExperiencia">
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
<?php if (isset($data)) echo $data['deExperiencia']; ?>

                                    <label>Até</label>
                                    <select class="form-control" name="ateExperiencia">
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
<?php if (isset($data)) echo $data['ateExperiencia']; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">                  
                            <li class="pull-left header"><i class="ion-edit"></i> Sobre a Experiência</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->

                            <div ></div>
                            <div class="box-body box-profile" id="sales-chart" >
                                <div class="box-body pad">
                                    <textarea maxlength=250 class="textarea" placeholder="Escreva sobre sua experiência..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                              name="descricao" value="<?php if (isset($data)) echo $data['descricao']; ?>"></textarea>
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
                    <h3 class="box-title">Minhas Experiências</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead> 
                            <tr>
                                <th>Cargo</th>
                                <th>Empresa</th>
                                <th>De</th>
                                <th>Até</th>
                                <th>Descrição</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

<?php
    $readSes = new Read;
    $readSes->FullRead("select * from experienciaprofissionalusuario exp inner join experienciausuario ex on exp.idExperiencia = ex.idExperiencia where ex.idUsuario= :catid", "catid={$userlogin['idUsuario']}");

    foreach ($readSes->getResult() as $ses):
        echo "<tr> 
               <td> {$ses['cargoExperiencia']} </td>
                <td> {$ses['empresaExperiencia']} </td>
                <td> {$ses['deExperiencia']} </td>
                <td> {$ses['ateExperiencia']} </td>
                <td> {$ses['descricao']} </td>
                <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\">        
                      <td>
                          
                          <input type=\"hidden\" name=\"CadastroId\" value=\"{$ses['idExperiencia']}\">
                          <input type=\"hidden\" name=\"cargoExperiencia\" value=\"{$ses['cargoExperiencia']}\">
                          <button input name=\"DeleteExperiencia\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>  
                      </td> 
                </form>
              </tr>
          ";
    endforeach;
?>
                       </tbody>  
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
                    <a href="endereco.php" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <li><a href="perfil.php"><i class="ion-person"></i> Perfil</a></li>
                <li><a href="redeSocial.php"><i class="fa fa-commenting-o"></i> Redes Sociais</a></li>
                <li><a href="endereco.php"><i class="fa fa-map-marker"></i> Localização</a></li>
                <li><a href="#"><i class="ion-briefcase"></i> Experiências</a></li>
                <li><a href="certificacao.php"><i class="fa fa-graduation-cap"></i> Certificados</a></li>
                <li><a href="competencia.php"><i class="fa fa-toggle-off"></i> Competências</a></li>
                <li>
                    <a href="certificacao.php" aria-label="Next" disabled>
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
        location.href="experiencia.php?id=<?php print $idExperiencia;?>"
    };
    
    function Cancelar(){
        location.href="experiencia.php"
    };         
</script>