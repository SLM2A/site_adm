<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($post) && array_key_exists("SendPostForm", $post)):
    unset($data['SendPostForm']);
    $post = ($_FILES['portfolio']['tmp_name'] ? $_FILES['portfolio'] : NULL);
    unset($post['SendPostForm']);

    require '../../admin/_models/SiteRegistrar.class.php';
    $cadastra = new SiteRegistrar();
    $cadastra->ExeUpdate($userlogin['idUsuario'], $data);
    
    require('../../admin/_models/AdminGaleria.class.php');
    $sendGallery = new AdminGaleria;
    $sendGallery->ExeCreate($post, $_SESSION['userlogin']['idUsuario']);

    if ($sendGallery->getMsg()):
        $_SESSION['userlogin']['msg'] = $sendGallery->getMsg()[0];
        $_SESSION['userlogin']['tipoMsg'] = $sendGallery->getMsg()[1];
    endif;

    echo "<script>location.href='portfolio.php';</script>";

else:
    $read = new Read();
    $read->ExeRead("usuario", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");
    if($read->getResult()):
        $data = $read->getResult()[0];
    endif;
endif;


?>

<section class="content-header">
     
        <h1> <i class="ion-person"></i> Perfil</h1>   
    </section>

    <!-- Main content -->
    
    <section class="content">
        
       
             
      <form role="form" action="" method="post" class="login-form">


          <div class="col-lg-12">
              <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-right">                  
                      <li class="pull-left header"><i class="ion-camera"></i> Sua Foto de Perfil</li>
                  </ul>
                  <div class="tab-content no-padding">
                      <div class="box-body box-profile">
                          <div class="input-group">
                              <label class="input-group-btn">
                                  <span class="btn btn-primary">
                                      <i class="fa fa-folder"></i> Arquivos&hellip; <input type="file" style="display: none;" multiple name="portfolio[]" id="exampleInputFile"/>
                                  </span>
                              </label>
                              <input type="text" class="form-control" readonly/>
                          </div>
                      </div>
                  </div>  
              </div>  
          </div>  
          
          
          <?php
          
          if($userlogin['idTipoUsuario']==2):
  echo "     
      
     <div class=\"col-lg-12 connectedSortable\">
            <div class=\"nav-tabs-custom\">
               
                <div class=\"box-body box-profile\" >
                    <center>
                    <label><h4>Você deseja ter seu curriculum ativo em nosso site?</h4></label>
                                <div class=\"form-group\">
                                                                           <input type=\"radio\" name=\"situacao\" value=\"1\" class=\"flat-red\" ";

                                                                            if ($data['situacao'] == 1):
                                                                                echo ' checked';
                                                                            endif;
                                                                            echo "> Sim </option></label>";
                                                                            echo "<label></label> ";
                                                                            echo "<input type=\"radio\" name=\"situacao\" value=\"2\" class=\"flat-red\" ";
                                                                                
                                                                            if ($data['situacao'] == 2):
                                                                                echo ' checked';
                                                                            endif;
                                                                            echo "> Não </option></label>
                                                                           
                                
                    
                                </div>
                    </center>
                   
            </div>
            
        </div>
            </div>
          ";  
                 endif;
        ?>
            
        <div class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">                  
                    <li class="pull-left header"><i class="ion-person"></i> Quem é você?</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    
                    <div class="box-body box-profile" id="sales-chart" >
                      
                        <div class="form-group">
                            <section class="col-lg-6 connectedSortable">                           
                                <label>Nome:</label>
                                <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" value="<?php if (isset($data)) echo $data['nomeUsuario']; ?>" required>
                                <label>CPF:</label>
                                <input type="text" class="form-control" name="cpfUsuario" id="cpf" value="<?php if (isset($data)) echo $data['cpfUsuario']; ?>" required>
								<label>Apelido:</label>
                                <div class="input-group">
									<span class="input-group-addon">@</span>
									<input type="text" class="form-control"  id="apelidoUsuario" name="apelidoUsuario" value="<?php if (isset($data)) echo $data['apelidoUsuario']; ?>" required> 
								</div>								
                            </section>
                            <section class="col-lg-6 connectedSortable">
                                <label>Sobrenome:</label>
                                <input type="text" class="form-control" id="sobrenomeUsuario" name="sobrenomeUsuario" value="<?php if (isset($data)) echo $data['sobrenomeUsuario']; ?>" required>
                                <label>Sexo:</label>
                                <select class="form-control" id="sexoUsuario" name="sexoUsuario" required>
                                    <option selected><?php if (isset($data)) echo $data['sexoUsuario']; ?></option>
                                    <?php 
                                          if($data['sexoUsuario']=='Feminino'):
                                            echo '<option>Masculino</option>';
                                          elseif($data['sexoUsuario']=='Masculino'):
                                            echo '<option>Feminino</option>'; 
                                          else:
                                             echo '<option>Masculino</option>'; 
                                             echo '<option>Feminino</option>'; 
                                    endif;
                                     ?>
                                </select>
                                                                <label>Data de Nascimento:</label>
                                <input type="text" class="form-control" id="data" name="dataNascimento" value="<?php if (isset($data)) echo $data['dataNascimento']; ?>" required>
                            </section>
                            <section class="col-lg-12 connectedSortable">
                                <br>
                            <label>O que penso sobre mim:</label>
                            <div class="box-body pad">
                                <textarea input type="text" class="form-control" placeholder="Escreva sobre você..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          name="descricao" id="descricao" required><?php if (isset($data)) echo $data['descricao']; ?></textarea>
                           
                            </div>
                            </section>
                        </div>
                    </div>
                </div>
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
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <li><a href="#"><i class="ion-person"></i> Perfil</a></li>
                    <li><a href="redeSocial.php"><i class="fa fa-commenting-o"></i> Redes Sociais</a></li>
                    <li><a href="endereco.php"><i class="fa fa-map-marker"></i> Localização</a></li>
                    <li><a href="experiencia.php"><i class="ion-briefcase"></i> Experiências</a></li>
                    <li><a href="certificacao.php"><i class="fa fa-graduation-cap"></i> Certificados</a></li>
                    <li><a href="competencia.php"><i class="fa fa-toggle-off"></i> Competências</a></li>
                    <li>
                        <a href="redeSocial.php" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </center>

		
    </section>

<div class="row">
<?php include 'menuFooter.php'; ?>

    <script>
    $(function() {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
    var input = $(this),
    numFiles = input.get(0).files ? input.get(0).files.length : 1,
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {

    var input = $(this).parents('.input-group').find(':text'),
    log = numFiles > 1 ? numFiles + ' files selected' : label;

    if( input.length ) {
    input.val(log);
    } else {
    if( log ) alert(log);
    }

    });
    });

    });
    

    
    </script>