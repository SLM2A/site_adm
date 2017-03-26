<?php

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idVaga = $_GET['id'];



$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/AdminVagaAluguel.php';
    $cadastra = new AdminVagaAluguel;

    $cadastra->ExeUpdate($idVaga,$data);



    if (!$cadastra->getResult()):
        RentalErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:

        echo "<script>location.href='minhasVagas.php';</script>";
    endif;
else:
    //Busca salão e coloca na Array Data
    $readVaga = new Read();
    $readVaga->FullRead("select * from vagaaluguel where idVagaAluguel= :id", "id={$idVaga}");
    if($readVaga->getResult()):
        $data = $readVaga->getResult()[0];
    endif;

endif;
$readObjeto = new Read;

$readObjeto->FullRead("select * from objetoAlugado");



?>

    <section class="content">


        <form role="form" action="" method="post" class="login-form">
            <section class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="ion-compose"></i><b> ANÚNCIO DE ESPAÇO PARA ALUGUEL</b></li>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="box-body box-profile" id="sales-chart" >
                            <div class="form-group">
                                <label>Titulo do Anúncio:</label>
                                <input type="text" class="form-control" placeholder="Escreva um título bem legal! :)" name="nomeAnuncio" style="width: 100%; height: 40px; font-size: 20px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" value="<?php if (isset($data)) echo $data['nomeAnuncio']; ?>" required>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="ion-compose"></i> Dados Principais</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="box-body box-profile" id="sales-chart" >
                            <div class="form-group">
                                <label>Escolha o Salão ao qual o espaço pertence:</label>
                                <select class="form-control" name="idSalao" required>
                                    <option disabled selected> Escolha o salão</option>

                                    <?php
                                    $readSes = new Read;

                                    $readSes->FullRead("select * from salao s inner join salaoempresario se on s.idSalao=se.idSalao where se.idUsuario= :catid", "catid={$userlogin['idUsuario']}");
                                    if (!$readSes->getResult()):
                                        echo '<option disabled="disabled" value="null"> Cadastre antes um Salão! </option>';
                                    else:
                                        foreach ($readSes->getResult() as $ses):
                                            echo "<option value=\"{$ses['idSalao']}\" ";

                                            if ($ses['idSalao'] == $data['idSalao']):
                                                echo ' selected="selected" ';
                                            endif;

                                            echo "> {$ses['nomeSalao']} </option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">



                                <label>Vaga destinada à:</label>
                                <select class="form-control" name="profissao" required>
                                 <?php
                                    $readAreaAtuacao = new Read;

                                    $readAreaAtuacao->FullRead("select * from areaatuacao");
                                    if (!$readAreaAtuacao->getResult()):
                                        echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                    else:
                                        foreach ($readAreaAtuacao->getResult() as $area):
                                            echo "<option value=\"{$area['nomeProfissao']}\" ";

                                                        if ($area['nomeProfissao'] == $data['profissao']):
                                                           echo ' selected="selected" ';
                                                        endif;

                                            echo "> {$area['nomeProfissao']} </option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>

                                <br>
                                <label> Forma de Aluguel:</label>

                                <div class="form-group">

                                    <?php
                                    $readFormaAluguel = new Read;

                                    $readFormaAluguel->FullRead("select * from formaAluguel");
                                    if (!$readFormaAluguel->getResult()):
                                        echo '<label><option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                    else:
                                        foreach ($readFormaAluguel->getResult() as $objeto):
                                            echo "<input type=\"radio\" name=\"formaAluguel\" value=\"{$objeto['opcao']}\" class=\"flat-red\" ";

                                            if ($objeto['opcao'] == $data['formaAluguel']):
                                                echo ' checked';
                                            endif;
                                            echo "> {$objeto['opcao']} </option></label>";
                                        endforeach;
                                    endif;
                                    ?>



                                </div>


                                <label>Preço:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" class="form-control" placeholder="Seja Justo :)" id="preco" name="preco" value="<?php if (isset($data)) echo $data['preco']; ?>" required>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>




            <section class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="ion-ios-settings-strong"></i> Datalhes</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="box-body box-profile" id="sales-chart" >
                            <div class="form-group">
                                <label>O que você está alugando:</label>
                                <select class="form-control" name="itemAlugado" required>
                                    <?php
                                    $readObjeto = new Read;

                                    $readObjeto->FullRead("select * from objetoAlugado");
                                    if (!$readObjeto->getResult()):
                                        echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                    else:
                                        foreach ($readObjeto->getResult() as $objeto):
                                            echo "<option value=\"{$objeto['descricao']}\" ";

                                                        if ($objeto['descricao'] == $data['itemAlugado']):
                                                            echo ' selected="selected" ';
                                                        endif;
                                            echo "> {$objeto['descricao']} </option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tamanho (m²):</label>
                                <input type="text" class="form-control" name="tamanho" value="<?php if (isset($data)) echo $data['tamanho']; ?>" required>

                            </div>
                            <div class="form-group">
                                <label>Dias de Funcionamento:</label>
                                <select class="form-control" name="diaFuncionamento" required>
                                    <?php
                                    $readDia = new Read;

                                    $readDia->FullRead("select * from diaFuncionamento");
                                    if (!$readDia->getResult()):
                                        echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                    else:
                                        foreach ($readDia->getResult() as $dia):
                                            echo "<option value=\"{$dia['opcao']}\" ";

                                            if ($dia['opcao'] == $data['diaFuncionamento']):
                                                echo ' selected="selected" ';
                                            endif;
                                            echo "> {$dia['opcao']} </option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Horário de Funcionamento:</label>
                                <select class="form-control" name="horarioFuncionamento" required>
                                    <?php
                                    $readHorario = new Read;

                                    $readHorario->FullRead("select * from horarioFuncionamento");
                                    if (!$readHorario->getResult()):
                                        echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                    else:
                                        foreach ($readHorario->getResult() as $horario):
                                            echo "<option value=\"{$horario['opcao']}\" ";

                                            if ($horario['opcao'] == $data['diaFuncionamento']):
                                                echo ' selected="selected" ';
                                            endif;
                                            echo "> {$horario['opcao']} </option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>

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
                        <li class="pull-left header"><i class="ion-person"></i> Candidato e Benefícios</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="box-body box-profile" id="sales-chart" >
                            <div class="form-group">
                                <label>Caracteristica:</label>
                                            <textarea input class="textarea" placeholder="Escreva coisas que deixe seu anuncio mais atrativo! :)" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="caracteristica"><?php if (isset($data)) echo $data['caracteristica']; ?></textarea>
                                <label>Diferenciais do seu espaço:</label>
                                            <textarea input class="textarea" placeholder="Não é obrigatório, mas seria muito bom se você preenchesse" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="diferencial"><?php if (isset($data)) echo $data['diferencial']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="col-lg-12 connectedSortable ">
                <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-plus"></i> Cadastrar Vaga</button>
            </section>
        </form>

    </section>

    <div class="row">

<?php include 'menuFooter.php'; ?>