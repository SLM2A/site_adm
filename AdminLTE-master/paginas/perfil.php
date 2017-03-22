<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/SiteRegistrar.class.php';
    $cadastra = new SiteRegistrar();



    $cadastra->ExeUpdate($userlogin['idUsuario'], $data);

    RentalErro($cadastra->getError()[0], $cadastra->getError()[1]);


else:
    $read = new Read();
    $read->ExeRead("usuario", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");
    if($read->getResult()):
        $data = $read->getResult()[0];
    endif;
endif;

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/SiteRegistrar.class.php';
    $cadastra = new SiteRegistrar();
    
     
    
    $cadastra->ExeUpdate($userlogin['idUsuario'], $data);
    
    RentalErro($cadastra->getError()[0], $cadastra->getError()[1]);
    
    
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

     
        <section class="col-lg-12 connectedSortable">
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
        </section>
    
        

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