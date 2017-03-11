<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

?>

<section class="content-header">
     <h1> <i class="fa fa-toggle-off"></i> Competências</h1>  
    </section>
    <!-- Main content -->
    <section class="content">
		
		
		<h3> Quais serviços e técnicas você oferece?</h3>
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