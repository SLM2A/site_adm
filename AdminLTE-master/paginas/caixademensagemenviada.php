<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$readNaoLida = new Read();
$readNaoLida->FullRead("Select * from mensagem m inner join usuario u on m.idRemetente=u.idUsuario where m.idDestinatario=:id and situacaoRecebida=0 order by m.data desc ", "id={$userlogin['idUsuario']}");
//var_dump($readNaoLida->getRowCount());
$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
/*
 * DELETE CERTICAÇÃO
 */

//Chamar a Modal.
if (isset($post) && array_key_exists("DeleteMensagem", $post)):
    unset($post['DeleteMensagem']);
    $idMensagem = $post['CadastroId'];
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
    $post['excluirRemetente']=1;
            
    $deleteMensagem = new AdminMensagem();    
    $deleteMensagem->ExeUpdate($CadastroId, $post);
    
    
    
    unset($_SESSION['userlogin']['$this->CadID']);
   
    if ($deleteMensagem->getError()):
        $_SESSION['userlogin']['msg'] = $deleteMensagem->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteMensagem->getError()[1];
    endif;

    //echo "<script>location.href='caixademensagemenviada.php';</script>";
endif;


?>


<section class="content-header">
      <h1>
        Caixa de Mensagens
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Caixa de Mensagens</li>
      </ol>
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
                  <li><a href="caixademensagem.php"><i class="fa fa-inbox"></i> Recebidas
                  <?php
                        if($readNaoLida->getRowCount()>0):
                         echo "<span class=\"label label-primary pull-right\"> {$readNaoLida->getRowCount()} </span></a></li>";
                        endif;
                        ?>
                <li class="active"><a href="#"><i class="fa fa-envelope-o"></i> Enviadas</a></li>
                
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
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                      
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
                                <th>Destinatário</th>
                                <th>Assunto</th>
                                <th>Data e Horário</th>
                               
                            </tr>
                        </thead>
                    <?php 
                        
                        $readMensagem = new Read();
                        $readMensagem->FullRead("Select * from mensagem m inner join usuario u on m.idDestinatario=u.idUsuario where m.idRemetente=:id and excluirRemetente=0 order by m.data desc", "id={$userlogin['idUsuario']}");                    
                       // var_dump($readMensagem->getResult());
                        ?>
                  <tbody>
                  <?php   
                  
                  foreach ($readMensagem->getResult() as $mensagem):
                        echo "
                        <tr>
                          <td><input type=\"checkbox\" name=\"CadastroId[]\" value=\"{$mensagem['idMensagem']}\"></td>
                              
                          <td class=\"mailbox-name\"><a href=\"mensagemenviada.php?msg={$mensagem['idMensagem']}&desr={$mensagem['idDestinatario']}\">{$mensagem['nomeUsuario']} {$mensagem['sobrenomeUsuario']}</a></td>
                          <td class=\"mailbox-subject\"><b> {$mensagem['assunto']}</b> 
                          </td>
                          
                          <td>";echo TimeStampParaData($mensagem['data']); echo"</td>
                        </tr>
                        
                        ";
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
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
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

include 'menuFooter.php'; ?>

<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<script>

    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="caixademensagemenviada.php?id=<?php 
        foreach ($idMensagem as $id):
            print $id."?";
        endforeach;
        ?>"
    };
    
    function Cancelar(){
        location.href="certificacao.php"
    };         
</script>