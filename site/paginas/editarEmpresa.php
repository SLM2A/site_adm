<?php

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

//Recebe o Id por GET
$idSalao = $_GET['id'];
//Instancia a Classe Read para buscar Salão com o código recebido
$readSalao = new Read();


$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($_SESSION['userlogin']['msg'])):
    RentalErro($_SESSION['userlogin']['msg'], $_SESSION['userlogin']['tipoMsg']);
    $_SESSION['userlogin']['msg'] = '';
    $_SESSION['userlogin']['tipoMsg'] = '';
endif;


if (isset($data) && array_key_exists("SendPostForm", $data)):
    unset($data['SendPostForm']);
    
   $data['avatar'] = ($_FILES['portfolio']['tmp_name'] ? $_FILES['portfolio'] : NULL);
   
    if(!empty($data['avatar'])):
        require('../../admin/_models/AdminAvatar.class.php');
        $sendAvatar = new AdminAvatar();
        $sendAvatar->ExeCreateSalao($data['avatar'], $_SESSION['userlogin']['idUsuario'], $_SESSION['userlogin']['nomeUsuario'] . '-' . $_SESSION['userlogin']['sobrenomeUsuario']);
        $data['avatar'] = ($sendAvatar->getSendAvatar());
    else:
        unset($data['avatar']);
    endif;
    
    require '../../admin/_models/AdminSalao.php';
    $cadastra = new AdminSalao;

    $cadastra->ExeUpdate($idSalao, $data);
    
    if ($cadastra->getError()):
        $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
    endif;
    
    echo "<script>location.href='cadastroEmpresa.php';</script>";  
else:
    //Busca salão e coloca na Array Data
    $readSalao->FullRead("select * from salao where idSalao= :id", "id={$idSalao}");
    if($readSalao->getResult()):
        $data = $readSalao->getResult()[0];
    endif;
endif;
?>

    <section class="content-header">
        <h1> <i class="ion-briefcase"></i> Editar Salão</h1>
    </section>

    <!-- Main content -->
    <section class="content">
       <form enctype="multipart/form-data" role="form" action="" method="post" class="login-form">



            <!-- INICIO-->
            <!-- Default box -->
            <div class="col-lg-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li class="pull-left header"><i class="ion-camera"></i> Logo do Salão</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <div class="box-body box-profile">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                <i class="fa fa-folder"></i> Arquivos&hellip; <input type="file" style="display: none;" name="portfolio" id="exampleInputFile"/>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <section class="col-lg-6 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="nav-tabs-custom">
                            <!-- Tabs within a box -->
                            <ul class="nav nav-tabs pull-right">
                                <li class="pull-left header"><i class="fa fa-list-alt"></i> Dados</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <!-- Morris chart - Sales -->
                                

                                <div class="box-body box-profile" id="sales-chart" >
                                    <div class="form-group">
                                        <label>Nome da Empresa:</label>
                                        <input type="text" maxlength=60 class="form-control" name="nomeSalao" value="<?php if (isset($data)) echo $data['nomeSalao']; ?>" >
                                        <label>CNPJ:</label>
                                        <input type="text" maxlength=60 id="cnpj" class="form-control" name="cnpjSalao" value="<?php if (isset($data)) echo $data['cnpjSalao']; ?>" >
                                        <label>Categoria:</label>
                                        <select class="form-control" name="categoriaSalao">
                                            <option selected><?php if (isset($data)) echo $data['categoriaSalao']; ?></option>
                                            <?php
                                            if($data['categoriaSalao']=='Barbeiro'):
                                                echo '<option>Salão</option>';
                                            elseif($data['categoriaSalao']=='Salão'):
                                                echo '<option>Barbeiro</option>';
                                            else:
                                                echo '<option>Barbeiro</option>';
                                                echo '<option>Salão</option>';
                                            endif;
                                            ?>
                                        </select>

                                        <div class="box-body pad">
                                      <textarea input type="text" maxlength=255 class="form-control" placeholder="Escreva sobre você..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          name="descricaoSalao" id="descricaoSalao" required><?php if (isset($data)) echo $data['descricaoSalao']; ?></textarea>

                                        </div>
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
                                <li class="pull-left header"><i class="fa fa-map-marker"></i> Localização</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <!-- Morris chart - Sales -->

                                <div class="box-body box-profile" id="sales-chart" >
                                    <div class="form-group">
                                        <section class="col-lg-12 connectedSortable">

                                            <label>CEP:</label>
                                            <input type="text" id="cep" class="form-control" name="cep" value="<?php if (isset($data)) echo $data['cep']; ?>" required>
                                            <label>Endereço:</label>
                                            <input type="text" id="rua" class="form-control" name="logradouro" value="<?php if (isset($data)) echo $data['logradouro']; ?>" >
                                            <label>Número:</label>
                                            <input type="text" maxlength=10 class="form-control"  name="numero" value="<?php if (isset($data)) echo $data['numero']; ?>" required>
                                            <label>Complemento:</label>
                                            <input type="text" maxlength=60 class="form-control" name="complemento" value="<?php if (isset($data)) echo $data['complemento']; ?>" >
                                            <label>Bairro:</label>
                                            <input type="text" id="bairro" class="form-control" name="bairro" value="<?php if (isset($data)) echo $data['bairro']; ?>" >
                                            <label>Cidade:</label>
                                            <input type="text" id="cidade" class="form-control" name="cidade" value="<?php if (isset($data)) echo $data['cidade']; ?>" >
                                            <label>Estado:</label>
                                            <input type="text" id="uf"  class="form-control" name="estado" value="<?php if (isset($data)) echo $data['estado']; ?>" >
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>



                    <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-floppy-o"></i> Salvar</button>

            <!-- /.box -->
        </form>

        <!-- FIM -->

    </section>
    <div class="row">



<?php include 'menuFooter.php'; ?>