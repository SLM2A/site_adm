<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
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
        . "usuario u on vec.idUsuario=u.idUsuario inner join salao s on ve.idSalao = s.idSalao where vec.idUsuario = {$userlogin['idUsuario']}");   
//var_dump($readVagaEmprego->getResult());
//Fim Busca Candidatura para Vagas de Emprego
?>



    <section class="content-header">
        <h1> <i class="ion-briefcase"></i> Minhas Candidaturas</h1>      
    </section>

    <!-- Main content -->
    <section class="content">
		

			<!-- Começo da ordenação dos resultados-->
						
	<?php
            
        foreach ($readVagaAluguel->getResult() as $vagas):

            echo "
                <div class=\"col-md-4\">
                  <!-- Widget: user widget style 1 -->
                  <div class=\"box box-widget widget-user\">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('../dist/img/photo1.png') center center;\">
                      <h3 class=\"widget-user-username\"><b>{$vagas['nomeAnuncio']}</b></h3>
                      <h5 class=\"widget-user-desc\">Vaga para {$vagas['profissao']}</h5>
                    </div>
                    <div class=\"widget-user-image\">
                      <img class=\"img-circle\" src=\"../dist/img/Aluguel_de_espaco_128x128.jpg\" alt=\"User Avatar\">
                    </div>
                    <div class=\"box-footer\">
                      <div class=\"row\">
                        <div class=\"col-sm-6 border-right\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">SALÃO</span>                    
                            <h5 class=\"description-header\">{$vagas['nomeSalao']}</h5>                    
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class=\"col-sm-6\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">FORMA DE ALUGUEL</span>
                            <h5 class=\"description-header\">{$vagas['formaAluguel']}</h5>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                      </div>
                      <!-- /.row -->
                    <hr>
                        <a href=\"vagaAluguelCandidatar.php?id={$vagas['idVagaAluguel']}\" class=\"btn btn-success btn-block\"><b>Ver Vaga</b></a>

                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
                <!-- /.col -->"; 
        endforeach;
      //        var_dump($readVagaEmprego->getResult());
        foreach ($readVagaEmprego->getResult() as $vagasEmprego):
            
                        echo "
                <div class=\"col-md-4\">
                  <!-- Widget: user widget style 1 -->
                  <div class=\"box box-widget widget-user\">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('../dist/img/photo1.png') center center;\">
                      <h3 class=\"widget-user-username\"><b>{$vagasEmprego['tituloVaga']}</b></h3>
                      <h5 class=\"widget-user-desc\">Vaga para {$vagasEmprego['profissao']}</h5>
                    </div>
                    <div class=\"widget-user-image\">
                      <img class=\"img-circle\" src=\"../dist/img/vaga_de_emprego_128x128.jpg\" alt=\"User Avatar\">
                    </div>
                    <div class=\"box-footer\">
                      <div class=\"row\">
                        <div class=\"col-sm-6 border-right\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">SALÃO</span>                    
                            <h5 class=\"description-header\">{$vagasEmprego['nomeSalao']}</h5>                    
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class=\"col-sm-6\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">CONTRATAÇÃO</span>
                            <h5 class=\"description-header\">{$vagasEmprego['vinculoEmpregaticio']}</h5>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                      </div>
                      <!-- /.row -->
                    <hr>
                        <a href=\"vagaEmpregoCandidatar.php?id={$vagasEmprego['idVagaEmprego']}\" class=\"btn btn-success btn-block\"><b>Ver Vaga</b></a>

                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
                <!-- /.col -->"; 
           

        endforeach;
    ?>				 
	 

    </section>



<div class="row">
<?php include 'menuFooter.php'; ?>