<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);
   
    $data['idUsuarioProfissional'] = $userlogin['idUsuario'];
    $data['situacao'] = 1;
    
    require '../../admin/_models/AdminProfissionalConvidar.class.php';
    require '../../admin/_models/AdminCandidatarVaga.class.php';
    
    $cadastra = new AdminProfissionalConvidar;   
    $candidatavaga = new AdminCandidatarVaga;
    
    $candidatavaga->ExeCreateArray($data);
    
    $cadastra->ExeUpdate($userlogin['idUsuario'], $data);

    
    
    
    echo "<script>location.href='propostarecebida.php';</script>";

endif;



?>
<br>
<!-- /.col -->
<div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#recebidas" data-toggle="tab">Propostas Recebidas</a></li>
            <li><a href="#timeline" data-toggle="tab">Demonstrei Interesse</a></li>
    
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="recebidas">
                
                <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data">
                <div class="box-footer">


<?php
//Inicio Busca Candidatura para Vagas de Alguel
$readAluguel = new Read();
$readAluguel->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaaluguel va on uc.idVagaAluguel=va.idVagaAluguel inner join salao s on va.idSalao=s.idSalao where uc.idUsuarioProfissional= {$userlogin['idUsuario']} and situacao=0");
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
                                                    <th>Nome do Anúncio</th>
                                                    <th>Profissão</th>
                                                    <th>Forma de Aluguel</th>
                                                    <th>Preço</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";

                                              
                                               foreach ($readAluguel->getResult() as $vaga):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                                                  echo "<tr><td><input type=\"checkbox\" name=\"idVagaAluguel[]\" value=\"{$vaga['idVagaAluguel']}\" class=\"flat-red\" ";

                                                            if ($vaga['idVagaAluguel'] == $data['idVagaAluguel']):
                                                                echo ' checked';
                                                            endif;
                                                                  
                                                    echo "</td><td> {$vaga['nomeAnuncio']} </td>
                                                              <td> {$vaga['profissao']} </td>
                                                              
                                                              <td> {$vaga['formaAluguel']} </td>
                                                              <td> {$vaga['preco']} </td>
                                                              <td> {$vaga['nomeSalao']} </td>
                                                                <td>  
                                                              <a href=\"vagaAluguelCandidatar.php?id={$vaga['idVagaAluguel']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
                                                                  </td></tr>
                                                        ";

                                                endforeach;
                                         echo "       
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    
    ";
    
    
  //Inicio Busca Candidatura para Vagas de Emprego
$readEmprego = new Read();
$readEmprego->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego inner join salao s on ve.idSalao=s.idSalao where uc.idUsuarioProfissional= {$userlogin['idUsuario']} and situacao=0 ");
//var_dump($readEmprego->getResult());
//Fim Busca Candidatura para Vagas de Alguel

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
                                                    <th>Nome do Anúncio</th>
                                                    <th > Profissão</th>
                                                    <th>Faixa Remuneração</th>
                                                    <th>Comissão</th>
                                                    <th>Nome Salão</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";

                                              
                                               foreach ($readEmprego->getResult() as $vaga):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                                                  echo "<tr><td><input type=\"checkbox\" name=\"idVagaEmprego[]\" value=\"{$vaga['idVagaEmprego']}\" class=\"flat-red\" ";

                                                            if ($vaga['idVagaEmprego'] == $data['idVagaEmprego']):
                                                                echo ' checked';
                                                            endif;
                                                                  
                                                    echo "</td><td> {$vaga['tituloVaga']} </td>
                                                              <td> {$vaga['profissao']} </td>
                                                              <td> {$vaga['faixaRemuneracao']} </td>
                                                              <td> {$vaga['comissao']}% </td>
                                                              <td> {$vaga['nomeSalao']} </td>
                                                              <td>  
                                                              <a href=\"vagaEmpregoCandidatar.php?id={$vaga['idVagaEmprego']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
                                                                  </td></tr>
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
                
    <?php            
 if(!$readAluguel->getResult() && !$readEmprego->getResult()):
     echo "
     
    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\" disabled><i class=\"fa fa-check\"></i> Demonstrar Interesse</button>
    ";
else:
    echo "
    
    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\"><i class=\"fa fa-plus\"></i> Demonstrar Interesse</button>
   ";
endif; 
?>
                    </form>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
                <div class="box-footer">
                  <?php
//Inicio Busca Candidatura para Vagas de Alguel
$readAluguel = new Read();
$readAluguel->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaaluguel va on uc.idVagaAluguel=va.idVagaAluguel inner join salao s on va.idSalao=s.idSalao where uc.idUsuarioProfissional= {$userlogin['idUsuario']} and situacao=1");
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
                                                    <th>Nome do Anúncio</th>
                                                    <th>Profissão</th>
                                                    <th>Forma de Aluguel</th>
                                                    <th>Preço</th>
                                                    <th>Nome Salão</th>
                                                    
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";

                                              
                                               foreach ($readAluguel->getResult() as $vaga):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                                                  echo "<tr><td><input type=\"checkbox\" name=\"idVagaAluguel[]\" value=\"{$vaga['idVagaAluguel']}\" class=\"flat-red\" disabled ";

                                                            if ($vaga['idVagaAluguel'] == $data['idVagaAluguel']):
                                                                echo ' checked';
                                                            endif;
                                                                  
                                                    echo "</td><td> {$vaga['nomeAnuncio']} </td>
                                                              <td> {$vaga['profissao']} </td>
                                                              
                                                              <td> {$vaga['formaAluguel']} </td>
                                                              <td> {$vaga['preco']} </td>
                                                              <td> {$vaga['nomeSalao']} </td>
                                                                <td>  
                                                              <a href=\"vagaAluguelCandidatar.php?id={$vaga['idVagaAluguel']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
                                                                  </td></tr>
                                                        ";

                                                endforeach;
                                         echo "       
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    
    ";
    
    
  //Inicio Busca Candidatura para Vagas de Emprego
$readEmprego = new Read();
$readEmprego->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego inner join salao s on ve.idSalao=s.idSalao where uc.idUsuarioProfissional= {$userlogin['idUsuario']} and situacao=1 ");
//var_dump($readProfissional->getResult());
//Fim Busca Candidatura para Vagas de Alguel

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
                                                    <th>Nome do Anúncio</th>
                                                    <th > Profissão</th>
                                                    <th>Faixa Remuneração</th>
                                                    <th>Comissão</th>
                                                    <th>Nome Salão</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody> ";

                                              
                                               foreach ($readEmprego->getResult() as $vaga):
//                                                        echo "<option value=\"{$ses['idSalao']}\" ";

                                                  echo "<tr><td><input type=\"checkbox\" name=\"idVagaAluguel[]\" value=\"{$vaga['idVagaAluguel']}\" class=\"flat-red\" disabled";

                                                            if ($vaga['idVagaAluguel'] == $data['idVagaAluguel']):
                                                                echo ' checked';
                                                            endif;
                                                                  
                                                    echo "</td><td> {$vaga['tituloVaga']} </td>
                                                              <td> {$vaga['profissao']} </td>
                                                              <td> {$vaga['faixaRemuneracao']} </td>
                                                              <td> {$vaga['comissao']}% </td>
                                                              <td> {$vaga['nomeSalao']} </td>
                                                              <td>  
                                                              <a href=\"vagaEmpregoCandidatar.php?id={$vaga['idVagaEmprego']}\"><button type=\"button\" class=\"btn btn-alert btn-flat\">Ver Vaga</button></a>
                                                                  </td></tr>
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