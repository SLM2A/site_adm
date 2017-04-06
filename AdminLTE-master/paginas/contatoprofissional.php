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
                    $readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaaluguel va on uc.idVagaAluguel=va.idVagaAluguel inner join usuario u on u.idUsuario = uc.idUsuarioProfissional inner join salao s on va.idSalao=s.idSalao where uc.idUsuarioEmpresario= {$userlogin['idUsuario']} and situacao=0 order by nomeAnuncio");

//var_dump($readProfissional->getResult());
//Fim Busca Candidatura para Vagas de Alguel


                    echo "
    <div class=\"box\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><i class=\"ion-ios-bookmarks\"></i> Vagas de Aluguel</h3>
            </div>
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                    <th></th>
                                                    <th>Vaga</th>
                                                    <th>Profissional</th>
                                                    <th>Profissão</th>
                                                    <th>Sexo</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


                    foreach ($readProfissional->getResult() as $profissional):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                        echo "<tr><td><input type=\"checkbox\" name=\"idVagaAluguel[]\" value=\"{$profissional['idVagaAluguel']}\" class=\"flat-red\" ";

                        if ($profissional['idVagaAluguel'] == $profissional['idVagaAluguel']):
                            echo ' checked';
                        endif;

                        echo "</td>
                                                        <td> <a href=\"perfilVagaAluguelPublico.php?id={$profissional['idVagaAluguel']}\">{$profissional['nomeAnuncio']}</a> </td>
                                                            <td> <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>
                                                              <td> {$profissional['profissao']}</td>
                                                              
                                                              <td> {$profissional['sexoUsuario']} </td>
                                                              
                                                              <td><a href=\"perfilSalaoPublico.php?id={$profissional['idSalao']}\">{$profissional['nomeSalao']} </td>
                                                               </tr>
                                                        ";

                    endforeach;
                    echo "       
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    
    ";
                    $readEmprego = new Read();
                    $readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego inner join usuario u on u.idUsuario = uc.idUsuarioProfissional inner join salao s on ve.idSalao=s.idSalao where uc.idUsuarioEmpresario= {$userlogin['idUsuario']} and situacao=0 order by tituloVaga");
                    echo "
    <div class=\"box\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><i class=\"ion-ios-bookmarks\"></i> Vagas de Emprego</h3>
            </div>
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                    <th></th>
                                                    <th>Vaga</th>
                                                    <th>Profissional</th>
                                                    <th>Profissão</th>
                                                    <th>Sexo</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


                    foreach ($readProfissional->getResult() as $profissional):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                        echo "<tr><td><input type=\"checkbox\" name=\"idVagaAluguel[]\" value=\"{$profissional['idVagaAluguel']}\" class=\"flat-red\" ";

                        if ($profissional['idVagaAluguel'] == $profissional['idVagaAluguel']):
                            echo ' checked';
                        endif;

                        echo "</td>
                                                        <td> <a href=\"perfilVagaEmpregoPublico.php?id={$profissional['idVagaEmprego']}\">{$profissional['tituloVaga']}</a> </td>
                                                            <td> <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>
                                                              <td> {$profissional['profissao']}</td>
                                                              
                                                              <td> {$profissional['sexoUsuario']} </td>
                                                              
                                                              <td><a href=\"perfilSalaoPublico.php?id={$profissional['idSalao']}\">{$profissional['nomeSalao']} </td>
                                                               </tr>
                                                        ";

                    endforeach;
                    echo "       
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    
    ";
                    ?>	


                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
                <div class="box-footer">
                    <?php
//Inicio Busca Candidatura para Vagas de Alguel
                    $readProfissional = new Read();
                    $readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaaluguel va on uc.idVagaAluguel=va.idVagaAluguel inner join usuario u on u.idUsuario = uc.idUsuarioProfissional inner join salao s on va.idSalao=s.idSalao where uc.idUsuarioEmpresario= {$userlogin['idUsuario']} and situacao=1 order by nomeAnuncio");
//var_dump($readProfissional->getResult());
//Fim Busca Candidatura para Vagas de Alguel
                    echo "
    <div class=\"box\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><i class=\"ion-ios-bookmarks\"></i> Vagas de Aluguel</h3>
            </div>
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                    
                                                    <th>Vaga</th>
                                                    <th>Profissional</th>
                                                    <th>Profissão</th>
                                                    <th>Sexo</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


                    foreach ($readProfissional->getResult() as $profissional):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                       
                        echo "
                                                            <tr><td style=\"padding-right: 100px;\"> <a href=\"perfilVagaAluguelPublico.php?id={$profissional['idVagaAluguel']}\">{$profissional['nomeAnuncio']}</a> </td>
                                                            <td> <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>
                                                            <td> {$profissional['profissao']}</td>
                                                            <td> {$profissional['sexoUsuario']} </td>
                                                            <td><a href=\"perfilSalaoPublico.php?id={$profissional['idSalao']}\">{$profissional['nomeSalao']} </td></tr>
                                                        ";

                    endforeach;
                    echo "       
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    
    ";

                    $readEmprego = new Read();
                    $readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego inner join usuario u on u.idUsuario = uc.idUsuarioProfissional inner join salao s on ve.idSalao=s.idSalao where uc.idUsuarioEmpresario= {$userlogin['idUsuario']} and situacao=1 order by tituloVaga");
                    echo "
    <div class=\"box\">
            <div class=\"box-header\">
                <h3 class=\"box-title\"><i class=\"ion-ios-bookmarks\"></i> Vagas de Emprego</h3>
            </div>
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                    
                                                    <th>Vaga</th>
                                                    <th>Profissional</th>
                                                    <th>Profissão</th>
                                                    <th>Sexo</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


                    foreach ($readProfissional->getResult() as $profissional):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                        
                        echo "                              </tr><td style=\"padding-right: 72px;\"><a href=\"perfilVagaEmpregoPublico.php?id={$profissional['idVagaEmprego']}\">{$profissional['tituloVaga']}</a> </td>
                                                            <td > <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>
                                                            <td> {$profissional['profissao']}</td> 
                                                            <td> {$profissional['sexoUsuario']} </td>
                                                            <td><a href=\"perfilSalaoPublico.php?id={$profissional['idSalao']}\">{$profissional['nomeSalao']} </td>
                                                               </tr>
                                                        ";

                    endforeach;
                    echo "       
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    
    ";
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