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

    RentalErro($cadastra->getError()[0], $cadastra->getError()[1]);

    if (!$cadastra->getResult()):
        RentalErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        echo "<script>location.href='cadVagaEmprego.php';</script>";
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
                                            <input type="text" class="form-control" placeholder="Escreva um título bem legal! :)" name="tituloVaga" style="width: 100%; height: 40px; font-size: 20px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" value="<?php if (isset($data)) echo $data['tituloVaga']; ?>" required>
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
                                                <div class="col-md-9">    

                                                    <label>Profissão</label>
                                                    <select class="form-control" name="profissao" required>
                                                        <option></option>
                                                        <option>Acupunturista</option>
                                                        <option>Barbeiro</option>
                                                    </select>
<?php if (isset($data)) echo $data['profissao']; ?>

                                                </div>
                                                <div class="col-md-3">    
                                                    <div class="form-group" >
                                                        <label>Nível</label>
                                                        <select class="form-control" name="nivel" required>
                                                            <option></option>
                                                            <option>Aprendiz</option>
                                                            <option>Estágio</option>
                                                            <option>Auxiliar</option>
                                                            <option>Assistente</option>
                                                            <option>Técnico</option>
                                                            <option>Junior</option>
                                                            <option>Pleno</option>
                                                            <option>Sênior</option>
                                                            <option>Coordenador</option>
                                                            <option>Supervisor</option>
                                                            <option>Gerente</option>
                                                            <option>Diretor</option>
                                                        </select>
<?php if (isset($data)) echo $data['nivel']; ?>

                                                    </div>
                                                </div>
                                                <p>
                                                <div class="form-group">
                                                    <p>
                                                        <label>Vinculo Empregatício:</label>
                                                    <p>
                                                        <label>
                                                            <input type="radio" name="vinculoEmpregaticio" value="Registro CLT" class="flat-red" checked required>
                                                            Registro CLT
                                                        </label>
                                                    <label>
                                                            <input type="radio" name="vinculoEmpregaticio" value="Registro PJ" class="flat-red" required>
                                                            Registro PJ
                                                        </label>
                                                   
                                                        <label>
                                                            <input type="radio" name="vinculoEmpregaticio" value="Estágio" class="flat-red" required>
                                                            Estágio
                                                        </label>
                                                    
                                                        <label>
                                                            <input type="radio" name="vinculoEmpregaticio" value="Freelancer" class="flat-red" required >
                                                            Freelancer
                                                        </label>
<?php if (isset($data)) echo $data['vinculoEmpregaticio']; ?>
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
                                            <input type="text" class="form-control" name="numeroVagas" value="<?php if (isset($data)) echo $data['numeroVagas']; ?>" required>

                                          
                                             
                                            <div class="col-md-8">
                                                <label>Faixa de Remuneração:</label>
                                                <select class="form-control" name="faixaRemuneracao" required>
                                                    <option></option>
                                                    <option>Não Divulgada</option>
                                                    <option>de R$ 788,00 à R$ 1.500,00</option>
                                                    <option>de R$ 1.500,00 à R$ 3.000,00</option>
                                                    <option>acima de R$ 3.000,00</option>
                                                </select>
<?php if (isset($data)) echo $data['faixaRemuneracao']; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Comissão:</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Seja Justo :)" id="comissao" name="comissao" value="<?php if (isset($data)) echo $data['apelidoUsuario']; ?>" required> 
                                                    <span class="input-group-addon">%</span>
                                                </div>	
                                            </div>
                                        
                                        <label>Descrição da Oportunidade:</label>   
                                        <textarea input class="textarea" placeholder="Descreva como será a rotina desse emprego" style="width: 100%; height: 75px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                  name="descricaoOportunidade" value="<?php if (isset($data)) echo $data['descricaoOportunidade']; ?>"></textarea>
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
                                                      name="requisitoCandidato" value="<?php if (isset($data)) echo $data['requisitoCandidato']; ?>"></textarea>
                                            <label>Diferencial:</label>   
                                            <textarea input class="textarea" placeholder="Não é obrigatório, mas seria muito bom se o candidato tivesse" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="diferencialCandidato" value="<?php if (isset($data)) echo $data['diferencialCandidato']; ?>"></textarea>
                                            <label>Benefícios:</label>   
                                            <textarea input class="textarea" placeholder="Quais os benefícios que seu funcionario terá?" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="beneficioCandidato" value="<?php if (isset($data)) echo $data['beneficioCandidato']; ?>"></textarea>

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