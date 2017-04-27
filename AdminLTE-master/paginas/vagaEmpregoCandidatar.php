<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 22/03/2017
 * Time: 19:54
 */

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idVaga = $_GET['id'];


$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    $data['idVagaEmprego']= $idVaga;
    $data['idUsuarioProfissional'] = $userlogin['idUsuario'];
    $data['data']=date('Y-m-d H:i:s');     
    $data['situacao']=0;

    require '../../admin/_models/AdminCandidatarVaga.class.php';
    $cadastra = new AdminCandidatarVaga;

    $cadastra->ExeCreateEmprego($data);
    echo "<script>location.href='vagaEmpregoCandidatar.php?id={$idVaga}';</script>";

endif;

$readVaga = new Read();
$readVaga->FullRead("Select * From vagaempregocandidata where idVagaEmprego = {$idVaga} and idUsuarioProfissional = {$userlogin['idUsuario']}");



$readSes = new Read;
$readSes->FullRead("select * from vagaemprego ve inner join salao s on ve.idSalao=s.idSalao where idVagaEmprego = :id", "id={$idVaga}");

?>

    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">

        <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data"  >
        <div class="col-lg-12 connectedSortable">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="../dist/img/salao_default.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center"><?php echo $readSes->getResult()[0]['tituloVaga'] ?></h3>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- Fim Profile Image -->

        <!-- About Me Box -->
        <div class="col-lg-6 connectedSortable">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="ion-person"></i> Sobre a Vaga</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i>Profissão</strong>

                    <p>
                        <?php echo $readSes->getResult()[0]['profissao'] ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Nível</strong>
                    <p>
                        <?php echo $readSes->getResult()[0]['nivel'] ?>

                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Forma de contratação</strong>
                    <p>
                        R$ <?php echo $readSes->getResult()[0]['vinculoEmpregaticio'] ?>,00
                    </p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Número de Vagas</strong>

                    <p>
                        <?php echo $readSes->getResult()[0]['numeroVagas'] ?>
                    </p>
                    <hr>
                </div>
            </div>
        </div>
        <!-- Fim About Me Box -->
        <div class="col-lg-6 connectedSortable">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-building"></i> Sobre o Salão</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Salão</strong>

                    <p>
                        <?php echo $readSes->getResult()[0]['nomeSalao'] ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Localização</strong>
                    <p>
                        <?php echo $readSes->getResult()[0]['logradouro']; echo ", "; echo $readSes->getResult()[0]['numero'];
                        echo " - "; echo $readSes->getResult()[0]['bairro'];  echo " - "; echo $readSes->getResult()[0]['cep'];
                        echo " - "; echo $readSes->getResult()[0]['cidade'];  echo " - "; echo $readSes->getResult()[0]['estado']; ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Faixa de Remuneração</strong>

                    <p>
                        <?php echo $readSes->getResult()[0]['faixaRemuneracao'] ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-book margin-r-5"></i> Comissão</strong>

                    <p>
                        <?php echo $readSes->getResult()[0]['comissao'] ?>
                    </p>
                    <hr>
                </div>
            </div>
        </div>
        <!-- Inicio Minhas Experiências -->
        <div class="col-lg-12 connectedSortable">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="ion-person"></i> Informações Gerais</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <strong><i class="fa fa-pencil margin-r-5"></i> Descrição</strong>
                    <p>
                        <?php echo $readSes->getResult()[0]['descricaoOportunidade'] ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Requisitos do Candidato</strong>
                    <p>
                        <?php echo $readSes->getResult()[0]['requisitoCandidato'] ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Diferenciais</strong>
                    <p>
                        <?php echo $readSes->getResult()[0]['diferencialCandidato'] ?>
                    </p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Benefícios</strong>
                    <p>
                        <?php echo $readSes->getResult()[0]['beneficioCandidato'] ?>
                    </p>
                </div>
            </div>
        </div>

            <?php

            if(!$readVaga->getResult()):
                echo "
    <div class=\"col-lg-12 connectedSortable\">
    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\"><i class=\"fa fa-plus\"></i>Candidatar-se</button>
    </div>";
            else:
                echo "
    <div class=\"col-lg-12 connectedSortable\">
    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\" disabled><i class=\"fa fa-check\"></i> Candidatado</button>
    </div>";
            endif;
            ?>
        </form>

    </section>
    <div class="row">
<?php include 'menuFooter.php'; ?>