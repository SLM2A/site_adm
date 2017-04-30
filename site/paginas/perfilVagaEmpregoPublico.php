<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idVaga = $_GET['id'];

$readSes = new Read;
$readSes->FullRead("select * from vagaemprego ve inner join salao s on ve.idSalao=s.idSalao where idVagaEmprego = :id", "id={$idVaga}");
?>

<section class="content-header">

</section>

<!-- Main content -->
<section class="content">
    <section class="col-lg-12 connectedSortable">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="../dist/img/salao_default.jpg" alt="User profile picture">

                <h3 class="profile-username text-center"><?php
echo $readSes->getResult()[0]['tituloVaga'];
echo " ";
echo"     <a href=\"editarVagaEmprego.php?id={$idVaga}\"><i class=\"fa  fa-pencil\"></i></a>";
?></h3>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- Fim Profile Image -->

    <!-- About Me Box -->
    <section class="col-lg-6 connectedSortable">   
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-heart"></i> Sobre a Vaga</h3>
                
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
                        <i class="fa fa-plus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body"  style="display: none;">
                <strong><i class="fa fa-book margin-r-5"></i>Profissão</strong>

                <p>
                    <?php echo $readSes->getResult()[0]['profissao'] ?>
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Nível</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['nivel'] ?>

                </p>
                <hr>						  
                <strong><i class="fa fa-map-marker margin-r-5"></i> Forma de contratação</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['vinculoEmpregaticio'] ?>
                </p>
                <hr>
                <strong><i class="fa fa-book margin-r-5"></i> Número de Vagas</strong>

                <p>
                    <?php echo $readSes->getResult()[0]['numeroVagas'] ?>
                </p>
                <hr>
            </div>
        </div>
    </section>
    <!-- Fim About Me Box -->	
    <section class="col-lg-6 connectedSortable">   
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-building"></i> Sobre o Salão</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
                        <i class="fa fa-plus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body"  style="display: none;">
                <strong><i class="fa fa-book margin-r-5"></i> Salão</strong>

                <p>
                    <?php echo $readSes->getResult()[0]['nomeSalao'] ?>
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Localização</strong>
                <p>
                    <?php
                    echo $readSes->getResult()[0]['logradouro'];
                    echo ", ";
                    echo $readSes->getResult()[0]['numero'];
                    echo " - ";
                    echo $readSes->getResult()[0]['bairro'];
                    echo " - ";
                    echo $readSes->getResult()[0]['cep'];
                    echo " - ";
                    echo $readSes->getResult()[0]['cidade'];
                    echo " - ";
                    echo $readSes->getResult()[0]['estado'];
                    ?>
                </p>
                <hr>						  
                <strong><i class="fa fa-book margin-r-5"></i> Faixa de Remuneração</strong>

                <p>
<?php echo $readSes->getResult()[0]['faixaRemuneracao'] ?>
                </p>
                <hr>
                <strong><i class="fa fa-book margin-r-5"></i> Comissão</strong>

                <p>
<?php echo $readSes->getResult()[0]['comissao'] ?>
                </p>
                <hr>
            </div>
        </div>
    </section>
    <!-- Inicio Minhas Experiências -->	
    <section class="col-lg-12 connectedSortable">   
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="ion-person"></i> Informações Gerais</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Maximizar">
                        <i class="fa fa-plus"></i></button>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">

                <strong><i class="fa fa-pencil margin-r-5"></i> Descrição</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['descricaoOportunidade'] ?>                                      
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Requisitos do Candidato</strong>
                <p>
                    <?php echo $readSes->getResult()[0]['requisitoCandidato'] ?>                                      
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Diferenciais</strong>
                <p>
    <?php echo $readSes->getResult()[0]['diferencialCandidato'] ?>                                      
                </p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> Benefícios</strong>
                <p>
    <?php echo $readSes->getResult()[0]['beneficioCandidato'] ?>                                      
                </p>
            </div>
        </div>
    </section>
    
    <?php
//Inicio Busca Candidatura para Vagas de Alguel
    $readProfissional = new Read();

    $readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego inner join usuario u on u.idUsuario = uc.idUsuarioProfissional inner join salao s on ve.idSalao=s.idSalao where ve.idVagaEmprego = {$idVaga}");



//Fim Busca Candidatura para Vagas de Alguel


    echo "
                        <div class=\"col-md-12\">
    <div class=\"box box-primary\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><i class=\"fa fa-handshake-o\"></i> Candidatos convidados</h3>
                   
                <div class=\"box-tools pull-right\">
                    <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Minimizar\">
                        <i class=\"fa fa-minus\"></i></button>

                </div>

            </div>
            
        
        <div class=\"box-body table-responsive no-padding\">
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
    $readProfissional = new Read();

    $readProfissional->FullRead("SELECT * FROM vagaempregocandidata vec inner join vagaemprego ve on vec.idVagaEmprego=ve.idVagaEmprego inner join usuario u on u.idUsuario = vec.idUsuarioProfissional inner join salao s on ve.idSalao=s.idSalao where ve.idVagaEmprego = {$idVaga}");



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


</section>
<div class="row">
<?php include 'menuFooter.php'; ?>