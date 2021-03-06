<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$readMensagem = new Read();
$readMensagem->FullRead("Select * from mensagem m inner join usuario u on m.idRemetente=u.idUsuario where m.idDestinatario=:id and m.excluirDestinatario=0 order by m.data desc", "id={$userlogin['idUsuario']}");                    
                      
$readNaoLida = new Read();
$readNaoLida->FullRead("Select * from mensagem m inner join usuario u on m.idRemetente=u.idUsuario where m.idDestinatario=:id and situacaoRecebida=0 order by m.data desc", "id={$userlogin['idUsuario']}");
//var_dump($readNaoLida->getRowCount());


$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
/*
 * DELETE CERTICAÇÃO
 */

//Chamar a Modal.
if (isset($post) && array_key_exists("DeleteMensagem", $post)):
    unset($post['DeleteMensagem']);

    if (!empty($post['CadastroId'])):
    $idMensagem = $post['CadastroId'];
    endif;
    
    $_SESSION['userlogin']['DeleteMensagem'] = "ok";
    echo RentalModal("Excluir", "Tem certeza que deseja excluir as mensagens selecionadas?", "Cancelar", "Excluir", "Excluir");
endif;

/**
 * Condição * /
 */

if (array_key_exists('id', $_GET)):
       $string = $_GET;
       $CadastroId = explode("?",$string['id']);
       array_pop($CadastroId);       
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
if (isset($CadastroId) and isset($_SESSION['userlogin']['DeleteMensagem'])):
    unset($_SESSION['userlogin']['DeleteMensagem']);
    require('../../admin/_models/AdminMensagem.class.php');
    $post['excluirDestinatario']=1;
            
    $deleteMensagem = new AdminMensagem();    
    $deleteMensagem->ExeUpdate($CadastroId, $post);
    
    
    
    unset($_SESSION['userlogin']['$this->CadID']);
   
    if ($deleteMensagem->getError()):
        $_SESSION['userlogin']['msg'] = $deleteMensagem->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteMensagem->getError()[1];
    endif;

    echo "<script>location.href='caixademensagem.php';</script>";
endif;

    
?>


<section class="content-header">
      <h1>
        Caixa de Mensagens
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
 
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Pastas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href=""><i class="fa fa-inbox"></i> Recebidas
                  
                        <?php
                        if($readNaoLida->getRowCount()>0):
                         echo "<span class=\"label label-primary pull-right\"> {$readNaoLida->getRowCount()} </span></a></li>";
                        endif;
                        ?>
                  <li><a href="caixademensagemenviada.php"><i class="fa fa-envelope-o"></i> Enviadas</a></li>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recebidas</h3>

              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form name="PostForm" method="POST" enctype="multipart/form-data">  
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
               
                <div class="btn-group">
                  <button input name="DeleteMensagem" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  
                </div>
                <!-- /.btn-group -->
                
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                     <thead> 
                            <tr>
                                <th></th>
                                <th>Remetente</th>
                                <th>Assunto</th>
                                <th>Data e Horario </th>
                               
                            </tr>
                        </thead>
                 
                  <tbody>
                  <?php   
                  
                  foreach ($readMensagem->getResult() as $mensagem): 
                        if($mensagem['situacaoRecebida']==1):
                             echo "
                                <tr>
                                  <td><input type=\"checkbox\"  name=\"CadastroId[]\" value=\"{$mensagem['idMensagem']}\"></td>
                                  <td class=\"mailbox-name\"><a href=\"mensagemrecebida.php?msg={$mensagem['idMensagem']}&desr={$mensagem['idDestinatario']}\">{$mensagem['nomeUsuario']} {$mensagem['sobrenomeUsuario']}</a></td>
                                  <td class=\"mailbox-subject\">{$mensagem['assunto']} 
                                  </td>
                                  <td>";echo TimeStampParaData($mensagem['data']); echo"</td>                                      
                                </tr>";                      
                        else:
                            echo "
                                <tr>
                                  <td><b><input type=\"checkbox\" value=\"{$mensagem['idMensagem']}\"></b></td>
                                  <td class=\"mailbox-name\"><b><a href=\"mensagemrecebida.php?msg={$mensagem['idMensagem']}&desr={$mensagem['idDestinatario']}\">{$mensagem['nomeUsuario']} {$mensagem['sobrenomeUsuario']}</a></b></td>
                                  <td class=\"mailbox-subject\"><b> {$mensagem['assunto']}</b></td>
                                  <td><b>"; echo TimeStampParaData($mensagem['data']); echo "</b></td>
                                </tr>";
                        endif;
                    endforeach;
                  ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                
                <div class="btn-group">
                  <button input name="DeleteMensagem" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>                
                </div>
                <!-- /.btn-group -->
                
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                   
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
            </form>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<div class="row">
<?php 
 function TimeStampParaData($timeStamp){
        $date = new DateTime($timeStamp);
        return $date->format('d/m/Y H:i:s');
    }
    
include 'menuFooter.php';
?>

    

<script>

    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="caixademensagem.php?id=<?php 
        foreach ($idMensagem as $id):
            print $id."?";
        endforeach;
        ?>"
    };
    
    function Cancelar(){
        location.href="caixademensagem.php"
    };         
</script>