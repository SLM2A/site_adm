<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/*
 * Insere no banco o Salão e a relação salão empresario
 */
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
    $cadastra->ExeCreate($data);
    $readSalao = new Read;
    $readSalao->FullRead("SELECT MAX(idSalao) FROM salao");
    $idSalao = $readSalao->getResult()[0]['MAX(idSalao)'];
    $SalaoEmpresario['idSalao'] = $idSalao;
    $SalaoEmpresario['idUsuario'] = $userlogin['idUsuario'];
    $cadastra->InsereRelacao($SalaoEmpresario);
   
     
    if ($cadastra->getError()):
            $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
            $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
        endif;

    echo "<script>location.href='cadastroEmpresa.php';</script>";  
    
endif;

/*
 * Fim Insere no banco o Salão e a relação salão empresario
 */

//Mostra menssagem de sucesso ou erro se necessario.



/*
 * DELETE SALÃO
 */

//Chamar a Modal.
if (isset($post) && array_key_exists("DeleteSalao", $post)):
    unset($post['DeleteSalao']);
    $idSalao = $post['CadastroId'];
    $_SESSION['userlogin']['DeleteSalao'] = "ok";
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a Vaga: {$post['nomeSalao']}?", "Cancelar", "Excluir", "Excluir");
endif;

/**
 * Condição * /
 */

if (array_key_exists('id', $_GET)):
       $CadastroId = $_GET['id'];        
endif;

//Mensagem
if (!empty($_SESSION['userlogin']['msg'])):
    RentalErro($_SESSION['userlogin']['msg'], $_SESSION['userlogin']['tipoMsg']);
    $_SESSION['userlogin']['msg'] = '';
    $_SESSION['userlogin']['tipoMsg'] = '';
endif;

/**
 * DELETAR MENSSAGEM* /
 */


//Se na modal for clicado em excluir executa o bloco abaixo 
if (isset($CadastroId) and isset($_SESSION['userlogin']['DeleteSalao'])):
    unset($_SESSION['userlogin']['DeleteSalao']);
    require('../../admin/_models/AdminSalao.php');
    
    $deleteSalao = new AdminSalao();    
    $deleteSalao->ExeDelete($CadastroId);
    
    unset($_SESSION['userlogin']['$this->CadID']);
   
    if ($deleteSalao->getError()):
        $_SESSION['userlogin']['msg'] = $deleteSalao->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteSalao->getError()[1];
    endif;

    echo "<script>location.href='cadastroEmpresa.php';</script>";
endif;


?>

<section class="content-header">
     <h1> <i class="fa fa-building"></i> Meus Salões</h1>  
    </section>

    <!-- Main content -->
    <section class="content">
        <form enctype="multipart/form-data" role="form" action="" method="post" class="login-form">
            


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
                                        <input type="text" maxlength=60 class="form-control" name="nomeSalao" value="<?php (isset($data['nomeSalao'])) ? $data['nomeSalao'] : $data['nomeSalao'] = null ;?>" >
                                        <label>CNPJ:</label>
                                        <input type="text" id="cnpj" maxlength=60 class="form-control" name="cnpjSalao" value="<?php (isset($data['cnpjSalao'])) ? $data['cnpjSalao'] : $data['cnpjSalao'] = null ;?>" >
                                        <label>Categoria:</label>
                                        <select class="form-control" name="categoriaSalao">
                                            <option></option>
                                            <option>Salão</option>
                                            <option>Barbearia</option>
                                        </select>
                                        <?php (isset($data['categoriaSalao'])) ? $data['categoriaSalao'] : $data['categoriaSalao'] = null ;  ?>
                                        <div class="box-body pad">
                                            <textarea input class="textarea" placeholder="Escreva sobre o salão..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                      name="descricaoSalao" maxlength=200 value="<?php  (isset($data['descricaoSalao'])) ? $data['descricaoSalao'] : $data['descricaoSalao'] = null ; ?>"></textarea>
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
                                                <input type="text" id="cep" class="form-control" name="cep" value="<?php (isset($data['cep'])) ? $data['cep'] : $data['cep'] = null ; ?>" required>
                                                <label>Endereço:</label>
                                                <input type="text" id="rua"  class="form-control" name="logradouro" value="<?php (isset($data['logradouro'])) ? $data['logradouro'] : $data['logradouro'] = null ;  ?>" >
                                                <label>Número:</label>
                                                <input type="text"  class="form-control"  maxlength=10 name="numero" value="<?php (isset($data['numero'])) ? $data['numero'] : $data['numero'] = null ; ?>" required>
                                                <label>Complemento:</label>
                                                <input type="text" class="form-control" maxlength=60 name="complemento" value="<?php (isset($data['complemento'])) ? $data['complemento'] : $data['complemento'] = null ; ?>" >
                                                <label>Bairro:</label>
                                                <input type="text" id="bairro" class="form-control" name="bairro" value="<?php (isset($data['bairro'])) ? $data['bairro'] : $data['bairro'] = null ;  ?>" >
                                                <label>Cidade:</label>
                                                <input type="text" id="cidade" class="form-control" name="cidade" value="<?php (isset($data['cidade'])) ? $data['cidade'] : $data['cidade'] = null ; ?>" >
                                                <label>Estado:</label>
                                                <input type="text" id="uf"  class="form-control" name="estado" value="<?php (isset($data['estado'])) ? $data['estado'] : $data['estado'] = null ; ?>" >
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

                                                $readSes->FullRead("select * from salao s inner join salaoempresario se on s.idSalao = se.idSalao where se.idUsuario= :catid order by s.nomeSalao", "catid={$userlogin['idUsuario']}");
                                                     foreach ($readSes->getResult() as $ses):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


                                                        echo "<tr><td> {$ses['nomeSalao']} </td>
                                                              <td> {$ses['cnpjSalao']} </td>
                                                              
                                                              <td> {$ses['categoriaSalao']} </td>
                                                              <td> {$ses['logradouro']} {$ses['numero']}</td>
                                                              <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\">        
                                                                    <td>
                                                                        <a href=\"editarEmpresa.php?id={$ses['idSalao']}\"><button type=\"button\" class=\"btn btn-info\"><i class=\"fa  fa-pencil\"></i></button></a>
                                                                        <input type=\"hidden\" name=\"CadastroId\" value=\"{$ses['idSalao']}\">
                                                                        <input type=\"hidden\" name=\"nomeSalao\" value=\"{$ses['nomeSalao']}\">
                                                                        <button input name=\"DeleteSalao\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>
                                                                        <a href=\"perfilSalaoPublico.php?id={$ses['idSalao']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Salão</button></a>
                                                                    </td> 
                                                              </form>
                                                                  </tr>
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
<script>
    $(function() {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
    var input = $(this),
    numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {

    var input = $(this).parents('.input-group').find(':text'),
    log = numFiles > 1 ? numFiles + ' files selected' : label;

    if( input.length ) {
    input.val(log);
    } else {
    if( log ) alert(log);
    }

    });
    });

    });
    


    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="cadastroEmpresa.php?id=<?php print $idSalao;?>"
    };
    
    function Cancelar(){
        location.href="cadastroEmpresa.php"
    };
    
    
    </script>