<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';
?>

<section class="content-header">
     
        <h1> <i class="fa fa-handshake-o"></i> Candidatos</h1>   
    </section>
<section class="content">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#aluguel" data-toggle="tab"><b>Para Vagas de Aluguel</b></a></li>
                <li><a href="#emprego" data-toggle="tab"><b>Para Vagas de Emprego</b></a></li>

            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="aluguel">
                    <div class="box-footer">
                        <?php
                        $readEmprego = new Read();
                        $readEmprego->FullRead("SELECT * FROM vagaaluguelcandidatada vac inner join vagaaluguel va on vac.idVagaAluguel=va.idVagaAluguel inner join usuario u on u.idUsuario = vac.idUsuarioProfissional inner join salao s  on va.idSalao=s.idSalao inner join salaoempresario se on s.idSalao=se.idSalao where se.idUsuario = {$userlogin['idUsuario']}");
                        echo "
    <div class=\"box\">
            
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                                                                       
                                                    <th>Profissional</th>
                                                    <th>Vaga</th>
                                                    <th>Profissão Vaga</th>
                                                    <th>Sexo do Candidato</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";


                        foreach ($readEmprego->getResult() as $profissional):
//                                                       

                            echo "</td> <td> <a href=\"perfilProfissionalPublico.php?id={$profissional['idUsuario']}\"> {$profissional['nomeUsuario']} {$profissional['sobrenomeUsuario']} </a></td>
                                                        <td> <a href=\"perfilVagaAluguelPublico.php?id={$profissional['idVagaAluguel']}\">{$profissional['nomeAnuncio']}</a> </td>
                                                           
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

                <div class="tab-pane" id="emprego">
                    <div class="box-footer">
                        <?php
                        $readEmprego = new Read();
                        $readEmprego->FullRead("SELECT * FROM vagaempregocandidata vec inner join vagaemprego ve on vec.idVagaEmprego=ve.idVagaEmprego inner join usuario u on u.idUsuario = vec.idUsuario inner join salao s  on ve.idSalao=s.idSalao inner join salaoempresario se on s.idSalao=se.idSalao where se.idUsuario = {$userlogin['idUsuario']}");
                        echo "
    <div class=\"box\">
            
        
        <div class=\"box-body table-responsive no-padding\">
            <div class=\"box-body table-responsive no-padding\">
                                        <table class=\"table table-hover\">
                                            <thead> 
                                                <tr>
                                                                                                       
                                                    <th>Profissional</th>
                                                    <th>Vaga</th>
                                                    <th>Profissão Vaga</th>
                                                    <th>Sexo do Candidato</th>
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

            </div>
        </div>
    </div>

</section>



<div class="row">
    <?php include 'menuFooter.php'; ?>