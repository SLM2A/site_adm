<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/AdminVagaEmprego.php';
    $cadastra = new AdminVagaEmprego;

    $cadastra->ExeCreate($data);
    
    $readID=new Read();
    $readID->FullRead("SELECT MAX(idVagaEmprego) FROM vagaemprego");
    $idVagaEmprego = $readID->getResult()[0]['MAX(idVagaEmprego)'];

    if ($cadastra->getResult()):
            $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
            $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
      echo "<script>location.href='perfilVagaEmpregoPublico.php?id={$idVagaEmprego}';</script>";
   endif;
endif;
?>

<section class="content">

    <form role="form" action="" method="post" class="login-form">
        

        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">                  
                    <li class="pull-left header"><i class="ion-compose"></i><b> ANÚNCIO DE VAGA DE EMPREGO</b></li>
                </ul>
                <div class="tab-content no-padding">
                    <div class="box-body box-profile" id="sales-chart" >
                        <div class="form-group">
                            <label>Titulo do Anúncio:</label>
                            <input type="text" class="form-control" placeholder="Escreva um título bem legal! :)" name="tituloVaga" style="width: 100%; height: 40px; font-size: 20px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" maxlength=60 value="<?php if (isset($data)) echo $data['tituloVaga']; ?>" required>
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
                            <label>Escolha o Salão ao qual a vaga pertence:</label>
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
                            <section class="col-lg-12 connectedSortable">
                                <div class="col-md-7">

                                    <label>Profissão</label>
                                    <select class="form-control" name="profissao" required>
                                         <option></option>
                                                        <?php
                                                        $readAreaAtuacao = new Read;

                                                        $readAreaAtuacao->FullRead("select * from areaatuacao order by nomeProfissao");
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
                                    

                                </div>
                                <div class="col-md-5">
                                    <div class="form-group" >
                                        <label>Nível</label>
                                        <select class="form-control" name="nivel" required>
                                            <option></option>
                                            <?php
                                                        $readnivel = new Read;

                                                        $readnivel->FullRead("select * from nivelVaga order by opcao");
                                                        if (!$readnivel->getResult()):
                                                            echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                                        else:
                                                            foreach ($readnivel->getResult() as $opcao):
                                                                echo "<option value=\"{$opcao['opcao']}\" ";

                                                                if ($opcao['opcao'] == $data['nivel']):
                                                                    echo ' selected="selected" ';
                                                                endif;

                                                                echo "> {$opcao['opcao']} </option>";
                                                            endforeach;
                                                        endif;
                                                        ?>
                                        </select>
                                        <?php if (isset($data)) echo $data['nivel']; ?>

                                    </div>
                                </div>
                                <p>
                                <div class="form-group">
                                    <p>
                                        <label>Vinculo Empregatício:</label>
                                    <p>
                                        <?php
                                                    $readvinculoEmpregaticio = new Read;

                                                    $readvinculoEmpregaticio->FullRead("select * from vinculoEmpregaticio order by opcao");
                                                    if (!$readvinculoEmpregaticio->getResult()):
                                                        echo '<label><option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                                    else:
                                                        foreach ($readvinculoEmpregaticio->getResult() as $opcao):
                                                            echo "<input type=\"radio\" name=\"vinculoEmpregaticio\" value=\"{$opcao['opcao']}\" ";

                                                            if ($opcao['opcao'] == $data['vinculoEmpregaticio']):
                                                                echo ' checked';
                                                            endif;
                                                            echo "> <label>{$opcao['opcao']} </label>" ; echo " ";
                                                        endforeach;
                                                    endif;
                                                    ?>
                                       
                                </div>

                            </section>
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

                        <label>Número de Vagas:</label>
                        <input type="text" maxlength=2 class="form-control" name="numeroVagas" onkeyup="somenteNumeros(this);" value="<?php if (isset($data)) echo $data['numeroVagas']; ?>" required>



                        <div class="col-md-8">
                            <label>Faixa de Remuneração:</label>
                            <select class="form-control" name="faixaRemuneracao" required>
                                <option></option>
                                <?php
                                                        $readfaixaRemuneracao = new Read;

                                                        $readfaixaRemuneracao->FullRead("select * from faixaRemuneracao");
                                                        if (!$readfaixaRemuneracao->getResult()):
                                                            echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                                        else:
                                                            foreach ($readfaixaRemuneracao->getResult() as $opcao):
                                                                echo "<option value=\"{$opcao['opcao']}\" ";

                                                                if ($opcao['opcao'] == $data['faixaRemuneracao']):
                                                                    echo ' selected="selected" ';
                                                                endif;

                                                                echo "> {$opcao['opcao']} </option>";
                                                            endforeach;
                                                        endif;
                                                        ?>
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label>Comissão:</label>
                            <div class="input-group">
                                <input type="text" maxlength=60 class="form-control" placeholder="Seja Justo :)" id="comissao" onkeyup="somenteNumeros(this);" name="comissao" value="<?php if (isset($data)) echo $data['comissao']; ?>" required> 
                                <span class="input-group-addon">%</span>
                            </div>	
                        </div>

                        <label>Descrição da Oportunidade:</label>   
                        <textarea input maxlength=60 class="textarea" placeholder="Descreva como será a rotina desse emprego" style="width: 100%; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                  name="descricaoOportunidade"><?php if (isset($data)) echo $data['descricaoOportunidade']; ?></textarea>
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
                            <label>Requisitos do candidato:</label>   
                            <textarea input class="textarea" placeholder="Quais conhecimentos o candidato precisa ter?" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                      name="requisitoCandidato" maxlength=200 value="<?php if (isset($data)) echo $data['requisitoCandidato']; ?>"></textarea>
                            <label>Diferencial:</label>   
                            <textarea input class="textarea" placeholder="Não é obrigatório, mas seria muito bom se o candidato tivesse" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                      name="diferencialCandidato" maxlength=200 value="<?php if (isset($data)) echo $data['diferencialCandidato']; ?>"></textarea>
                            <label>Benefícios:</label>   
                            <textarea input class="textarea" placeholder="Quais os benefícios que seu funcionario terá?" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                      name="beneficioCandidato" maxlength=200 value="<?php if (isset($data)) echo $data['beneficioCandidato']; ?>"></textarea>

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

    <script>
    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
          campo.value = "";
        }
    }
    </script>