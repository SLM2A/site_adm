<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idSalao = $_GET['id'];

$readSes = new Read;
$readSes->FullRead("select * from salao s inner join salaoempresario se on s.idSalao=se.idSalao where s.idSalao = :id", "id={$idSalao}");
//var_dump($readSes->getResult());
$readProprietario = new Read();
$readProprietario->FullRead("select * from salao s inner join salaoempresario se on s.idSalao=se.idSalao inner join usuario u on u.idUsuario=se.idUsuario where s.idSalao = :id", "id={$idSalao}");
?>

<section class="content-header">
        <h1> <i class="fa fa-university"></i> <?php echo "{$readSes->getResult()[0]['nomeSalao']}";?></h1>  
    </section>

    <!-- Main content -->
    
    <section class="content">
             
      <section class="col-lg-3 connectedSortable">
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <?php 
                                    if ($readSes->getResult()[0]['avatar']==''):
                                        echo "<img class=\"profile-user-img img-responsive img-circle\" src=\"../dist/img/salao_default.jpg\" alt=\"User profile picture\">";
                                    else:
                                        echo "<img class=\"profile-user-img img-responsive img-circle\" src=\"../uploads/{$readSes->getResult()[0]['avatar']} \" alt=\"User profile picture\">";
                                    endif;        ?>
                                    <h3 class="profile-username text-center"><?php echo $readSes->getResult()[0]['nomeSalao'] ?></h3>
                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i>Categoria</strong>
                                    <p>
                                        <?php echo $readSes->getResult()[0]['categoriaSalao'] ?>
                                    </p>
                                    <hr>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- Fim Profile Image -->

                        <!-- About Me Box -->
                        <section class="col-lg-9 connectedSortable">   
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="ion-person"></i> Sobre o Salão</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-book margin-r-5"></i> Descrição</strong>

                                    <p>
                                       <?php echo $readSes->getResult()[0]['descricaoSalao'] ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-pencil margin-r-5"></i> Nome do Proprietário</strong>
                                    <p>
                                        <?php echo $readProprietario->getResult()[0]['nomeUsuario']; echo " "; echo $readProprietario->getResult()[0]['sobrenomeUsuario']; ?>
                                        
                                    </p>
                                    <hr>						  
                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Localidade</strong>
                                    <p>
                                        <?php echo $readSes->getResult()[0]['logradouro']; echo ","; $readSes->getResult()[0]['numero']; echo " - ";
                                        echo $readSes->getResult()[0]['cep']; echo " - "; echo $readSes->getResult()[0]['bairro']; 
                                        echo " - "; echo $readSes->getResult()[0]['cidade']; echo " - "; echo $readSes->getResult()[0]['estado']; ?>
                                    </p>

                                </div>
                            </div>
                        </section>
                        <!-- Fim About Me Box -->	

                        <!-- Inicio Minhas Experiências -->	
                        <section class="col-md-12">	
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="ion-briefcase"></i> Vagas de Aluguel Disponíveis </h3>

                                        
                                </div>

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

                                                $readSes->FullRead("select * from vagaaluguel va inner join salao s on va.idSalao = s.idSalao where va.idSalao = :catid order by s.nomeSalao" , "catid={$idSalao}");
                                                
                                                if($readSes->getResult()):
                                                        foreach ($readSes->getResult() as $ses):
        //                                                        echo "<option value=\"{$ses['idSalao']}\" ";


                                                            echo "<tr><td> {$ses['nomeAnuncio']} </td>
                                                                      <td> {$ses['profissao']} </td>
                                                                      <td> {$ses['formaAluguel']} </td>
                                                                      <td> {$ses['preco']} </td>
                                                                      <td> {$ses['nomeSalao']} </td>
                                                                          <td>   <div class=\"btn-group\">
                                                                            <a href=\"perfilVagaAluguelPublico.php?id={$ses['idVagaAluguel']}\"><button type=\"button\" class=\"btn btn-info\">Ir Para Vaga</button></a>


                                                                          </div></td></tr>
                                                                ";

                                                        endforeach;
                                                else:
                                                    echo "<tr><td>NÃO EXISTEM VAGAS CADASTRADAS!</tr></td>";
                                                endif;        
                                                ?>
                                            </tbody>  
                                        </table>
                                </div>
                            </div>
                        </section> 
                        <!-- Fim Minhas Experiências -->	

                        <!-- Inicio Minhas Experiências -->	
                        <section class="col-md-12">	
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="ion-ios-bookmarks"></i> Vagas de Emprego Disponíveis</h3>


                                </div>

                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                            <thead> 
                                                <tr>
                                                    <th>Nome do Anúncio</th>
                                                    <th>Profissão</th>
                                                    <th>Nível</th>
                                                    <th>Contratação</th>
                                                    <th>Nº Vagas</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $readSes = new Read;

                                                $readSes->FullRead("select * from vagaemprego ve inner join salao s on ve.idSalao = s.idSalao where ve.idSalao = :catid order by s.nomeSalao", "catid={$idSalao}");
                                                
                                                if($readSes->getResult()):
                                                    foreach ($readSes->getResult() as $ses):
    //                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                                                        echo "<tr><td> {$ses['tituloVaga']} </td>
                                                                  <td> {$ses['profissao']} </td>
                                                                  <td> {$ses['nivel']} </td>
                                                                  <td> {$ses['vinculoEmpregaticio']} </td>
                                                                  <td> {$ses['numeroVagas']} </td>
                                                                      <td>   <div class=\"btn-group\">
                                                                        <a href=\"perfilVagaEmpregoPublico.php?id={$ses['idVagaEmprego']}\"><button type=\"button\" class=\"btn btn-info\">Ir Para Vaga</button></a>


                                                                      </div></td></tr>
                                                            ";


                                                    endforeach;
                                                else:
                                                    echo "<tr><td>NÃO EXISTEM VAGAS CADASTRADAS!</tr></td>";
                                                endif;     
                                                ?>
                                            </tbody>  
                                        </table>
                                </div>
                            </div>
                        </section> 
                        <!-- Fim Minhas Experiências -->

		
    </section>
    <div class="row">

<?php include 'menuFooter.php'; ?>