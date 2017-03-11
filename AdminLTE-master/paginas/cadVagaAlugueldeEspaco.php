<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/AdminVagaAluguel.php';
    $cadastra = new AdminVagaAluguel;

    $cadastra->ExeCreate($data);

    

    if (!$cadastra->getResult()):
        RentalErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        
         echo "<script>location.href='cadVagaAlugueldeEspaco.php';</script>";
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
                                            
                                                   

                                                    <label>Quais profissões podem utilizar o espaço?</label>
                                                    <select class="form-control" name="profissao" required>
                                                        <option></option>
                                                        <option>Acupunturista</option>
                                                        <option>Barbeiro</option>
                                                    </select>
<?php if (isset($data)) echo $data['profissao']; ?>
                                                    <br>
                                                    <label> Forma de Aluguel:</label>
                                                    
                                                <div class="form-group">
                                                   
                                                        <label>
                                                            <input type="radio" name="formaAluguel" value="Por Hora" class="flat-red" checked required>
                                                            Por Hora       
                                                        </label>
                                                    
                                                        <label>
                                                            <input type="radio" name="formaAluguel" value="Por Dia" class="flat-red" required>
                                                            Por Dia
                                                        </label>
                                                    
                                                        <label>
                                                            <input type="radio" name="formaAluguel" value="Por Semana" class="flat-red" required>
                                                            Por Semana
                                                        </label>
                                                    
                                                        <label>
                                                            <input type="radio" name="formaAluguel" value="Por Mês" class="flat-red" required >
                                                            Por Mês
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="formaAluguel" value="À Combinar" class="flat-red" required >
                                                            À Combinar
                                                        </label>
<?php if (isset($data)) echo $data['formaAluguel']; ?>
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
                                                <option></option>
                                                <option>Cadeira para serviços</option>
                                                <option>Sala com cama para serviços</option>
                                                <option>Estação de trabalho sem equipamentos</option>
                                                <option>Estação de trabalho completa</option>
                                            </select>
                                         <?php if (isset($data)) echo $data['itemAlugado']; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Tamanho (m²):</label>
                                            <input type="text" class="form-control" name="tamanho" value="<?php if (isset($data)) echo $data['tamanho']; ?>" required>

                                        </div>   
                                        <div class="form-group">
                                            <label>Dias de Funcionamento:</label>
                                            <select class="form-control" name="diaFuncionamento" required>
                                                <option></option>
                                                <option>Segunda à Sexta</option>
                                                <option>Segunda à Sábado</option>
                                                <option>Todos os dias da semana</option>
                                                <option>À disposição do contratante</option>
                                            </select>
                                            <?php if (isset($data)) echo $data['diaFuncionamento']; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Horário de Funcionamento:</label>
                                            <select class="form-control" name="horarioFuncionamento" required>
                                                <option></option>
                                                <option>Horário Comercial</option>
                                                <option>Horário Flexível</option>
                                                <option>À disposição do contratante</option>
                                            </select>
                                            <?php if (isset($data)) echo $data['horarioFuncionamento']; ?>
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
                                                  name="caracteristica" value="<?php if (isset($data)) echo $data['caracteristica']; ?>"></textarea>
                                            <label>Diferenciais do seu espaço:</label>   
                                            <textarea input class="textarea" placeholder="Não é obrigatório, mas seria muito bom se você preenchesse" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="diferencial" value="<?php if (isset($data)) echo $data['diferencial']; ?>"></textarea>
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