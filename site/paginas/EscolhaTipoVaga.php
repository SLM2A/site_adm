<?php 

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

?>

<section class="content-header">

                </section>

                <!-- Main content -->
                <section class="content">
                    <form role="form" action="" method="post" class="login-form">

                        <section class="col-lg-6 connectedSortable">
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="../dist/img/Aluguel_de_espaco_128x128.jpg" alt="User profile picture">

                                    <h3 class="profile-username text-center">Aluguel de Espaço</h3>

                                   
                                    <ul class="list-group list-group-unbordered">
                                        
                                    </ul>

                                    <a href="cadVagaAlugueldeEspaco.php" class="btn btn-primary btn-block"><b>Aluguel de Espaço</b></a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                        <section class="col-lg-6 connectedSortable">
                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="../dist/img/vaga_de_emprego_128x128.jpg" alt="User profile picture">

                                    <h3 class="profile-username text-center">Vaga de Emprego</h3>

                                    
                                    <ul class="list-group list-group-unbordered">
                                        
                                    </ul>

                                    <a href="cadVagaEmprego.php" class="btn btn-primary btn-block"><b>Vaga de Emprego</b></a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </section>

                    </form>
                </section>
<div class="row">
<?php include 'menuFooter.php'; ?>