<?php
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 22/03/2017
 * Time: 18:39
 */

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idVaga = $_GET['id'];


$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    $data['idVagaAluguel']= $idVaga;
    $data['idUsuarioProfissional'] = $userlogin['idUsuario'];

    require '../../admin/_models/AdminCandidatarVaga.class.php';
    $cadastra = new AdminCandidatarVaga;

    $cadastra->ExeCreateAluguel($data);
    echo "<script>location.href='vagaAluguelCandidatar.php?id={$idVaga}';</script>";

endif;

$readVaga = new Read();
$readVaga->FullRead("Select * From vagaaluguelcandidatada where idVagaAluguel = {$idVaga} and idUsuarioProfissional = {$userlogin['idUsuario']}");

$readSes = new Read;
$readSes->FullRead("select * from vagaaluguel va inner join salao s on va.idSalao=s.idSalao where idVagaAluguel = :id", "id={$idVaga}");

?>
<!-- Main content -->
<section class="content">

    <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data"  >
    <section class="col-lg-12 connectedSortable">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="../dist/img/salao_default.jpg" alt="User profile picture">

                <h3 class="profile-username text-center"><?php echo $readSes->getResult()[0]['nomeAnuncio'] ?></h3>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- Fim Profile Image -->

    <!-- About Me Box -->
    <section class="col-lg-6 connectedSortable">
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
                <strong><i class="fa fa-pencil margin-r-5"></i> Forma de Aluguel</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['formaAluguel'] ?>

                </p>
                <hr>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Preço do Aluguel</strong>
                <p>
                    R$ <?php echo $readSes->getResult()[0]['preco'] ?>,00
                </p>
                <hr>
                <strong><i class="fa fa-book margin-r-5"></i> O que está sendo alugado</strong>

                <p>
                    <?php echo $readSes->getResult()[0]['itemAlugado'] ?>
                </p>
                <hr>
            </div>
        </div>
    </section>
    <!-- Fim About Me Box -->
    <section class="col-lg-6 connectedSortable">
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
                <strong><i class="fa fa-pencil margin-r-5"></i> Tamanho do Espaço</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['tamanho'] ?>
                </p>
                <hr>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Dias de Funcionamento</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['diaFuncionamento'] ?>
                </p>
                <hr>
                <strong><i class="fa fa-book margin-r-5"></i> Horário de funcionamento</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['horarioFuncionamento'] ?>
                </p>
                <hr>
            </div>
        </div>
    </section>
    <!-- Inicio Minhas Experiências -->
    <section class="col-lg-12 connectedSortable">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="ion-person"></i> Informações Gerais</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Características</strong>

                <p>
                    <?php echo $readSes->getResult()[0]['caracteristica'] ?>
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Diferencial</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['diferencial'] ?>
                </p>

            </div>
        </div>
    </section>

    <?php

    if(!$readVaga->getResult()):
    echo "
    <div class=\"col-lg-12 connectedSortable\">
    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\"><i class=\"fa fa-plus\"></i> Quero Alugar</button>
    </div>";
    else:
    echo "
    <div class=\"col-lg-12 connectedSortable\">
    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\" disabled><i class=\"fa fa-check\"></i> Proposta de Aluguel Enviada</button>
    </div>";
    endif;
    ?>
</form>
</section>
<div class="row">
    <?php include 'menuFooter.php'; ?>
