<?php include 'menuHeader.php'; 
$readUsuario= new Read();
$readUsuario->FullRead("Select * FROM usuario where idUsuario=:id", "id={$userlogin['idUsuario']}");
//var_dump($readUsuario->getResult());
                      ?>        
                        
           <!-- Content Wrapper. Contains page content -->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <i class="fa fa-home"></i> Home
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- ./col -->
                       
                       <?php 
                       
                       if ($userlogin['idTipoUsuario'] == 2):
                              
                            echo "  
                               
                             <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-edit\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Editar Perfil</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-edit\"></i>
                                     </div>
                                     <a href=\"perfil.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>
                             
                              <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-address-card\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Candidaturas</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-address-card\"></i>
                                     </div>
                                     <a href=\"vagascandidatadas.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>
                             
                            <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-handshake-o\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Propostas Recebidas</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-handshake-o\"></i>
                                     </div>
                                     <a href=\"propostarecebida.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>
                             
                            <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-camera\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Portfolio</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-camera\"></i>
                                     </div>
                                     <a href=\"portfolio.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>

                             ";
                       
                       else:
                           $readContato = new Read();
                           $readContato->FullRead("SELECT * FROM usuarioconvidado where idUsuarioEmpresario = {$userlogin['idUsuario']}");
                           $quantidade = $readContato->getRowCount();
                           echo " 
                            <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-university\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Cadastrar Salão</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-university\"></i>
                                     </div>
                                     <a href=\"cadastroEmpresa.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>
                             
                              <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-scissors\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Cadastrar Vaga</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-scissors\"></i>
                                     </div>
                                     <a href=\"EscolhaTipoVaga.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>
                             
                            <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-briefcase\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Minhas Vagas</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-briefcase\"></i>
                                     </div>
                                     <a href=\"minhasVagas.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>
                             
                            <div class=\"col-lg-3 col-xs-6\">
                                 <!-- small box -->
                                 <div class=\"small-box bg-primary\">
                                     <div class=\"inner\">
                                         <h3><i class=\"fa fa-camera\"></i><sup style=\"font-size: 20px\"></sup></h3>

                                         <p>Portfolio</p>
                                     </div>
                                     <div class=\"icon\">
                                         <i class=\"fa fa-camera\"></i>
                                     </div>
                                     <a href=\"portfolio.php\" class=\"small-box-footer\">Veja mais <i class=\"fa fa-arrow-circle-right\"></i></a>
                                 </div>
                             </div>";
                           
                       endif;
                        ?>
                        
                        
                        <!-- ./col -->
                       
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                     
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">                  
                                    <li class="pull-left header"><i class="ion-person"></i> Meus Dados</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <br>
                                    <div >
                                    <?php
                                    if($readUsuario->getResult()[0]['avatar']==null):
                                        echo "<img src=\"../dist/img/userpadrao.png\" class=\"profile-user-img img-responsive img-circle\" alt=\"User profile picture\"> ";  
                                    else:
                                        echo "<img class=\"profile-user-img img-responsive img-circle\" src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" alt=\"User profile picture\">"; 
                                    endif;?></div>
                                    <div class="box-body box-profile" id="sales-chart" style="position: relative; height: 130px;">
                                        <h3 class="profile-username text-center"><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></h3>

                                        <p class="text-muted text-center">Cabelereiro, Barbeiro e Hair Design</p>

                                        <a href="perfilpublico.php" class="btn btn-primary btn-block"><b>Ver Perfil Completo</b></a>				
                                    </div>
                                    
                                </div>
                            </div>
                        </section>
                        
                       
          <!-- /.box -->
        </div>

                 
                    </div>
                </section>
                <div class="row">
<?php include 'menuFooter.php'; ?>