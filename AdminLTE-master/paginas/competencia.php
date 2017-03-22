<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$msg = false;

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    $data['idUsuario'] = $userlogin['idUsuario'];



    require '../../admin/_models/AdminCompetencia.class.php';
    $cadastra = new AdminCompetencia;
    $cadastra->ExeCreate($data);
    RentalErro("<b>Sucesso:</b>  o usuário foi atualizado!", RENTAL_ACCEPT);
   // echo "<script>location.href='competencia.php';</script>";

endif;
    $read = new Read();
    $read->FullRead("select * from habilidadeusuario hu inner join areaatuacao aa on hu.idAreaAtuacao=aa.idAreaAtuacao WHERE idUsuario = :id order by aa.nomeProfissao" , "id={$userlogin['idUsuario']}");
    if($read->getResult()):
        foreach ($read->getResult() as $area):
            $array[] = $area['idAreaAtuacao'];
        endforeach;
    endif;

?>

<section class="content-header">
     <h1> <i class="fa fa-toggle-off"></i> Competências</h1>  
    </section>
    <!-- Main content -->
    <section class="content">

        <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data"  >
		<h3> Quais são suas áreas de atuação?</h3>
		  <div class="col-md-12">
              <div class="form-group">
                <select class="form-control select2" multiple="multiple"  style="width: 100%;" name="idAreaAtuacao[]">

                    <?php
                    $i=0;
                    $readAreaAtuacao = new Read;

                    $readAreaAtuacao->FullRead("select * from areaatuacao order by nomeProfissao");


                    if (!$readAreaAtuacao->getResult()):
                        echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                    else:

                        foreach ($readAreaAtuacao->getResult() as $area):
                            $atuacao = $array[$i];
                            echo "<option value=\"{$area['idAreaAtuacao']}\" ";

                                                        if ($area['idAreaAtuacao'] == $atuacao ):
                                                            echo ' selected="selected" ';
                                                            $i++;
                                                        else:
                                                            echo "> {$area['nomeProfissao']} </option>";
                                                        endif;

                            echo "> {$area['nomeProfissao']} </option>";
                        endforeach;
                    endif;



                    ?>
                </select>
              </div>
		</div>
		
		<h3> Quais marcas, produtos e equipamentos você utiliza?</h3>
		  <div class="col-md-12">
              <div class="form-group">
                <select class="form-control select2" multiple="multiple"  style="width: 100%;">
                  <option>Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
		</div>


        <section class="col-lg-12 connectedSortable ">
            <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-plus"></i>Salvar</button>
        </section>
        </form>
	
    <center> 
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li>
                    <a href="certificacao.php" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <li><a href="perfil.php"><i class="ion-person"></i> Perfil</a></li>
                <li><a href="redeSocial.php"><i class="fa fa-commenting-o"></i> Redes Sociais</a></li>
                <li><a href="endereco.php"><i class="fa fa-map-marker"></i> Localização</a></li>
                <li><a href="experiencia.php"><i class="ion-briefcase"></i> Experiências</a></li>
                <li><a href="certificacao.php"><i class="fa fa-graduation-cap"></i> Certificados</a></li>
                <li><a href="#"><i class="fa fa-toggle-off"></i> Competências</a></li>
                <li>
                    <a href="#" aria-label="Next" disabled>
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </center>
                </section>

<div class="row">
<?php include 'menuFooter.php'; ?>