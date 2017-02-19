<?php
session_start();
require('_app/Config.inc.php');
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rental Easy</title>

	<!-- Style CSS -->

	<link href="css/style.css" rel="stylesheet"/>
	<link rel="shortcut icon" href="img/rent.png" >
	
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">

  
</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Rental Easy</a>
            </div>
            
            <?php
                
                $login = new LoginSite(0);
                
                if($login->CheckLogin()):
                    header('Location: index.php');
                endif;            
				
				
                $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
				if(!empty($dataLogin['AdminLogin'])):
                    $login->ExeLogin($dataLogin);
                    if(!$login->getResult()):
                            WSErro ($login->getError ()[0], $login->getError ()[1]);
                    else:
                            header('Location: AdminLTE-master/index.php ');
                    endif;
                endif;
                
                $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                if (!empty($get)):
                    if($get == 'restrito'):
                        WSErro('<b>OPSS!</b> Acesso negado, favor efetue login para acessar o painel!',WS_ALERT);
                    elseif($get == 'logoff'):
                        WSErro('<b>Sucesso ao deslogar!</b> Sua sessão foi finalizada, volte sempre!',WS_ACCEPT);
                    endif;
                endif;
                
                $logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
                if ($logoff):
                unset($_SESSION['userlogin']);
                header('Location: index.php?exe=logoff');
                endif;
                                
                ?>           
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Sobre</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Serviços</a>
                    </li>                    
                    <li>
                        <a class="page-scroll" href="#contact">Contato</a>
                    </li>
				
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<i class="glyphicon glyphicon-user page-scroll"></i> Entrar
						</a>
                                           
						<div class="dropdown-menu stop-propagation form-login2" role="menu">
						
						</div>
						<div class="dropdown-menu stop-propagation form-login" role="menu">
                                                    
                                                    <form name="AdminLoginForm" action="" method="post">
							<div class="form-group form-space">
                                                          
								<label for="exampleInputEmail1">
									<i class="glyphicon glyphicon-envelope"></i> Email
								</label> 
								<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Seu email" name="email"/>
							</div>
							<div class="form-group form-space">
								<label for="exampleInputPassword1">
									<i class="glyphicon glyphicon-lock" required ></i> Senha
								</label> 
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="senha"/>
							</div>
                                                        <input type="submit" class="btn btn-success btn-block" name ="AdminLogin" value="Logar" /> 
														
                                                    </form>
						</div>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Aqui você encontra seu novo studio!</h1>
                <hr>
                <p>Um espaço para você!</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Saiba Mais</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Nós temos o que você precisa!</h2>
                    <hr class="light">
                    <p class="text-faded">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing."</p>
                    <a href="paginas/registrar.php" class="page-scroll btn btn-default btn-xl sr-button">Começe já</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Nossos serviços</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-users text-primary sr-icons"></i>
                        <h3>Ligando Pessoas</h3>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
                        <h3>Compartilhar espaço</h3>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart  text-primary sr-icons"></i>
                        <h3>Amamos você</h3>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-scissors text-primary sr-icons"></i>
                        <h3>Lorem ipsum</h3>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Fenix Cabeleireiro
                                </div>
                                <div class="project-name">
                                    Corte verão
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Onix Studio
                                </div>
                                <div class="project-name">
                                    Undercurt
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Espaço Milaré
                                </div>
                                <div class="project-name">
                                    Corte 3
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/4.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Espaço Farias
                                </div>
                                <div class="project-name">
                                    Corte 4
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/5.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Portela Studio
                                </div>
                                <div class="project-name">
                                    Corte 5
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/6.jpg" class="portfolio-box">
                        <img src="img/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Dadalto Cortes
                                </div>
                                <div class="project-name">
                                    Corte 6
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Veja mais trabalhos!</h2>
                <a href="" class="btn btn-default btn-xl sr-button">Clique aqui</a>
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Começe a usar em um toque!</h2>
                    <hr class="primary">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>11 9999-9999</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">suporte@rentaleasy.com.br</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>


    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>
	<script src="js/scriptmenu.js"></script>

	
	<!-- Phone Gap Tag -->
	<script src="phonegap.js"></script>
</body>

</html>
