<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$idProfissional = $_GET['id'];


$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    $data['idUsuarioEmpresario'] = $userlogin['idUsuario'];
    $data['idUsuarioProfissional'] = $idProfissional;
    $data['situacao'] = 0;
    $data['visualizadoProfissional'] = 0;
    require '../../admin/_models/AdminProfissionalConvidar.class.php';
    $cadastra = new AdminProfissionalConvidar;

    $cadastra->ExeCreate($data);
    
     if ($cadastra->getResult()):
            $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
            $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
        if($_SESSION['userlogin']['msg']!="Não existem vagas selecionadas!"):
           echo "<script>location.href='perfilProfissionalPublico.php?id={$idProfissional}';</script>"; 
        else:
           echo "<script>location.href='escolhervaga.php?id={$idProfissional}';</script>";     
        endif;    
        
   endif;
endif;


?>



<section class="content">
    <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data">
           
    <div class="col-md-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="ion-ios-bookmarks"></i> Vagas de Emprego</h3>
            </div>
        
        <div class="box-body table-responsive no-padding">
            <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <thead> 
                                                <tr>
                                                    <th></th>
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
                                                $readSes->FullRead("select * from vagaemprego ve inner join salao s on ve.idSalao = s.idSalao inner join salaoempresario se on s.idSalao = se.idSalao where se.idUsuario= :catid order by s.nomeSalao" , "catid={$userlogin['idUsuario']}");
                                                $i=0;
                                                $readConvidado = new Read();
                                                $readConvidado->FullRead("Select * From usuarioconvidado where idUsuarioEmpresario = {$userlogin['idUsuario']} and idUsuarioProfissional = {$idProfissional} ");
                                                                                                   
                                                  foreach ($readSes->getResult() as $ses):
                                                     if($i<$readConvidado->getRowCount()):
                                                        if ($ses['idVagaEmprego'] == $readConvidado->getResult()[$i]['idVagaEmprego']):
                                                           $i++;
                                                        else:                                                                
                                                               echo "<tr><td><input type=\"checkbox\" name=\"idVagaEmprego[]\" value=\"{$ses['idVagaEmprego']}\" >";
                                                               echo "</td><td> {$ses['tituloVaga']} </td>
                                                                     <td> {$ses['profissao']} </td>
                                                                     <td> {$ses['nivel']} </td>
                                                                     <td> {$ses['vinculoEmpregaticio']} </td>
                                                                     <td> {$ses['numeroVagas']} </td></tr> ";
                                                        endif;
                                                    else: 
                                                        echo "<tr><td><input type=\"checkbox\" name=\"idVagaEmprego[]\" value=\"{$ses['idVagaEmprego']}\" >";
                                                                   echo "</td><td> {$ses['tituloVaga']} </td>
                                                                         <td> {$ses['profissao']} </td>
                                                                         <td> {$ses['nivel']} </td>
                                                                         <td> {$ses['vinculoEmpregaticio']} </td>
                                                                         <td> {$ses['numeroVagas']} </td></tr> ";
                                                    endif;
                                                 endforeach;
                                                ?>
                                            </tbody>  
                                        </table>
                                    </div>
        </div>
    </div>
    </div>



    <?php
//    if (!$readConvidado->getResult()):
        echo "
    <div class=\"col-lg-12 connectedSortable\">
    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\"><i class=\"fa fa-plus\"></i> Enviar Proposta de Emprego para as Vagas Selecionada</button>
    </div>";
//    else:
//        echo "
//    <div class=\"col-lg-12 connectedSortable\">
//    <button input type=\"submit\" class=\"btn btn-block btn-success btn-lg\" value=\"Cadastrar\" name=\"SendPostForm\" disabled><i class=\"fa fa-check\"></i> Aguarde contato do Profissional</button>
//    </div>";
//    endif;
    ?>
</form>

</section>

<div class="row">
<?php include 'menuFooter.php'; ?>


    </script>
