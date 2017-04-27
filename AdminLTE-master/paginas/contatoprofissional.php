<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';



?>

<!-- /.col -->


<section class="content-header">

</section>

<section class="content">

<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#enviadas" data-toggle="tab">Propostas Enviadas</a></li>
            <li><a href="#respondida" data-toggle="tab">Propostas Respondidas</a></li>

        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="enviadas">
                <div class="box-footer">


                    <?php
                    $readEmprego = new Read();
                    $readEmprego->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego inner join usuario u on u.idUsuario = uc.idUsuarioProfissional inner join salao s on ve.idSalao=s.idSalao where uc.idUsuarioEmpresario= {$userlogin['idUsuario']} and uc.situacao=0 order by u.nomeUsuario");
                    echo "
    <div class=\"box\">
            
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                                                                       
                                                    <th>Profissional</th>
                                                    <th>Vaga</th>
                                                    <th>Profissão</th>
                                                    <th>Sexo</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


                    foreach ($readEmprego->getResult() as $profissional):
//                                                       

                        echo "</td> <td> <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>
                                                        <td> <a href=\"perfilVagaEmpregoPublico.php?id={$profissional['idVagaEmprego']}\">{$profissional['tituloVaga']}</a> </td>
                                                           
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
            <div class="tab-pane" id="respondida">
                <?php
                    $readEmprego = new Read();
                    $readEmprego->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego inner join usuario u on u.idUsuario = uc.idUsuarioProfissional inner join salao s on ve.idSalao=s.idSalao where uc.idUsuarioEmpresario= {$userlogin['idUsuario']} and uc.situacao=1 order by tituloVaga");
                    //
                    if($readEmprego->getResult()):
                        require '../../admin/_models/AdminProfissionalConvidar.class.php';
                        $cadastra = new AdminProfissionalConvidar;   
                        $cadastra->ExeUpdateVisualizadaEmpresario($userlogin['idUsuario'],$readEmprego->getResult());
                    endif;
                ?>
                
                <div class="box-footer">
                    <?php
                    
                    echo "
    <div class=\"box\">
           
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                    
                                                    <th>Profissional</th>
                                                    <th>Vaga</th>
                                                    <th>Profissão</th>
                                                    <th>Sexo</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


                    foreach ($readEmprego->getResult() as $profissional):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";


                        echo "</td> <td> <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>
                                                        <td> <a href=\"perfilVagaEmpregoPublico.php?id={$profissional['idVagaEmprego']}\">{$profissional['tituloVaga']}</a> </td>
                                                           
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
</section>
<!-- /.col -->




<div class="row">
    <?php include 'menuFooter.php'; ?>