<?php
session_start();
require_once('../../_app/Config.inc.php');
require_once('../../_app/Includes.php');

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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rental Easy</title>
        <link rel="shortcut icon" href="../../img/rent.png" >
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
         <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
          <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="../plugins/iCheck/all.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="../plugins/select2/select2.min.css">
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
                <a href="index.php" class="logo">
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
                                    <li class="header">Você tem 1 mensagens</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Marcelo Lima
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Olá, tudo bem?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->

                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">Ver todas as mensagens</a></li>
                                </ul>
                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">1


                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Você tem 1 notificação</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 2 pessoas visualizaram sua página
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
                                    <span class="label label-danger">3</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Conquistas</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        Perfil Completo
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
                                                        Cadastrar Salão
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
                                                        Cadastrar vaga
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
                                            <!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">Ver todas</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../dist/img/userpadrao.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../dist/img/userpadrao.png" class="img-circle" alt="User Image">

                                        <p>
                                            <?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?> - Profissional
                                            <small>Membro desde Nov. 2016</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="../../index.php?logoff=true" class="btn btn-default btn-flat">Sair</a>
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
                            <img src="../dist/img/userpadrao.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>
                            <p><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></p>
                            
                        </div>
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">Navegação Principal</li>
                        <?php
                        echo '
		<li class="active treeview/">
			<a href="index.php"><i class="fa fa-dashboard"></i><span>Inicio</span></a>
		</li>
		
		<li class="treeview">
			<a href="perfilpublico.php"><i class="fa fa-user"></i> <span>Perfil Público</span></a>	
		</li>
                ';
                        if ($userlogin['idTipoUsuario'] == 2):
                            echo '
                    <li class="treeview">
			<a href="procurarvaga.php"><i class="fa fa-search"></i> <span>Procurar Vagas</span></a>	
                    </li>
                    <li class="treeview">
			<a href="vagascandidatadas.php"><i class="fa fa-search"></i> <span>Vagas candidatadas</span></a>	
                    </li>
                    
                     ';
                        else :
                            echo '
                    <li class="treeview">
                        <a href="cadastroEmpresa.php"><i class="fa fa-building"></i> <span>Meus Salões</span></a>	
                    </li>
                    <li class="treeview">
                        <a href="EscolhaTipoVaga.php"><i class="fa fa-plus"></i> <span>Cadastrar Vaga</span></a>	
                    </li>
                    <li class="treeview">
                        <a href="minhasVagas.php"><i class="fa fa-plus"></i> <span>Minhas Vagas</span></a>	
                    </li>
                    <li class="treeview">
			<a href="procurarprofissional.php"><i class="fa fa-search"></i> <span>Procurar Profissional</span></a>	
                    </li>
                    ';
                        endif;

                        echo '              
                 <li class="treeview">
                    <a href="perfil.php"><i class="fa fa-edit"></i> <span>Editar Perfil</span></a>	
		</li>
                <li class="treeview">
                   <a href="caixademensagem.php"><i class="fa fa-envelope-o"></i> <span>Mensagens</span></a>	
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
