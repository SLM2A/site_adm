<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($_GET['id'])):
    $idVaga = $_GET['id'];
    $_SESSION['userlogin']['idVagaAluguel'] = $idVaga;
    
    $readSes = new Read;
    $readSes->FullRead("select * from vagaaluguel va inner join salao s on va.idSalao=s.idSalao where idVagaAluguel = :id", "id={$idVaga}");
endif;



if (!empty($post['idFoto'])):
    $idFoto = $post['idFoto'];
endif;

/**
 * Condição * /
 */
if (array_key_exists('idFoto', $_GET)):
    $_SESSION['userlogin']['ModalPortfolioOk'] = "ok";
    $idFoto = $_GET['idFoto'];
endif;
//var_dump($idFoto);
//var_dump($_SESSION['userlogin']['ModalPortfolioOk']);


/**
 * DELETAR IMAGEM* /
 */
//Chamar a Modal.
if (isset($post) && array_key_exists("DeletePostForm", $post)):
    unset($post['DeletePostForm']);
    $idPort = $post['idFoto'];
    echo RentalModal("Excluir", "Tem certeza que deseja excluir a imagem", "Cancelar", "Excluir", "Excluir");
endif;

//Se na modal for clicado em excluir execulta o bloco abaixo 
if (!empty($_SESSION['userlogin']['ModalPortfolioOk'])):
    unset($_SESSION['userlogin']['ModalPortfolioOk']);
    require('../../admin/_models/AdminVagaAluguelImagem.class.php');
    $deleteGallery = new AdminVagaAluguelImagem();
    $deleteGallery->ExeDelete($idFoto);
    unset($_SESSION['userlogin']['idFoto']);

    if ($deleteGallery->getMsg()):
        $_SESSION['userlogin']['msg'] = $deleteGallery->getMsg()[0];
        $_SESSION['userlogin']['tipoMsg'] = $deleteGallery->getMsg()[1];
    endif;

    echo "<script>location.href='perfilVagaAluguelPublico.php?id={$_SESSION['userlogin']['idVagaAluguel']}';</script>";
endif;

?>
<!-- Plugin CSS -->
<link href="../../vendor/magnific-popup/magnific-popup.css" rel="stylesheet" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">-->
<section class="content-header">
  
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-lg-12 connectedSortable">
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="../dist/img/Aluguel_de_espaco_128x128.jpg" alt="User profile picture">

                                    <h3 class="profile-username text-center"><?php echo $readSes->getResult()[0]['nomeAnuncio'] ; echo " ";
                                            echo" <a href=\"editarVagaAluguel.php?id={$idVaga}\"><i class=\"fa  fa-pencil\"></i></a></h3>";
                                            
                                                ?>
                                            </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- Fim Profile Image -->

                        <!-- About Me Box -->
                        <div class="col-lg-6 connectedSortable">   
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-heart"></i> Sobre a Vaga</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
                                            <i class="fa fa-plus"></i></button>

                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body"  >
                                    <strong><i class="fa fa-book margin-r-5"></i>Profissão</strong>

                                    <p>
                                       <?php echo $readSes->getResult()[0]['profissao'] ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i> Forma de Aluguel</strong>
                                    <p>
                                        <?php echo $readSes->getResult()[0]['formaAluguel'] ?>
                                        
                                    </p>
                                    <hr>						  
                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Preço do Aluguel</strong>
                                    <p>
                                    R$ <?php echo $readSes->getResult()[0]['preco'] ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-book margin-r-5"></i> O que está sendo alugado</strong>

                                    <p>
                                        <?php echo $readSes->getResult()[0]['itemAlugado'] ?>
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div
                        <!-- Fim About Me Box -->	
                         <div class="col-lg-6 connectedSortable">   
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-building"></i> Sobre o Salão</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
                                            <i class="fa fa-plus"></i></button>

                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" >
                                    <strong><i class="fa fa-book margin-r-5"></i> Salão</strong>

                                    <p>
                                         <?php echo" <a href=\"perfilSalaoPublico.php?id={$readSes->getResult()[0]['idSalao']}\">"; echo $readSes->getResult()[0]['nomeSalao']; echo "</a>"; ?> 
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i> Tamanho do Espaço</strong>
                                    <p>
                                        <?php echo $readSes->getResult()[0]['tamanho'] ?>
                                    </p>
                                    <hr>						  
                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Dias de Funcionamento</strong>
                                    <p>
                                        <?php echo $readSes->getResult()[0]['diaFuncionamento'] ?>
                                    </p>        
                                    <hr>
                                    <strong><i class="fa fa-book margin-r-5"></i> Horário de funcionamento</strong>
                                    <p>                                        
                                        <?php echo $readSes->getResult()[0]['horarioFuncionamento'] ?>
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- Inicio Minhas Experiências -->	
                        <div class="col-lg-12 connectedSortable">   
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion-person"></i> Informações Gerais</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
                                            <i class="fa fa-plus"></i></button>

                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body"  style="display: none;">
                                    <strong><i class="fa fa-book margin-r-5"></i> Características</strong>

                                    <p>
                                        <?php echo $readSes->getResult()[0]['caracteristica'] ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i> Diferencial</strong>
                                    <p>
                                        <?php echo $readSes->getResult()[0]['diferencial'] ?>                                      
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    
                        
                         <?php
//Inicio Busca Candidatura para Vagas de Alguel
    $readProfissional = new Read();

    $readProfissional->FullRead("SELECT * FROM vagaaluguelcandidatada vac inner join vagaaluguel va on vac.idVagaAluguel=va.idVagaAluguel inner join usuario u on u.idUsuario = vac.idUsuarioProfissional inner join salao s on va.idSalao=s.idSalao where va.idVagaAluguel = {$idVaga}");



//Fim Busca Candidatura para Vagas de Alguel


    echo "
                        <div class=\"col-md-12\">
    <div class=\"box box-primary\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><i class=\"fa fa-handshake-o\"></i> Candidatos</h3>
                   
                <div class=\"box-tools pull-right\">
                    <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Minimizar\">
                        <i class=\"fa fa-minus\"></i></button>

                </div>

            </div>
            
        
        <div class=\"box-body table-responsive no-padding\" >
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                    
                                                    <th>Profissional</th>
                                                    <th>Sexo</th>
                                                    <th>E-mail</th>
                                                   
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


    foreach ($readProfissional->getResult() as $profissional):
//                                  

        echo "</td>
                                                        
                                                            <td> <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>";

        if ($profissional['sexoUsuario'] == null):
            echo " <td>Não Informado</td> ";
        else:
            echo " <td> {$profissional['sexoUsuario']} </td> ";
        endif;


        if ($profissional['situacao'] == 1):
            echo " <td>{$profissional['email']} </td> ";
        else:
            echo "<td>Aguardando aceitação do profissional<td> ";
        endif;


        echo "
                                                           
                                                               </tr>
                                                        ";

    endforeach;
    echo "       
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    </div>
    
    ";
    ?>
                        
    <?php
//Inicio Busca Candidatura para Vagas de Alguel
    $readImagem = new Read();

    $readImagem->FullRead("SELECT * FROM imagemvagaaluguel iva inner join vagaaluguel va on iva.idVagaAluguel=va.idVagaAluguel where iva.idVagaAluguel = {$idVaga}");
    

//Fim Busca Candidatura para Vagas de Alguel
 


echo "
  <div class=\"col-md-12\">
    <div class=\"box box-primary\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><i class=\"fa fa-camera\"></i> Fotos da Vaga</h3>
                   
                <div class=\"box-tools pull-right\">
                    <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Minimizar\">
                        <i class=\"fa fa-minus\"></i></button>

                </div>

            </div>
            
        
        <div class=\"box-body table-responsive no-padding\" >
            <div class=\"box-body table-responsive no-padding\">
             <div class=\"popup-gallery\">

                                   ";

if (!empty($readImagem)) {
    foreach ($readImagem->getResult() as $fotos):
        $post['idFoto'] = $fotos['idFoto'];
        echo "
                <div class=\"col-lg-3 connectedSortable\">
                    <div class=\"box box-primary\">
                        <div class=\"mailbox-attachment-info\">
                            <div class=\"mailbox-attachment-info\">
                                <span class=\"mailbox-attachment-icon has-img\">
                                    <a href=\"../uploads/{$fotos['fotoGrande']}\" class=\"portfolio-box\">
                                        <img src=\"../uploads/{$fotos['fotoPequena']}\" alt=\"Attachment\" class=\"img-responsive\">
                                    </a>
                                </span>
                                
                <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\"><p></p>
                            
                                <center>
                                    <input type=\"hidden\" name=\"idFoto\" value=\"{$fotos['idFoto']}\">
                                    <button input class=\"btn btn-app\" name=\"DeletePostForm\"><i class=\"fa fa-trash-o\"></i> Delete </button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
           
                                    </div>";
    endforeach;
}
echo "</div>";
?>

                 
                        
                        
                        
                </section>
<div class="row">
<?php include 'menuFooter.php'; ?>

    <!-- GALERIA IMAGEM ABERTA INICIO-->
                                <script src="../../vendor/scrollreveal/scrollreveal.min.js"></script>
                                <script src="../../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
                                <script src="../../js/creative.js"></script>
                                <!-- GALERIA IMAGEM ABERTA FIM -->



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
                                                    $(document).ready(function() {
                                            $(':file').on('fileselect', function(event, numFiles, label) {

                                            var input = $(this).parents('.input-group').find(':text'),
                                                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                                                    if (input.length) {
                                            input.val(log);
                                            } else {
                                            if (log) alert(log);
                                            }

                                            });
                                            });
                                            });
                                            $(document).ready(function () {
                                    $('#myModal').modal('show');
                                    });
                                            function Excluir(){
                                            location.href = "perfilVagaAluguelPublico.php?idFoto=<?php print $idFoto; ?>"
                                            };
                                            function Cancelar(){
                                            location.href = "portfolio.php"
                                            };

                                </script>