<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
require('../../admin/_models/AdminMensagem.class.php');
include 'menuHeader.php';

$idMensagem = $_GET['msg'];
$idDestinatario =  $_GET['desr'];

$readNaoLida = new Read();
$readNaoLida->FullRead("Select * from mensagem m inner join usuario u on m.idRemetente=u.idUsuario where m.idDestinatario=:id and situacaoRecebida=0", "id={$userlogin['idUsuario']}");

$readMensagem = new Read();
$readMensagem->FullRead("Select * From mensagem m inner join usuario u on m.idRemetente = u.idUsuario where m.idMensagem = {$idMensagem} and m.idDestinatario={$userlogin['idUsuario']}");

    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $data['situacaoRecebida'] = 1;
    $cadastra = new AdminMensagem();
    $cadastra->ExeUpdateLida($idMensagem, $data);
?>


<section class="content-header">
      <h1>
        Caixa de Mensagens
        
      </h1>
      
    </section>
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
                  <li><a href="caixademensagemenviada.php"><i class="fa fa-envelope-o"></i> Enviadas</a></li>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
          <!-- /.col -->
          <form name="PostForm" method="POST" enctype="multipart/form-data">  
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mensagem enviada</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>Assunto: <?php echo "{$readMensagem->getResult()[0]['assunto']}"; ?></h3>
                <h5>Remetente: <?php echo "{$readMensagem->getResult()[0]['nomeUsuario']}"; echo " "; echo "{$readMensagem->getResult()[0]['sobrenomeUsuario']}";?>
                  <span class="mailbox-read-time pull-right">Data Envio</span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                  <h3><?php echo "{$readMensagem->getResult()[0]['mensagem']}"; ?></h3>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                  <?php echo "<a href=\"respondermensagem.php?msg={$readMensagem->getResult()[0]['idMensagem']}&desr={$readMensagem->getResult()[0]['idRemetente']}&remr={$userlogin['idUsuario']}\">"?><button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Responder</button></a>
               
              </div>
              

            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
          </form>
        <!-- /.col -->
      </div>
          
</section>

<div class="row">
<?php include 'menuFooter.php'; ?>

    
        <script>

    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="mensagemrecebida.php?id=<?php print $idMensagem;?>";
        
    };
    
    function Cancelar(){
        location.href="mensagemrecebida.php"
    };         
</script>