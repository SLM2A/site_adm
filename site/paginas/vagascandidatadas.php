<?php
require_once('../../_app/Config.inc.php');
require_once('../../_app/Includes.php');
include 'menuHeader.php';

//Inicio Busca Candidatura para Vagas de Alguel
$readVagaAluguel = new Read();
$readVagaAluguel->FullRead("Select * From vagaaluguelcandidatada vac inner join "
        . "vagaaluguel va on vac.idVagaAluguel=va.idVagaAluguel inner join "
        . "usuario u on vac.idUsuarioProfissional=u.idUsuario inner join salao s on va.idSalao = s.idSalao where vac.idUsuarioProfissional = {$userlogin['idUsuario']}");

//Fim Busca Candidatura para Vagas de Alguel

//Inicio Busca Candidatura para Vagas de Emprego
$readVagaEmprego = new Read();
$readVagaEmprego->FullRead("Select * From vagaempregocandidata vec inner join "
        . "vagaemprego ve on vec.idVagaEmprego=ve.idVagaEmprego inner join "
        . "usuario u on vec.idUsuarioProfissional=u.idUsuario inner join salao s on ve.idSalao = s.idSalao where vec.idUsuarioProfissional = {$userlogin['idUsuario']}");   

//Fim Busca Candidatura para Vagas de Emprego

?>



<section class="content-header">
    <h1> <i class="ion-briefcase"></i> Minhas Candidaturas  </h1>  
</section>

<!-- Main content -->
<section class="content">
    
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#aluguel" data-toggle="tab">Vaga de Aluguel</a></li>
                <li><a href="#emprego" data-toggle="tab">Vaga de Emprego</a></li>

            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="aluguel">
                    <div class="box-footer">


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

foreach ($readVagaAluguel->getResult() as $ses):
    echo "<tr><td> {$ses['nomeAnuncio']} </td>
                                                              <td> {$ses['profissao']} </td>                                                              
                                                              <td> {$ses['formaAluguel']} </td>
                                                              <td> {$ses['preco']} </td>
                                                              <td> {$ses['nomeSalao']} </td>
                                                              <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\">    
                                                              <td>
                                                                  <a href=\"vagaAluguelCandidatar.php?id={$ses['idVagaAluguel']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
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
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="emprego">
                    <div class="box-footer">
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
                                                <th>Faixa de Remuneração</th>
                                                <th>Comissão</th>
                                                <th>Salão</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php

foreach ($readVagaEmprego->getResult() as $ses):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


    echo "<tr><td> {$ses['tituloVaga']} </td>
                                                              <td> {$ses['profissao']} </td>
                                                              <td> {$ses['nivel']} </td>
                                                              <td> {$ses['vinculoEmpregaticio']} </td>
                                                              <td> {$ses['faixaRemuneracao']} </td>
                                                              <td> {$ses['comissao']}% </td>
                                                              <td> {$ses['nomeSalao']} </td>
                                                              <form name=\"PostForm\" method=\"POST\" enctype=\"multipart/form-data\">    
                                                              <td>
                                                                  <a href=\"vagaEmpregoCandidatar.php?id={$ses['idVagaEmprego']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
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
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
        <!-- /.tab-content -->
    </div>




    <!--Tabela listando Vagas de Aluguel-->






</section>
<div class="row">
<?php include 'menuFooter.php'; ?> 

    <script>
        $(document).ready(function () {
            $('#myModal').modal('show');
        });

        function Excluir() {
            location.href = "minhasVagas.php?id=<?php print $idPort; ?>"
        }
        ;

        function Cancelar() {
            location.href = "teste.php"
        }
        ;
    </script>