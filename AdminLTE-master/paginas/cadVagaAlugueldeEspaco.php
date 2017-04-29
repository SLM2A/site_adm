<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//MENSAGEM
if (!empty($_SESSION['userlogin']['msg'])):
    RentalErro($_SESSION['userlogin']['msg'], $_SESSION['userlogin']['tipoMsg']);
    $_SESSION['userlogin']['msg'] = '';
    $_SESSION['userlogin']['tipoMsg'] = '';
endif;

/**
 * ENVIAR FORM* /
 */

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);
        

   require '../../admin/_models/AdminVagaAluguel.php';
    $cadastra = new AdminVagaAluguel;
    $cadastra->ExeCreate($data);
    
    
    $readID = new Read();
    
    $readID->FullRead("SELECT MAX(idVagaAluguel) FROM vagaaluguel");
    $idVagaAluguel = $readID->getResult()[0]['MAX(idVagaAluguel)'];
    
    
   
    //$cadastra->ExeCreate($data);    
    if (!in_array('', $_FILES['portfolio']['tmp_name'])):         
        $post = ($_FILES['portfolio']['tmp_name'] ? $_FILES['portfolio'] : NULL);
        require('../../admin/_models/AdminVagaAluguelImagem.class.php');
        
       // $post['idVagaAluguel'];
        $criaVagaAluguelImagem = new AdminVagaAluguelImagem();
        $criaVagaAluguelImagem->ExeCreate($post, $idVagaAluguel, $_SESSION['userlogin']['nomeUsuario'] . '-' . $_SESSION['userlogin']['sobrenomeUsuario']);
       
    endif;
    if ($cadastra->getResult()):
            $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
            $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
      echo "<script>location.href='perfilVagaAluguelPublico.php?id={$idVagaAluguel}';</script>";
   endif;
    
endif;

?>

<section class="content">
                     

                    <form name="PostForm" role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="col-lg-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs pull-right">
                                    <li class="pull-left header"><i class="ion-camera"></i> Fotos do espaço a ser alugado</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <div class="box-body box-profile">
                                        <div class="input-group">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary">
                                                    <i class="fa fa-folder"></i> Arquivos&hellip; <input type="file" style="display: none;" multiple name="portfolio[]" id="exampleInputFile"/>
                                                </span>
                                            </label>
                                            <input type="text" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
                                            <input type="text" class="form-control" placeholder="Escreva um título bem legal! :)"  maxlength=50 name="nomeAnuncio" style="width: 100%; height: 40px; font-size: 20px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" value="<?php if (isset($data)) echo $data['nomeAnuncio']; ?>"  required>
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
                                                        <option></option>
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
<?php if (isset($data)) echo $data['profissao']; ?>
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
                                                    <input type="text" class="form-control" placeholder="Seja Justo :)" id="preco" name="preco" value="<?php if (isset($data)) echo $data['preco']; ?>" maxlength=50 required> 
                                                    
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
                                         <?php if (isset($data)) echo $data['itemAlugado']; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Tamanho (m²):</label>
                                            <input type="text" class="form-control" name="tamanho" value="<?php if (isset($data)) echo $data['tamanho']; ?>"  maxlength=10 required>

                                        </div>   
                                        <div class="form-group">
                                            <label>Dias de Funcionamento:</label>
                                            <select class="form-control" name="diaFuncionamento" required>
                                                <option></option>
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
                                                <option></option>
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
                                                  name="caracteristica" value="<?php if (isset($data)) echo $data['caracteristica']; ?>" maxlength=200></textarea>
                                            <label>Diferenciais do seu espaço:</label>   
                                            <textarea input class="textarea" placeholder="Não é obrigatório, mas seria muito bom se você preenchesse" style="width: 100%; height: 40px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="diferencial" value="<?php if (isset($data)) echo $data['diferencial']; ?>" maxlength=200></textarea>
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