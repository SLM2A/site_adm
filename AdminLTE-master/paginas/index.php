<?php include 'menuHeader.php'; ?>
            
           <!-- Content Wrapper. Contains page content -->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Informações</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>0</h3>

                                    <p>Visualizações</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-eye"></i>
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>0<sup style="font-size: 20px"></sup></h3>

                                    <p>Candidaturas</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="candidatura.php" class="small-box-footer">Veja mais <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>0</h3>

                                    <p>Fotos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-camera"></i>
                                </div>
                                <a href="portfolio.php" class="small-box-footer">Veja Mais <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>0</h3>

                                    <p>Medalhas</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ribbon-a"></i>
                                </div>
                                <a href="#" class="small-box-footer">Veja Mais <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                     
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">                  
                                    <li class="pull-left header"><i class="ion-person"></i> Meus Dados</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <br>
                                    <div ><img class="profile-user-img img-responsive img-circle" src="../dist/img/user2-160x160.jpg" alt="User profile picture"></div>
                                    <div class="box-body box-profile" id="sales-chart" style="position: relative;">
                                        <h3 class="profile-username text-center"><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></h3>

                                        <p class="text-muted text-center">Cabelereiro, Barbeiro e Hair Design</p>

                                        <a href="perfilpublico.php" class="btn btn-primary btn-block"><b>Ver Perfil Completo</b></a>				
                                    </div>

                                </div>
                            </div>
                        </section>

                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">                  
                                    <li class="pull-left header"><i class="ion-paper-airplane"></i> Funções</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <br>
                                    <div ></div>
                                    <div ></div>
                                    <div class="box-body box-profile" id="sales-chart" style="position: relative; height: 220px">
                                        <a href="perfil.php"><button type="button" class="btn btn-block btn-info btn-lg"><i class="fa fa-edit"></i> Editar Perfil</button></a>            
                                        <?php
                                        if ($userlogin['idTipoUsuario'] == 2):
                                            echo '
                        <a href="procurarvaga.html"><button type="submit" class="btn btn-block btn-success btn-lg"><i class="fa fa-search"></i> Procurar Vagas</button></a>
                     ';
                                        else :
                                            echo '
                        <a href="cadastroEmpresa.php"><button type="button" class="btn btn-block btn-warning btn-lg"><i class="fa fa-building"></i> Meus Salões</button></a>
                        <a href="EscolhaTipoVaga.php"><button type="button" class="btn btn-block btn-success btn-lg"><i class="fa fa-plus"></i> Cadastrar Vaga</button></a>
                        ';
                                        endif;
                                        ?>      
                                        <button type="button" class="btn btn-block btn-primary btn-lg"><i class="fa fa-recycle"></i> Dicas de Sustentabilidade</button>

                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </section>
                <div class="row">
<?php include 'menuFooter.php'; ?>