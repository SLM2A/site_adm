<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';
?>
<br>
<!-- /.col -->
<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#enviadas" data-toggle="tab">Propostas Enviadas</a></li>
            <li><a href="#timeline" data-toggle="tab">Propostas aceitas</a></li>
    
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="enviadas">
                <div class="box-footer">


<?php
//Inicio Busca Candidatura para Vagas de Alguel
$readProfissional = new Read();
$readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join usuario u on u.idUsuario = uc.idUsuarioProfissional where uc.idUsuarioEmpresario = {$userlogin['idUsuario']} and situacao=0");
//var_dump($readProfissional->getResult());
//Fim Busca Candidatura para Vagas de Alguel
foreach ($readProfissional->getResult() as $profissional):

    
    echo "
                <div class=\"col-md-4\">
                  <!-- Widget: user widget style 1 -->
                  <div class=\"box box-widget widget-user\">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('../dist/img/photo1.png') center center;\">
                      <h3 class=\"widget-user-username\"><b>{$profissional['apelidoUsuario']}</b></h3>
                      <h5 class=\"widget-user-desc\">{$profissional['sexoUsuario']}</h5>
                    </div>
                    <div class=\"widget-user-image\">
                      <img class=\"img-circle\" src=\"../dist/img/userpadrao.PNG\" alt=\"User Avatar\">
                    </div>
                    <div class=\"box-footer\">
                      <div class=\"row\">
                        <div class=\"col-sm-6 border-right\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">ÁREAS DE ATUAÇÃO</span>                    
                            <h5 class=\"description-header\">Profissões</h5>                    
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class=\"col-sm-6\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">WHATSAPP</span>
                            <h5 class=\"description-header\">11 97040-3620</h5>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                      </div>
                      <!-- /.row -->
                    <hr>
                        <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuarioProfissional']}\" class=\"btn btn-success btn-block\"><b>Ver Perfil do Profissional</b></a>

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
            <div class="tab-pane" id="timeline">
                <div class="box-footer">
                  <?php
//Inicio Busca Candidatura para Vagas de Alguel
$readProfissional = new Read();
$readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join usuario u on u.idUsuario = uc.idUsuarioProfissional where uc.idUsuarioEmpresario = {$userlogin['idUsuario']} and situacao=1");
//var_dump($readProfissional->getResult());
//Fim Busca Candidatura para Vagas de Alguel
foreach ($readProfissional->getResult() as $profissional):

    echo "
                <div class=\"col-md-4\">
                  <!-- Widget: user widget style 1 -->
                  <div class=\"box box-widget widget-user\">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('../dist/img/photo1.png') center center;\">
                      <h3 class=\"widget-user-username\"><b>{$profissional['apelidoUsuario']}</b></h3>
                      <h5 class=\"widget-user-desc\">{$profissional['sexoUsuario']}</h5>
                    </div>
                    <div class=\"widget-user-image\">
                      <img class=\"img-circle\" src=\"../dist/img/userpadrao.PNG\" alt=\"User Avatar\">
                    </div>
                    <div class=\"box-footer\">
                      <div class=\"row\">
                        <div class=\"col-sm-6 border-right\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">ÁREAS DE ATUAÇÃO</span>                    
                            <h5 class=\"description-header\">Profissões</h5>                    
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class=\"col-sm-6\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">WHATSAPP</span>
                            <h5 class=\"description-header\">11 97040-3620</h5>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                      </div>
                      <!-- /.row -->
                    <hr>
                        <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuarioProfissional']}\" class=\"btn btn-success btn-block\"><b>Ver Perfil do Profissional</b></a>

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
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<!-- /.nav-tabs-custom -->

<!-- /.col -->




<div class="row">
<?php include 'menuFooter.php'; ?>