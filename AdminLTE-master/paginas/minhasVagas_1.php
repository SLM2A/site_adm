<?php 
require_once('../../_app/Config.inc.php');
require_once('../../_app/Includes.php');
include 'menuHeader.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//Chamar a Modal.
if (isset($post) && array_key_exists("DeleteAluguel", $post)):
    unset($post['DeleteAluguel']);
    $idPort = $post['CadastroId'];
    $_SESSION['userlogin']['DeleteAluguel'] = "ok";
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a Vaga: {$post['nomeAnuncio']}?", "Cancelar", "Excluir", "Excluir");
endif;

if (isset($post) && array_key_exists("DeleteEmprego", $post)):
    unset($post['DeleteEmprego']);
    $idPort = $post['CadastroId'];
    $_SESSION['userlogin']['DeleteEmprego'] = "ok";
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a Vaga: {$post['nomeAnuncio']}?", "Cancelar", "Excluir", "Excluir");
endif;

/**
 * Condição * /
 */
if (array_key_exists('id', $_GET)):
    $_SESSION['userlogin']['ModalPortfolioOk'] = "ok";
    $CadastroId = $_GET['id'];
    else:
        unset($_SESSION['userlogin']['DeleteAluguel']);
        unset($_SESSION['userlogin']['DeleteEmprego']);
endif;

if (!empty($_SESSION['userlogin']['msg'])):
    RentalErro($_SESSION['userlogin']['msg'], $_SESSION['userlogin']['tipoMsg']);
    $_SESSION['userlogin']['msg'] = '';
    $_SESSION['userlogin']['tipoMsg'] = '';
endif;

/**
 * DELETAR MENSSAGEM* /
 */


//Se na modal for clicado em excluir executa o bloco abaixo 
if (!empty($_SESSION['userlogin']['ModalPortfolioOk'])):
    unset($_SESSION['userlogin']['ModalPortfolioOk']);
    require('../../admin/_models/AdminVagaAluguel.php');
    $deleteAluguel = new AdminVagaAluguel();
    
    $deleteAluguel->ExeDelete($CadastroId);
    
    unset($_SESSION['userlogin']['$this->CadID']);
   
    if ($deleteAluguel->getError()):
        $_SESSION['userlogin']['msg'] = $deleteAluguel->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteAluguel->getError()[1];
    endif;

    echo "<script>location.href='minhasVagas.php';</script>";
endif;


?>

<section class="content-header">
                    <h1> <i class="ion-briefcase"></i> Minhas Vagas</h1>  
                </section>

                <!-- Main content -->
                <section class="content">

                        <section class="col-lg-12 connectedSortable ">
                         <a href="EscolhaTipoVaga.php"><button type="button" class="btn btn-block btn-success btn-lg"><i class="fa fa-plus"></i> Cadastrar Vaga</button></a>
                        </section>
                     <!--Tabela listando Vagas de Aluguel-->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Vagas de Aluguel</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <thead> 
                                                <tr>
                                                    <th>Nome do Anúncio</th>
                                                    <th>Profissão</th>
                                                    <th>Forma de Aluguel</th>
                                                    <th>Preço</th>
                                                    <th>Salão</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $readSes = new Read;
                                                $readSes->FullRead("select * from vagaaluguel va inner join salao s on va.idSalao = s.idSalao inner join salaoempresario se on s.idSalao = se.idSalao where se.idUsuario= :catid order by s.nomeSalao" , "catid={$userlogin['idUsuario']}");
                                                foreach ($readSes->getResult() as $ses):
                                                    echo "<tr><td> {$ses['nomeAnuncio']} </td>
                                                              <td> {$ses['profissao']} </td>                                                              
                                                              <td> {$ses['formaAluguel']} </td>
                                                              <td> {$ses['preco']} </td>
                                                              <td> {$ses['idVagaAluguel']} </td>
                                                              <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\">    
                                                              <td><a href=\"editarVagaAluguel.php?id={$ses['idVagaAluguel']}\"><button type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-pencil\"></i></button></a>
                                                                  <input type=\"hidden\" name=\"CadastroId\" value=\"{$ses['idVagaAluguel']}\">
                                                                  <input type=\"hidden\" name=\"nomeAnuncio\" value=\"{$ses['nomeAnuncio']}\">
                                                                  <button input name=\"DeleteAluguel\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>
                                                                  <a href=\"perfilVagaAluguelPublico.php?id={$ses['idVagaAluguel']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
                                                              </td></tr>
                                                              </form>
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
                        
                        <!--Tabela listando Vagas de Emprego-->
                         <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Vagas de Emprego</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <thead> 
                                                <tr>
                                                    <th>Nome do Anúncio</th>
                                                    <th>Profissão</th>
                                                    <th>Nível</th>
                                                    <th>Contratação</th>
                                                    <th>Nº Vagas</th>
                                                    <th>Salão</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $readSes = new Read;

                                                $readSes->FullRead("select * from vagaemprego ve inner join salao s on ve.idSalao = s.idSalao inner join salaoempresario se on s.idSalao = se.idSalao where se.idUsuario= :catid order by s.nomeSalao", "catid={$userlogin['idUsuario']}");
                                                foreach ($readSes->getResult() as $ses):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


                                                    echo "<tr><td> {$ses['tituloVaga']} </td>
                                                              <td> {$ses['profissao']} </td>
                                                              <td> {$ses['nivel']} </td>
                                                              <td> {$ses['vinculoEmpregaticio']} </td>
                                                              <td> {$ses['numeroVagas']} </td>
                                                              <td> {$ses['nomeSalao']} </td>
                                                              <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\">    
                                                              <td><a href=\"editarVagaEmprego.php?id={$ses['idVagaEmprego']}\"><button type=\"button\" class=\"btn btn-info\"><i class=\"fa  fa-pencil\"></i></button></a>
                                                                  <input type=\"hidden\" name=\"CadastroId\" value=\"{$ses['idVagaEmprego']}\">
                                                                  <input type=\"hidden\" name=\"nomeAnuncio\" value=\"{$ses['tituloVaga']}\">
                                                                  <button input name=\"DeleteEmprego\" class=\"btn btn-danger btn-flat\"><i class=\"fa fa-trash-o\"></i></button>
                                                                  <a href=\"perfilVagaAluguelPublico.php?id={$ses['idVagaEmprego']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
                                                              </td></tr>
                                                              </form>
                                                                  


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
                        
                    </form>
                    
                    
                </section>
<div class="row">
<?php include 'menuFooter.php'; ?> 
    
<script>
    $(document).ready(function () {
            $('#myModal').modal('show');
    });
    
    function Excluir(){
        location.href="minhasVagas.php?id=<?php print $idPort;?>"
    };
    
    function Cancelar(){
        location.href="teste.php"
    };
</script>