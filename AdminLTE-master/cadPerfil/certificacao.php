<?php
session_start();
require('../../_app/Config.inc.php');

$login = new LoginSite(0);
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];
endif;

if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: index.php?exe=logoff');
endif;



$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$ExperienciaUsuario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    require '../../admin/_models/AdminCertificado.php';
    $cadastra = new AdminCertificado;

    $cadastra->ExeCreate($data);
    $readCertificado = new Read;

    $readCertificado->FullRead("SELECT MAX(idCertificado) FROM certificadoprofissionalusuario");
    $idCertificado = $readCertificado->getResult()[0]['MAX(idCertificado)'];


    $CertificadoUsuario['idCertificado'] = $idCertificado;
    $CertificadoUsuario['idUsuario'] = $userlogin['idUsuario'];


    $cadastra->InsereRelacao($CertificadoUsuario);


    if (!$cadastra->getResult()):
        WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        header('Location: certificacao.php');
    endif;
endif;
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="../plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="../index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>R</b>E</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Rental</b>Easy</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">1</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Você tem 4 mensagens</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="../dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        AdminLTE Design Team
                                                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="../dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Developers
                                                        <small><i class="fa fa-clock-o"></i> Today</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="../dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Sales Department
                                                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="../dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Reviewers
                                                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">Ver todas as mensagens</a></li>
                                </ul>
                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Você tem 10 notificações</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                                    page and may cause design problems
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-user text-red"></i> You changed your username
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">Ver todas</a></li>
                                </ul>
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Você tem 9 tarefas</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Create a nice theme
                                                        <small class="pull-right">40%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">40% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Some task I need to do
                                                        <small class="pull-right">60%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">60% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Make beautiful transitions
                                                        <small class="pull-right">80%</small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">80% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                        <p>
<?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?> - Profissional
                                            <small>Membro desde Nov. 2016</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Friends</a>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="../index.php?logoff=true" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">Navegação Principal</li>
<?php
echo '
		<li class="active treeview/">
			<a href="../index.php"><i class="fa fa-dashboard"></i><span>Inicio</span></a>
		</li>
		
		<li class="treeview">
			<a href="cadPerfil/perfilpublico.php"><i class="fa fa-user"></i> <span>Perfil Público</span></a>	
		</li>
                ';
if ($userlogin['idTipoUsuario'] == 2):
    echo '
                    <li class="treeview">
			<a href="../procurarvaga.html"><i class="fa fa-search"></i> <span>Procurar Vagas</span></a>	
                    </li> 
                    
                     ';
else :
    echo '
                    <li class="treeview">
                        <a href="cadEmpresa/minhaEmpresa.html"><i class="fa fa-building"></i> <span>Meus Salões</span></a>	
                    </li>
                    <li class="treeview">
                        <a href=""><i class="fa fa-plus"></i> <span>Cadastrar Vaga</span></a>	
                    </li>
                    ';
endif;

echo '              
                 <li class="treeview">
                    <a href="cadPerfil/sobremim.php"><i class="fa fa-edit"></i> <span>Editar Perfil</span></a>	
		</li>
                <li class="treeview">
                   <a href=""><i class="fa fa-recycle"></i> <span>Dicas de Sustentabilidade</span></a>	
		</li>
                   ';
?>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->


                <!-- Main content -->
                <section class="content">
                    <form role="form" action="" method="post" class="login-form">
                        <h1> <i class="ion-ios-bookmarks"></i> Certificados</h1> 


                        <!-- INICIO-->
                        <!-- Default box -->

                        <div class="box">

                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="ion-plus"></i> Cadastrar Certificado</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                </div>
                            </div>
                            <div class="box-body">
                                <section class="col-lg-6 connectedSortable">
                                    <!-- Custom tabs (Charts with tabs)-->
                                    <div class="nav-tabs-custom">
                                        <!-- Tabs within a box -->
                                        <ul class="nav nav-tabs pull-right">                  
                                            <li class="pull-left header"><i class="ion-person"></i> Dados Gerais</li>
                                        </ul>
                                        <div class="tab-content no-padding">
                                            <!-- Morris chart - Sales -->
                                            <br>
                                            <div ></div>
                                            <div class="box-body box-profile" id="sales-chart" required >
                                                <div class="form-group">
                                                    <label>Instituição:</label>
                                                    <input type="text" class="form-control" required name="instituicaoCertificado"  <?php if (isset($data)) echo $data['instituicaoCertificado'];?> >
                                                    <label>Curso:</label>
                                                    <input type="text" class="form-control" required name="cursoCertificado"  <?php if (isset($data)) echo $data['cursoCertificado'];?>>
                                                    <label>Nível:</label>
                                                    <select class="form-control" required name="nivelCertificado">
                                                        <option></option>
                                                        <option>Técnico</option>
                                                        <option>Especialização</option>
                                                        <option>Bacharelado</option>
                                                    </select>
                                                    <?php if (isset($data)) echo $data['nivelCertificado'];?>
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
                                            <li class="pull-left header"><i class="ion-plus"></i> Sobre</li>
                                        </ul>
                                        <div class="tab-content no-padding">
                                            <!-- Morris chart - Sales -->
                                            <br>
                                            <div ></div>
                                            <div class="box-body box-profile" id="sales-chart" >
                                                <div class="form-group">
                                                    <label>Duração:</label>
                                                    <select class="form-control" required name="duracaoCertificado">
                                                        <option></option>
                                                        <option>3 meses</option>
                                                        <option>6 meses</option>
                                                        <option>12 meses</option>
                                                        <option>15 meses</option>
                                                        <option>18 meses</option>
                                                        <option>24 meses</option>
                                                    </select>
                                                    <?php if (isset($data)) echo $data['duracaoCertificado'];?>
                                                    <label>Ano de Inicio:</label>
                                                    <select class="form-control" required name="anoInicioCertificado">
                                                        <option></option>
                                                        <option>2015</option>
                                                        <option>2016</option>
                                                        <option>2017</option>
                                                    </select>
                                                     <?php if (isset($data)) echo $data['anoInicioCertificado'];?>
                                                    <label>Ano de Conclusão:</label>
                                                    <select class="form-control" required name="anoConclusaoCertificado">
                                                        <option></option>
                                                        <option>2015</option>
                                                        <option>2016</option>
                                                        <option>2017</option>
                                                    </select>
                                                     <?php if (isset($data)) echo $data['anoConclusaoCertificado'];?>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </section>

                                <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-plus"></i>Cadastrar certificação</button>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </form>

                    <!-- FIM -->


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Meus Certificados</h3>


                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Instituição</th>
                                            <th>Curso</th>
                                            <th>Nível</th>
                                            <th>Duração</th>
                                            <th>Ano de ínicio</th>
                                            <th>Ano de conclusão</th>
                                        </tr>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>


                </section>

                <center>	
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li><a href="#">Sobre Mim</a></li>
                            <li><a href="perfil.php">Perfil</a></li>
                            <li><a href="endereco.php">Localização</a></li>
                            <li><a href="experiencia.php">Experiências</a></li>
                            <li><a href="certificacao.php">Certificados</a></li>
                            <li><a href="competencia.php">Competências</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </center>

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Create the tabs -->
                    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Home tab content -->
                        <div class="tab-pane" id="control-sidebar-home-tab">
                            <h3 class="control-sidebar-heading">Recent Activity</h3>
                            <ul class="control-sidebar-menu">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                            <p>Will be 23 on April 24th</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon fa fa-user bg-yellow"></i>

                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                            <p>New phone +1(800)555-1234</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                            <p>nora@example.com</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                        <div class="menu-info">
                                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                            <p>Execution time 5 seconds</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.control-sidebar-menu -->

                            <h3 class="control-sidebar-heading">Tasks Progress</h3>
                            <ul class="control-sidebar-menu">
                                <li>
                                    <a href="javascript:void(0)">
                                        <h4 class="control-sidebar-subheading">
                                            Custom Template Design
                                            <span class="label label-danger pull-right">70%</span>
                                        </h4>

                                        <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <h4 class="control-sidebar-subheading">
                                            Update Resume
                                            <span class="label label-success pull-right">95%</span>
                                        </h4>

                                        <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <h4 class="control-sidebar-subheading">
                                            Laravel Integration
                                            <span class="label label-warning pull-right">50%</span>
                                        </h4>

                                        <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <h4 class="control-sidebar-subheading">
                                            Back End Framework
                                            <span class="label label-primary pull-right">68%</span>
                                        </h4>

                                        <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <!-- /.control-sidebar-menu -->

                        </div>
                        <!-- /.tab-pane -->
                        <!-- Stats tab content -->
                        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                        <!-- /.tab-pane -->
                        <!-- Settings tab content -->
                        <div class="tab-pane" id="control-sidebar-settings-tab">
                            <form method="post">
                                <h3 class="control-sidebar-heading">General Settings</h3>

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Report panel usage
                                        <input type="checkbox" class="pull-right" checked>
                                    </label>

                                    <p>
                                        Some information about this general settings option
                                    </p>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Allow mail redirect
                                        <input type="checkbox" class="pull-right" checked>
                                    </label>

                                    <p>
                                        Other sets of options are available
                                    </p>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Expose author name in posts
                                        <input type="checkbox" class="pull-right" checked>
                                    </label>

                                    <p>
                                        Allow the user to show his name in blog posts
                                    </p>
                                </div>
                                <!-- /.form-group -->

                                <h3 class="control-sidebar-heading">Chat Settings</h3>

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Show me as online
                                        <input type="checkbox" class="pull-right" checked>
                                    </label>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Turn off notifications
                                        <input type="checkbox" class="pull-right">
                                    </label>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label class="control-sidebar-subheading">
                                        Delete chat history
                                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                    </label>
                                </div>
                                <!-- /.form-group -->
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </aside>
                <!-- /.control-sidebar -->
                <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
                <div class="control-sidebar-bg"></div>
            </div>
            <!-- ./wrapper -->

            <!-- jQuery 2.2.3 -->
            <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
            <!-- Bootstrap 3.3.6 -->
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <!-- PACE -->
            <script src="../plugins/pace/pace.min.js"></script>
            <!-- SlimScroll -->
            <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="../plugins/fastclick/fastclick.js"></script>
            <!-- AdminLTE App -->
            <script src="../dist/js/app.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../dist/js/demo.js"></script>
            <!-- page script -->
            <script type="text/javascript">
                // To make Pace works on Ajax calls
                $(document).ajaxStart(function () {
                    Pace.restart();
                });
                $('.ajax').click(function () {
                    $.ajax({url: '#', success: function (result) {
                            $('.ajax-content').html('<hr>Ajax Request Completed !');
                        }});
                });
            </script>
    </body>
</html>
