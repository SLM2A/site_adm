<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$termos = $_GET['q'];

$readProfissional = new Read();
$readProfissional->FullRead("Select * From usuario u inner join enderecousuario en on u.idUsuario=en.idUsuario inner join habilidadeusuario hu on u.idUsuario=hu.idUsuario inner join areaatuacao aa on hu.idAreaAtuacao=aa.idAreaAtuacao where  (u.idTipoUsuario=2 and aa.descricaoProfissao like '%{$termos}%' and u.situacao=1) or (u.idTipoUsuario=2 and aa.nomeProfissao like '%{$termos}%' and u.situacao=1 )");

$readVagaEmprego = new Read();
$readVagaEmprego->FullRead("SELECT * FROM vagaemprego ve INNER JOIN salao s ON ve.idSalao=s.idSalao INNER JOIN salaoempresario se ON s.idSalao=se.idSalao WHERE (ve.tituloVaga like '%{$termos}%') or (ve.profissao like '%{$termos}%')");
//var_dump($readVagaEmprego->getResult());

$readVagaAluguel = new Read();
$readVagaAluguel->FullRead("SELECT * FROM vagaaluguel va INNER JOIN salao s ON va.idSalao=s.idSalao INNER JOIN salaoempresario se ON s.idSalao=se.idSalao WHERE (va.nomeAnuncio like '%{$termos}%') or (va.profissao like '%{$termos}%') or (s.nomeSalao like '%{$termos}%')");
//var_dump($readVagaAluguel->getResult());

$readSalao = new Read();
$readSalao->FullRead("Select * From Salao where nomeSalao like '%{$termos}%'");
//var_dump($readSalao->getResult());
?>

<section class="content-header">
      <h1>
        Resultados da busca por <b> <?php echo $termos; ?>:</b>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#aluguel" data-toggle="tab">Vagas de Aluguel</a></li>
            <li><a href="#emprego" data-toggle="tab">Vagas de Emprego</a></li>
            <li><a href="#salao" data-toggle="tab">Salões</a></li>

        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="aluguel">
                <div class="box-footer">


                    <?php
                    
                    foreach ($readVagaAluguel->getResult() as $aluguel):
                      echo "
                        <div class=\"col-md-4\">
                          <!-- Widget: user widget style 1 -->
                          <div class=\"box box-widget widget-user\">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('') center center;\">
                              <h3 class=\"widget-user-username\"><b>{$aluguel['nomeAnuncio']}</b></h3>

                            </div>
                            <div class=\"widget-user-image\">
                              <img class=\"img-circle\" src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" alt=\"User Avatar\">
                            </div>
                            <div class=\"box-footer\">
                               <div class=\"row\">
                                <div class=\"col-sm-4 border-right\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">ALUGUEL</span>                    
                                    <h5 class=\"description-header\">{$aluguel['formaAluguel']}</h5>                    
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class=\"col-sm-4 border-right\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">PROFISSÃO</span>
                                    <h5 class=\"description-header\">{$aluguel['profissao']}</h5>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class=\"col-sm-4\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">TAMANHO</span>
                                    <h5 class=\"description-header\">{$aluguel['tamanho']}m²</h5>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->


                              </div>
                              <!-- /.row -->
                            <hr>
                                <a href=\"vagaAluguelCandidatar.php?id={$aluguel['idVagaAluguel']}\" class=\"btn btn-success btn-block\"><b>Ver Vaga</b></a>
                            </div>
                          </div>
                          <!-- /.widget-user -->
                        </div>
                        <!-- /.col -->";
                    endforeach;
                                                                   
                    ?>	


                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="emprego">
                <div class="box-footer">
                    <?php
                    
                    foreach ($readVagaEmprego->getResult() as $emprego):
                      echo "
                        <div class=\"col-md-4\">
                          <!-- Widget: user widget style 1 -->
                          <div class=\"box box-widget widget-user\">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('') center center;\">
                              <h3 class=\"widget-user-username\"><b>{$emprego['tituloVaga']}</b></h3>

                            </div>
                            <div class=\"widget-user-image\">
                              <img class=\"img-circle\" src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" alt=\"User Avatar\">
                            </div>
                            <div class=\"box-footer\">
                               <div class=\"row\">
                                <div class=\"col-sm-4 border-right\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">NÍVEL</span>                    
                                    <h5 class=\"description-header\">{$emprego['nivel']}</h5>                    
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class=\"col-sm-4 border-right\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">PROFISSÃO</span>
                                    <h5 class=\"description-header\">{$emprego['profissao']}</h5>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class=\"col-sm-4\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">CONTRATAÇÃO</span>
                                    <h5 class=\"description-header\">{$emprego['vinculoEmpregaticio']}</h5>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->


                              </div>
                              <!-- /.row -->
                            <hr>
                                <a href=\"vagaEmpregoCandidatar.php?id={$emprego['idVagaEmprego']}\" class=\"btn btn-success btn-block\"><b>Ver Vaga</b></a>
                            </div>
                          </div>
                          <!-- /.widget-user -->
                        </div>
                        <!-- /.col -->";
                    endforeach;
                                                                   
                    ?>

                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="salao">
                <div class="box-footer">
                    <?php
                    
                    foreach ($readSalao->getResult() as $salao):
                      echo "
                        <div class=\"col-md-4\">
                          <!-- Widget: user widget style 1 -->
                          <div class=\"box box-widget widget-user\">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('') center center;\">
                              <h3 class=\"widget-user-username\"><b>{$salao['nomeSalao']}</b></h3>

                            </div>
                            <div class=\"widget-user-image\">
                              <img class=\"img-circle\" src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" alt=\"User Avatar\">
                            </div>
                            <div class=\"box-footer\">
                               <div class=\"row\">
                                <div class=\"col-sm-6 border-right\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">CATEGORIA</span>                    
                                    <h5 class=\"description-header\">{$salao['categoriaSalao']}</h5>                    
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class=\"col-sm-6 border-right\">
                                  <div class=\"description-block\">
                                    <span class=\"description-text\">LOCALIZAÇÃO</span>
                                    <h5 class=\"description-header\">{$salao['cidade']}/{$salao['estado']}</h5>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                               </div>
                              <!-- /.row -->
                            <hr>
                                <a href=\"perfilSalaoPublico.php?id={$salao['idSalao']}\" class=\"btn btn-success btn-block\"><b>Ver Perfil do Salão</b></a>
                            </div>
                          </div>
                          <!-- /.widget-user -->
                        </div>
                        <!-- /.col -->";
                    endforeach;
                                                                   
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
    
</section>

<div class="row">        
<?php include 'menuFooter.php'; ?>
