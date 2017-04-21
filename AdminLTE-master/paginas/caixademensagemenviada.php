<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$readNaoLida = new Read();
$readNaoLida->FullRead("Select * from mensagem m inner join usuario u on m.idRemetente=u.idUsuario where m.idDestinatario=:id and situacaoRecebida=0", "id={$userlogin['idUsuario']}");
//var_dump($readNaoLida->getRowCount());

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

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Buscar Mensagem">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
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
                        $readMensagem->FullRead("Select * from mensagem m inner join usuario u on m.idRemetente=u.idUsuario where m.idRemetente=:id  order by m.data", "id={$userlogin['idUsuario']}");                    
                        
                        ?>
                  <tbody>
                  <?php   
                  
                  foreach ($readMensagem->getResult() as $mensagem):
                        echo "
                        <tr>
                          <td><input type=\"checkbox\" value=\"{$mensagem['idMensagem']}\"></td>
                          <td class=\"mailbox-name\"><a href=\"mensagemenviada.php?msg={$mensagem['idMensagem']}&desr={$mensagem['idDestinatario']}\">{$mensagem['nomeUsuario']} {$mensagem['sobrenomeUsuario']}</a></td>
                          <td class=\"mailbox-subject\"><b> {$mensagem['assunto']}</b> 
                          </td>
                          <td>";echo TimeStampParaData($mensagem['data']); echo"</td>
                        </tr>";
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
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
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