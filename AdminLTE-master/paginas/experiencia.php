<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/AdminExperiencia.php';
    $cadastra = new AdminExperiencia;

    $cadastra->ExeCreate($data);
    $readEndereco = new Read;

    $readEndereco->FullRead("SELECT MAX(idExperiencia) FROM experienciaprofissionalusuario");
    $idExperiencia = $readEndereco->getResult()[0]['MAX(idExperiencia)'];


    $ExperienciaUsuario['idExperiencia'] = $idExperiencia;
    $ExperienciaUsuario['idUsuario'] = $userlogin['idUsuario'];


    $cadastra->InsereRelacao($ExperienciaUsuario);


    if (!$cadastra->getResult()):
        WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        echo "<script>location.href='experiencia.php';</script>";
    endif;
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

        <div class="box" closet>

            <div class="box-header with-border">
                <h3 class="box-title"><i class="ion-plus"></i> Cadastrar Experiência</h3>

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
                                    <input type="text" class="form-control" name="empresaExperiencia" id="empresaExperiencia" value="<?php if (isset($data)) echo $data['empresaExperiencia']; ?>">
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
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                    </select>
<?php if (isset($data)) echo $data['deExperiencia']; ?>

                                    <label>Até</label>
                                    <select class="form-control" name="ateExperiencia">
                                        <option></option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
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
                                    <textarea class="textarea" placeholder="Escreva sobre sua experiência..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                              name="descricao" value="<?php if (isset($data)) echo $data['descricao']; ?>"></textarea>
                                </div>


                            </div>

                        </div>

                    </div>
                </section>

                <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-plus"></i> Enviar e Ir para localização</button>
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
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


    echo "<tr><td> {$ses['cargoExperiencia']} </td>
                                                              <td> {$ses['empresaExperiencia']} </td>
                                                              
                                                              <td> {$ses['deExperiencia']} </td>
                                                              <td> {$ses['ateExperiencia']} </td>
                                                              <td> {$ses['descricao']} </td>
                                                                  <td>   <div class=\"btn-group\">
                                                                    <button type=\"button\" class=\"btn btn-info\"><i class=\"fa  fa-pencil\"></i></button>
                                                                    <button type=\"button\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>
                                                                    
                                                                  </div></td></tr>
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