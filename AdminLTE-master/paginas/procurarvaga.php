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
                 <option></option>
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
                    <option></option>
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
                  <option selected="selected"></option>
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
     
        $readVaga->FullRead("Select * From vagaaluguel va inner join salao s on va.idSalao = s.idSalao");
//        var_dump($readVaga->getResult());
        
        foreach ($readVaga->getResult() as $vagas):

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
            
            
            
        
        $readVagaEmprego = new Read();
        $readVagaEmprego->FullRead("Select * From vagaemprego ve inner join salao s on ve.idSalao = s.idSalao");

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
