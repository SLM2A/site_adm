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


$readNaoLida = new Read();
$readNaoLida->FullRead("Select * from mensagem m inner join usuario u on m.idRemetente=u.idUsuario where m.idDestinatario=:id and situacaoRecebida=0", "id={$userlogin['idUsuario']}");
//var_dump($readNaoLida->getre());
$readUsuario= new Read();
$readUsuario->FullRead("Select * FROM usuario where idUsuario=:id", "id={$userlogin['idUsuario']}");

//var_dump($readProfissional->getResult());
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                     <?php
                                         if($readNaoLida->getRowCount()>0):
                                        echo "<span class=\"label label-success\"> {$readNaoLida->getRowCount()} </span></a>";
                                        endif;
                                    ?>
                                    
                                </a>
                                
                                <ul class="dropdown-menu">
                                    
                                      

                                   
                                    <li class="header">Você tem <?php echo $readNaoLida->getRowCount() ?> novas mensagens</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            
                                            <?php   
                  
                                            foreach ($readNaoLida->getResult() as $mensagem):
                                             
                                            echo "    
                                               
                                            <li><!-- start message -->
                                                <a href=\"mensagemrecebida.php?msg={$mensagem['idMensagem']}&desr={$mensagem['idDestinatario']}\">
                                                    <div class=\"pull-left\">
                                                        <img src=\"../dist/img/user2-160x160.jpg\" class=\"img-circle\" alt=\"User Image\">
                                                    </div>
                                                    <h4>
                                                   {$mensagem['nomeUsuario']} {$mensagem['sobrenomeUsuario']}
                                                        <small><i class=\"fa fa-clock-o\"></i> 5 mins</small>
                                                    </h4>
                                                    <p>{$mensagem['assunto']}</p>
                                                </a>
                                            </li>";
                                                endforeach;
                                                    ?>
                                            <!-- end message -->

                                        </ul>
                                    </li>
                                    <li class="footer"><a href="caixademensagem.php">Ver todas as mensagens</a></li>
                                </ul>
                            </li>
                            
                            
                            <!-- Notifications: style can be found in dropdown.less -->
                            <?php
                            
                             if ($userlogin['idTipoUsuario'] == 2):
                                 $readProfissional = new Read();
                                 $readProfissional->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego where (uc.visualizadoProfissional=0 and uc.idUsuarioProfissional=:id)", "id={$userlogin['idUsuario']}");

                                     echo "
                                        <li class=\"dropdown messages-menu\">
                                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                                <i class=\"fa fa-bell-o\"></i>";

                                                if ($readProfissional->getRowCount() > 0):
                                                    echo "<span class=\"label label-danger\"><i class=\"fa fa-exclamation\"></i></span></a>";
                                                endif;
                                           echo "     
                                            </a>
                                            <ul class=\"dropdown-menu\">
                                                <li class=\"header\">Você tem {$readProfissional->getRowCount()} notificação</li>
                                                <li>
                                                    <!-- inner menu: contains the actual data -->
                                                    <ul class=\"menu\">";


            //                                        foreach ($readProfissional->getResult() as $mensagem):
                                                            if ($readProfissional->getResult()):
                                                                echo "                                           
                                                                         <li>
                                                                             <a href=\"propostarecebida.php\">
                                                                                 <i class=\"fa fa-users text-aqua\"></i> Você tem {$readProfissional->getRowCount()} novo(s) convite(s) de emprego</b>
                                                                             </a>
                                                                         </li>";
            //                                        
                                                            endif;

                                                       echo "  
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>";
                                else:
                                  $readEmpresario = new Read();
                                  $readEmpresario->FullRead("SELECT * FROM usuarioconvidado uc inner join vagaemprego ve on uc.idVagaEmprego=ve.idVagaEmprego where (uc.visualizadoEmpresario=0 and uc.idUsuarioEmpresario=:id)", "id={$userlogin['idUsuario']}");  
                                  $readAluguel = new Read();
                                  $readAluguel->FullRead("SELECT * FROM vagaaluguelcandidatada vac inner join vagaaluguel va on vac.idVagaAluguel = va.idVagaAluguel inner join salao s on va.idSalao=s.idSalao inner join salaoempresario se on s.idSalao=se.idSalao where se.idUsuario={$userlogin['idUsuario']} and situacao=0");
                                  $readEmprego = new Read();
                                  $readEmprego->FullRead("SELECT * FROM vagaempregocandidata vec inner join vagaemprego ve on vec.idVagaEmprego = ve.idVagaEmprego inner join salao s on ve.idSalao=s.idSalao inner join salaoempresario se on s.idSalao=se.idSalao where se.idUsuario={$userlogin['idUsuario']} and situacao=0");
                                  
                                  echo "
                            <li class=\"dropdown messages-menu\">
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                    <i class=\"fa fa-bell-o\"></i>";
                                    
                                    if (($readEmpresario->getRowCount() > 0) || ($readAluguel->getRowCount() > 0) || ($readEmprego->getRowCount() > 0)):
                                        echo "<span class=\"label label-danger\"><i class=\"fa fa-exclamation\"></i></span></a>";
                                    endif;
                               echo "     
                                </a>
                                <ul class=\"dropdown-menu\">
                                    <li class=\"header\">Notificações:</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class=\"menu\">";
                                           
                                           
//                                        foreach ($readProfissional->getResult() as $mensagem):
                                                if ($readEmpresario->getResult()):
                                                    echo "                                           
                                                             <li>
                                                                 <a href=\"contatoprofissional.php#respondida\">
                                                                     <i class=\"fa fa-users text-aqua\"></i> Você tem {$readEmpresario->getRowCount()} demonstrações de interesse</b>
                                                                 </a>
                                                             </li>";
//                                        
                                                endif;
                                                 if ($readAluguel->getResult()):
                                                    echo "                                           
                                                             <li>
                                                                 <a href=\"candidatos.php\">
                                                                     <i class=\"fa fa-users text-aqua\"></i>{$readAluguel->getRowCount()} interesse(s) na(s) vaga(s) de aluguel</b>
                                                                 </a>
                                                             </li>";
//                                        
                                                endif;
                                                 if ($readEmprego->getResult()):
                                                    echo "                                           
                                                             <li>
                                                                 <a href=\"candidatos.php\">
                                                                     <i class=\"fa fa-users text-aqua\"></i>{$readEmprego->getRowCount()} interesse(s) na(s) vaga(s) de emprego</b>
                                                                 </a>
                                                             </li>";
//                                        
                                                endif;
                                           
                                           echo "  
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </li>";
                                endif;
                                
                                            
                                            ?>
                            <!-- Tasks: style can be found in dropdown.less -->
                            
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   <?php 
                                      if($readUsuario->getResult()[0]['avatar']==null):
                                       echo "<img src=\"../dist/img/userpadrao.png\" class=\"user-image\" alt=\"User Image\"> ";  
                                      else:
                                       echo " <img src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" class=\"user-image\" alt=\"User Image\"> "; 
                                      endif; ?>
                                      
                                    <span class="hidden-xs"><?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                     <?php 
                                      if($readUsuario->getResult()[0]['avatar']==null):
                                        echo "<img src=\"../dist/img/userpadrao.png\" class=\"img-circle\" alt=\"User Image\"> ";
                                     else:
                                        echo"<img src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" class=\"img-circle\" alt=\"User Image\">";
                                     endif; ?>
                                        <p>
                                            <?= $userlogin['nomeUsuario']; ?> <?= $userlogin['sobrenomeUsuario']; ?> - Profissional
                                            
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="../../index.php?logoff=true" class="btn btn-default btn-flat">Sair</a>
                                            
                                        </div>
                                        <div class="pull-left">
                                            <a href="configurarconta.php" class="btn btn-default btn-flat"><i class="fa fa-cog"></i></a>
                                            
                                        </div>
                                        
                                        
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            
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
                            <?php 
                            if($readUsuario->getResult()[0]['avatar']==null):
                                echo "<img src=\"../dist/img/userpadrao.png\" class=\"img-circle\" alt=\"User Image\"> ";  
                            else:
                                echo"<img src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" class=\"img-circle\" alt=\"User Image\">";
                            endif;?>
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
			<a href="index.php"><i class="fa fa-home"></i><span>Inicio</span></a>
		</li>
		
		<li class="treeview">
			<a href="perfilpublico.php"><i class="fa fa-user"></i> <span>Perfil Público</span></a>	
		</li>
                 <li class="treeview">
                        <a href="perfil.php"><i class="fa fa-edit"></i> <span>Editar Perfil</span></a>	
                    </li>
                ';
                        if ($userlogin['idTipoUsuario'] == 2):
                            echo '
                    <li class="treeview">
			<a href="vagascandidatadas.php"><i class="fa fa-address-card"></i> <span>Vagas Candidatadas</span></a>	
                    </li>
                    <li class="treeview">
			<a href="propostarecebida.php"><i class="fa fa-handshake-o"></i> <span>Propostas Recebidas</span></a>	
                    </li>
                    
                    
                     ';
                        else :
                            echo '
                    <li class="treeview">
                        <a href="cadastroEmpresa.php"><i class="fa fa-building"></i> <span>Meus Salões</span></a>	
                    </li>
                    <li class="treeview">
                        <a href="minhasVagas.php"><i class="fa fa-briefcase"></i> <span>Minhas Vagas</span></a>	
                    </li>
                  
                    <li class="treeview">
			<a href="contatoprofissional.php"><i class="fa fa-user-circle"></i> <span>Propostas de Emprego</span></a>	
                    </li>
                    <li class="treeview">
			<a href="candidatos.php"><i class="fa fa-user-circle"></i> <span>Candidatos</span></a>	
                    </li>
                   
                    ';
                        endif;

                        echo '              
                <li class="treeview">
                   <a href="portfolio.php"><i class="fa fa-camera"></i> <span> Portfólio</span></a>	
		</li>
                <li class="treeview">
                   <a href="caixademensagem.php"><i class="fa fa-envelope-o"></i> <span>Mensagens</span></a>	
		</li>
                <li class="treeview">
                   <a href="dicasustentabilidade.php"><i class="fa fa-recycle"></i> <span>Dicas de Sustentabilidade</span></a>	
		</li>
                
                   ';
                        ?>
                        

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
 <?php if ($userlogin['idTipoUsuario'] == 2):
                      echo " 
                            <form action=\"procurarvaga.php\" method=\"get\">
                                <div class=\"input-group\">
                                  <input type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"busque vagas por profissão\" style=\" border-width: 10px; height: 60px; font-size: 20px;\">
                                      <span class=\"input-group-btn\">
                                        <button type=\"submit\" name=\"search\" id=\"search-btn\" class=\"btn btn-flat\" style=\" border-width: 14px;\"><i class=\"fa fa-search\"></i>
                                        </button>
                                      </span>
                                </div>
                            </form> ";
                      else:
                        echo " 
                              <form action=\"buscaempresario.php\" method=\"get\" >
                                  <div class=\"input-group\">
                                    <input type=\"text\" name=\"q\" class=\"form-control\" placeholder=\"Busque Profissionais por Profissão\" style=\" border-width: 10px; height: 60px; font-size: 20px;\">
                                        <span class=\"input-group-btn\">
                                          <button type=\"submit\" name=\"search\" id=\"search-btn\" class=\"btn btn-flat\" style=\" border-width: 14px; \"><i class=\"fa fa-search\" ></i>
                                          </button>
                                        </span>
                                  </div>
                              </form> "; 
                          
                      endif;
                      ?>  