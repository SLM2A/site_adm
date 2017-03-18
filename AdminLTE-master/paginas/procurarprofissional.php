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

            echo "      <section class=\"col-lg-3 connectedSortable\">
                            <!-- Profile Image -->
                            <div class=\"box box-primary\">
                                <div class=\"box-body box-profile\">
                                    <img class=\"profile-user-img img-responsive img-circle\" src=\"../dist/img/Aluguel_de_espaco_128x128.jpg\" alt=\"User profile picture\">
                                    <h3 class=\"profile-username text-center\"\> {$usuarios['nomeUsuario']} {$usuarios['sobrenomeUsuario']}</h3>
                                    <hr>
                                    <strong><i class=\"fa fa-pencil margin-r-5\"></i>Descrição</strong>
                                    <p>{$usuarios['descricao']}</p>
                                    <hr>
                                    <a href=\"perfilProfissionalPublico.php?id={$usuarios['idUsuario']}\" class=\"btn btn-success btn-block\"><b>Ver Profissional</b></a>
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
