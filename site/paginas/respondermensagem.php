<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idUsuarioEnviando = $_GET['remr'];
$idUsuarioRecebendo = $_GET['desr'];
$idMensagem = $_GET['msg'];

$readMensagem = new Read();
$readMensagem->FullRead("Select * From mensagem where idMensagem=$idMensagem");

$readEnviando = new Read();
$readEnviando->FullRead("Select * from usuario where idUsuario=:Enviado", "Enviado={$idUsuarioEnviando}");


$readRecebendo = new Read();
$readRecebendo->FullRead("Select * from usuario where idUsuario=:Recebendo", "Recebendo={$idUsuarioRecebendo}");


$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    $data['idRemetente'] = $idUsuarioEnviando;
    $data['idDestinatario'] = $idUsuarioRecebendo;
    $data['assunto']= $readMensagem->getResult()[0]['assunto'];
    $data['situacaoEnviada'] = 0;
    $data['situacaoRecebida'] = 0;
    $data['excluirRemetente'] = 0;
    $data['excluirDestinatario'] = 0;
    
    require '../../admin/_models/AdminMensagem.class.php';
    $cadastra = new AdminMensagem();
    $data['data'] = date('Y-m-d H:i:s'); 
    $cadastra->ExeCreate($data);
    
    
    if (!$cadastra->getResult()):
        WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        echo "<script>location.href='caixademensagem.php';</script>";
    endif;
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
<section class="content">,
    <form role="form" action="" method="post" class="login-form">
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
                        <h3 class="box-title">Escrever mensagem</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Resposta para: <h3><img src="../dist/img/userpadrao.png" class="user-image" alt="User Image" style="width: 30px; height: 30px;"><?php echo "{$readRecebendo->getResult()[0]['nomeUsuario']}";
                                echo " ";
                                echo "{$readRecebendo->getResult()[0]['sobrenomeUsuario']}"; ?></h3></label>
                                
                                           
                            
                        </div>
                        <div class="form-group">
                             <label>Assunto: <h4><?php echo "{$readMensagem->getResult()[0]['assunto']}";?></h4></label>
                            
                        </div>
                        <div class="box-body pad">
                                    <textarea class="textarea" maxlength=250 placeholder="Escreva sua mensagem..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                              name="mensagem" value="<?php if (isset($data)) echo $data['mensagem']; ?>"></textarea>
                         </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary" value="Cadastrar" name="SendPostForm"><i class="fa fa-envelope-o" ></i> Enviar</button>
                        </div>
                       <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Descartar</button></a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </form>
</section>


<div class="row">
    <?php include 'menuFooter.php'; ?>