<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/AdminSalao.php';
    $cadastra = new AdminSalao;

    $cadastra->ExeCreate($data);
    $readSalao = new Read;

    $readSalao->FullRead("SELECT MAX(idSalao) FROM salao");
    $idSalao = $readSalao->getResult()[0]['MAX(idSalao)'];


    $SalaoEmpresario['idSalao'] = $idSalao;
    $SalaoEmpresario['idUsuario'] = $userlogin['idUsuario'];


    $cadastra->InsereRelacao($SalaoEmpresario);


    if (!$cadastra->getResult()):
        WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        echo "<script>location.href='cadastroEmpresa.php';</script>";
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
                    <h3 class="box-title"><i class="ion-plus"></i> Cadastrar Salão</h3>

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
                                <li class="pull-left header"><i class="fa fa-list-alt"></i> Dados</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <!-- Morris chart - Sales -->

                                <div class="box-body box-profile" id="sales-chart" >
                                    <div class="form-group">
                                        <label>Nome da Empresa:</label>
                                        <input type="text" class="form-control" name="nomeSalao" value="<?php if (isset($data)) echo $data['nomeSalao']; ?>" >
                                        <label>CNPJ:</label>
                                        <input type="text" id="cnpj" class="form-control" name="cnpjSalao" value="<?php if (isset($data)) echo $data['cnpjSalao']; ?>" >
                                        <label>Categoria:</label>
                                        <select class="form-control" name="categoriaSalao">
                                            <option></option>
                                            <option>Salão</option>
                                            <option>Barbearia</option>
                                        </select>
                                        <?php if (isset($data)) echo $data['categoriaSalao']; ?>
                                        <div class="box-body pad">
                                            <textarea input class="textarea" placeholder="Escreva sobre você..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="descricaoSalao" value="<?php if (isset($data)) echo $data['descricaoSalao']; ?>"></textarea>
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
                                                <input type="text"  class="form-control"  name="numero" value="<?php if (isset($data)) echo $data['numero']; ?>" required>
                                                <label>Complemento:</label>
                                                <input type="text" class="form-control" name="complemento" value="<?php if (isset($data)) echo $data['complemento']; ?>" >
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
                  <h3 class="box-title"><i class="fa fa-building"></i> Meus Salões</h3>

                  
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>CNPJ</th>
                          <th>Categoria:</th>
                          <th>Endereço</th>
                          <th></th>
                        </tr>
                       </thead>
                     <tbody>
                       
                         <?php
                                                $readSes = new Read;

                                                $readSes->FullRead("select * from salao s inner join salaoempresario se on s.idSalao = se.idSalao where se.idUsuario= :catid", "catid={$userlogin['idUsuario']}");
                                                     foreach ($readSes->getResult() as $ses):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


                                                        echo "<tr><td> {$ses['nomeSalao']} </td>
                                                              <td> {$ses['cnpjSalao']} </td>
                                                              
                                                              <td> {$ses['categoriaSalao']} </td>
                                                              <td> {$ses['logradouro']} {$ses['numero']}</td>
                                                                                                                                <td>   <div class=\"btn-group\">
                                                                    <button type=\"button\" class=\"btn btn-info\"><i class=\"fa  fa-pencil\"></i></button>
                                                                    <button type=\"button\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>
                                                                    <a href=\"perfilSalaoPublico.php?id={$ses['idSalao']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Salão</button></a>
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
    </section>
    <div class="row">



<?php include 'menuFooter.php'; ?>