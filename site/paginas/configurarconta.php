<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';
$ReadUsuario = new Read();
$ReadUsuario->FullRead("SELECT * FROM usuario WHERE idUsuario={$userlogin['idUsuario']}");

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!$ReadUsuario->getResult()):
    RentalErro("Sua conta foi excluida com sucesso!",RENTAL_ACCEPT);
    
    unset($_SESSION['userlogin']);
    echo "<script>location.href='../../index.php'</script>)";
endif; 

//Chamar a Modal.
if (isset($data) && array_key_exists("DeleteConta", $data)):
    unset($data['DeleteConta']);
    echo RentalModal("Excluir", "{$userlogin['nomeUsuario']} {$userlogin['sobrenomeUsuario']} tem certeza que deseja excluir sua conta? é uma pena <i class=\"fa fa-frown-o\"></i>", "Cancelar", "Excluir", "Excluir");
endif;

//Mensagem
if (!empty($_SESSION['userlogin']['msg'])):    
    $_SESSION['userlogin']['msg'] = '';
    $_SESSION['userlogin']['tipoMsg'] = '';
endif;

if (array_key_exists('idDelete', $_GET) and $_GET['idDelete'] == $userlogin['idUsuario']):
    unset($data['DeleteConta']);
    require '../../admin/_models/SiteRegistrar.class.php';
   
    $cadastra = new SiteRegistrar();
    $cadastra->ExeDelete($userlogin['idUsuario']);
    
    echo "<script>location.href='configurarconta.php';</script>";
endif;

if (!empty($data['AlterarSenha'])):
    unset($data['AlterarSenha']);
    require '../../admin/_models/SiteRegistrar.class.php';
    
    $data['senhaantiga'] = md5($data['senhaantiga']);
   
    
    if($data['senhaantiga'] == $userlogin['senha']): 
        if ($data['confirma'] == $data['senha']):
            unset($data['confirma']);
            unset($data['senhaantiga']);
            $data['senha'] = md5($data['senha']);
            $cadastra = new SiteRegistrar();
            $cadastra->ExeUpdate($userlogin['idUsuario'],$data);
            RentalErro("Senha Alterada com Sucesso!", RENTAL_ACCEPT); 
        else:
            RentalErro("Senha antiga não confere", RENTAL_ALERT); 
        endif;
    else:
        RentalErro("Senha antiga não confere", RENTAL_ALERT);
    endif;
    
 
    //echo "<script>location.href='configurarconta.php';</script>";
    
endif;

?>

<section class="content-header">
    <h1> <i class="fa fa-cog"></i> Configurações</h1>   
</section>

    <!-- Main content -->
    
<section class="content">
    <form name="PostForm" method="POST" enctype="multipart/form-data">

        <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">                  
                            <li class="pull-left header"><i class="fa fa-edit"></i> Alterar Senha</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->
                            <div class="box-body" >
                                
                                <label>Senha antiga:</label>
                                <input type="password" maxlength=60 class="form-control" name="senhaantiga" id="senhaantiga" value="<?php (!isset($data)) ? $data['senhaantiga'] : NULL ; ?>" required>
				<label>Nova senha:</label>
                                <input type="password" maxlength=60 class="form-control" name="senha" id="senha" value="<?php (!isset($data)) ? $data['senha']: NULL; ?>" required>
				<label>Confirme a nova senha:</label>
                                <input type="password" maxlength=60 class="form-control" name="confirma" id="confirma" value="<?php (!isset($data)) ? $data['confirma']: NULL; ?>" required>
                            </div>
                            <div class="box-footer" style="height: 70px;">
                                <section class="col-lg-12 connectedSortable ">
                                    <button input type="submit" class="btn btn-block btn-success btn-lg" value="Alterar" name="AlterarSenha"><i class="fa fa-check"></i> Alterar Senha</button>
                                </section>
                           </div>   
  
                        </div>
                    </div>
                </section>
    </form>  
        <form name="PostForm" method="POST" enctype="multipart/form-data">
    <!-- Excluir Conta -->
    <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">                  
                            <li class="pull-left header"><i class="fa fa-times"></i> Excluir conta</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->
                            
                            <div class="box-footer" style="height: 70px;">
                                <section class="col-lg-12 connectedSortable ">
                                   <button input type="submit" class="btn btn-block btn-danger btn-lg" value="Deletar" name="DeleteConta"><i class="fa fa-times"></i> Excluir Conta</button>
                                </section>
                           </div>   
  
                        </div>
                    </div>
                </section>
    
       
       
        </div>
        
        
        
    </form>    

           
</section>
<div class="row">
<?php include 'menuFooter.php'; ?>

<script>

    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="configurarconta.php?idDelete=<?php print $userlogin['idUsuario'];?>"
    };
    
    function Cancelar(){
        location.href="configurarconta.php"
    };         
</script>