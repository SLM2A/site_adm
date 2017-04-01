<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';
?>

<section class="content-header">
      <h1>
        Procurar Profissional
       
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
		
		  <div class="col-md-12">
              <div class="form-group">
                <select class="form-control select2" multiple="multiple" data-placeholder="O que você procura?" style="width: 100%;">
                  <option>Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
			  

      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Cidade</label>
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
              <div class="form-group">
                <label>Estado</label>
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
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Categoria</label>
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
        
        $readUsuario = new Read();
     
        $readUsuario->FullRead("Select * From usuario where idTipoUsuario=2");
//        var_dump($readVaga->getResult());
        
  

                  
        foreach ($readUsuario->getResult() as $usuarios):

             echo "
                <div class=\"col-md-4\">
                  <!-- Widget: user widget style 1 -->
                  <div class=\"box box-widget widget-user\">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('../dist/img/photo1.png') center center;\">
                      <h3 class=\"widget-user-username\"><b>{$usuarios['nomeUsuario']} {$usuarios['sobrenomeUsuario']}</b></h3>
                     
                    </div>
                    <div class=\"widget-user-image\">
                      <img class=\"img-circle\" src=\"../dist/img/userpadrao.png\" alt=\"User Avatar\">
                    </div>
                    <div class=\"box-footer\">
                      <div class=\"row\">
                        <div class=\"col-sm-12 border-right\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">DESCRIÇÃO</span>                    
                            <h5 class=\"description-header\">{$usuarios['descricao']}</h5>                    
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        

                      </div>
                      <!-- /.row -->
                    <hr>
                        <a href=\"perfilProfissionalPublico.php?id={$usuarios['idUsuario']}\" class=\"btn btn-success btn-block\"><b>Ver Profissional</b></a>

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
