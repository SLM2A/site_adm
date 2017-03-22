<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';


?>

<section class="content-header">
      <h1>
        Procurar Vaga
       
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
		
		  <div class="col-md-12">
              <div class="form-group">
                <select class="form-control select2" multiple="multiple" data-placeholder="O que você procura?" style="width: 100%;">
                  <?php
                                                $readAreaAtuacao = new Read;

                                                $readAreaAtuacao->FullRead("select * from areaatuacao");
                                                if (!$readAreaAtuacao->getResult()):
                                                    echo '<option disabled="disabled" value="null"> Sem Acesso ao Banco! </option>';
                                                else:
                                                    foreach ($readAreaAtuacao->getResult() as $area):
                                                        echo "<option value=\"{$area['nomeProfissao']}\" ";

//                                                        if ($area['idAreaAtuacao'] == $data['idAreaAtuacao']):
//                                                            echo ' selected="selected" ';
//                                                        endif;

                                                        echo "> {$area['nomeProfissao']} </option>";
                                                    endforeach;
                                                endif;
                                                ?>
                </select>
              </div>
			  

      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <div class="form-group">
                <label>Estado</label>
                <select class="form-control select2" style="width: 100%;">
                  <option value="" disabled selected> Selecione o estado </option>
                        <?php
                        $readState = new Read;
                        $readState->ExeRead("app_estados", "ORDER BY estado_nome ASC");
                        foreach ($readState->getResult() as $estado):
                            extract($estado);                             
                            echo "<option value=\"{$estado_id}\"> {$estado_uf} / {$estado_nome} </option>";
                        endforeach;                        
                        ?> 
                </select>
              </div>
                <label>Categoria</label>
                <select class="form-control select2" style="width: 100%;">
                 <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Cidade</label>
                <select class="form-control select2" style="width: 100%;">
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Ordenação</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>

			<!-- Começo da ordenação dos resultados-->
						
	<?php
        
        $readVaga = new Read();
     
        $readVaga->FullRead("Select * From vagaaluguel");
//        var_dump($readVaga->getResult());
        
        foreach ($readVaga->getResult() as $vagas):

            echo "      <section class=\"col-lg-3 connectedSortable\">
                            <!-- Profile Image -->
                            <div class=\"box box-primary\">
                                <div class=\"box-body box-profile\">
                                    <img class=\"profile-user-img img-responsive img-circle\" src=\"../dist/img/Aluguel_de_espaco_128x128.jpg\" alt=\"User profile picture\">
                                    <h3 class=\"profile-username text-center\"\> {$vagas['nomeAnuncio']}</h3>
                                    <hr>
                                    <strong><i class=\"fa fa-pencil margin-r-5\"></i>Áreas de Atuação</strong>
                                    <p>{$vagas['profissao']}</p>
                                    <hr>
                                    <a href=\"vagaAluguelCandidatar.php?id={$vagas['idVagaAluguel']}\" class=\"btn btn-success btn-block\"><b>Ver Vaga</b></a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                  ";

        endforeach;
        
        $readVagaEmprego = new Read();
        $readVagaEmprego->FullRead("Select * From vagaemprego");

//        var_dump($readVagaEmprego->getResult());
        foreach ($readVagaEmprego->getResult() as $vagasEmprego):

            echo "      <section class=\"col-lg-3 connectedSortable\">
                            <!-- Profile Image -->
                            <div class=\"box box-primary\">
                                <div class=\"box-body box-profile\">
                                    <img class=\"profile-user-img img-responsive img-circle\" src=\"../dist/img/vaga_de_emprego_128x128.jpg\" alt=\"User profile picture\">
                                    <h3 class=\"profile-username text-center\"\> {$vagasEmprego['tituloVaga']}</h3>
                                    <hr>
                                    <strong><i class=\"fa fa-pencil margin-r-5\"></i>Áreas de Atuação</strong>
                                    <p>{$vagasEmprego['profissao']}</p>
                                    <hr>
                                    <a href=\"VagaEmpregoCandidatar.php?id={$vagasEmprego['idVagaEmprego']}\" class=\"btn btn-success btn-block\"><b>Ver Vaga</b></a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                  ";

        endforeach;

        
        ?>				 
	 

    </section>

    <div class="row">
        
<?php include 'menuFooter.php'; ?>
