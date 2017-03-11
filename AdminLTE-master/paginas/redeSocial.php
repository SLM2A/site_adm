<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($data['SendPostForm'])):
unset($data['SendPostForm']);

$data['idUsuario'] = $userlogin['idUsuario'];

require '../../admin/_models/AdminRedeSocial.php';
$cadastra = new AdminRedeSocial;
$readSocial = new Read;
$readSocial->ExeRead('redesocial', "WHERE idUsuario = :t", "t={$userlogin['idUsuario']}");

//verifica se existe um endereço cadastrado para o usuario, se existir ele atualiza, se nao existir cria um novo.
if ($readSocial->getResult()):
$idSocial = (int) $readSocial->getResult()[0]['idRedeSocial'];
$cadastra->ExeUpdate($idSocial, $data);
else:
$cadastra->ExeCreate($data);
endif;

//WSErro($cadastra->getError()[0], $cadastra->getError()[1]);

else:
$readSocial = new Read;
$readSocial->ExeRead("redesocial", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");
if($readSocial->getResult()):
$data = $readSocial->getResult()[0];

endif;
endif;

 ?>


<section class="content-header">
                    <h1> <i class="fa fa-commenting-o"></i> Redes Sociais</h1>  
                </section>

                <section class="content">

                    <form role="form" action="" method="post" class="login-form">
                        
                        <section class="col-lg-12 connectedSortable center">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                   
                                    <div class="box-body box-profile" id="sales-chart" >
                                        <label><i class="fa fa-instagram"></i> Instagram</label> 
                                        <div class="input-group">
                                            
                                            <span class="input-group-addon">@</i></span>
                                            <input type="text" class="form-control" placeholder="nome_usuario" id="instagram" name="instagram" value="<?php if (isset($data)) echo $data['instagram']; ?>">
                                         </div>   
                                        
                                        <label><i class="fa fa-facebook-official"></i> Facebook</label> 
                                        <div class="input-group">
                                            <span class="input-group-addon">www.facebook.com/</i></span>
                                            <input type="text" class="form-control" placeholder="seu_perfil" id="facebook" name="facebook" value="<?php if (isset($data)) echo $data['facebook']; ?>">
                                        </div>
                                        <label><i class="fa fa-twitter"></i> Twitter</label> 
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="seu_perfil" id="twitter" name="twitter" value="<?php if (isset($data)) echo $data['twitter']; ?>">
                                        </div> 
                                        <label><i class="fa fa-whatsapp"></i> WhatsApp</label> 
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" id="whatsapp" class="form-control" placeholder="(__)_____-____" id="whatsapp" name="whatsapp" value="<?php if (isset($data)) echo $data['whatsapp']; ?>">
                                        </div>

                                    </div>
                                </div>
                            </div>        
                        </section>
                            
                        
                        
                        <section class="col-lg-12 connectedSortable ">
                            <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-plus"></i> Enviar</button>
                        </section>
                    </form>

                    <center> 
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="perfil.php" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                
                                <li><a href="perfil.php"><i class="ion-person"></i> Perfil</a></li>
                                <li><a href="#"><i class="fa fa-commenting-o"></i> Redes Sociais</a></li>
                                <li><a href="endereco.php"><i class="fa fa-map-marker"></i> Localização</a></li>
                                <li><a href="experiencia.php"><i class="ion-briefcase"></i> Experiências</a></li>
                                <li><a href="certificacao.php"><i class="fa fa-graduation-cap"></i> Certificados</a></li>
                                <li><a href="competencia.php"><i class="fa fa-toggle-off"></i> Competências</a></li>
                                <li>
                                    <a href="endereco.php" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </center>

                </section>
<div class="row">
<?php include 'menuFooter.php'; ?>