<?php
session_start();
require('../_app/Config.inc.php');

$login = new login(3);
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
    header('Location: ../index.php');
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Site Admin</title>
        <!--[if lt IE 9]>
		   <script src="../_cdn/html5.js"></script> 
		<![endif]-->

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/admin.css" />   
    </head>

    <body class="painel">

        <header id="navadmin">
            <div class="content">

                <h1 class="logomarcaa">Pro Admin</h1>

                <ul class="systema_nav radius">
                    <li class="username">Olá <?= $userlogin['user_name']; ?> <?= $userlogin['user_lastname']; ?></li>
                    <li><a class="icon profile radius" href="painel.php?exe=users/profile">Perfíl</a></li>
                    <li><a class="icon users radius" href="painel.php?exe=users/users">Usuários</a></li>
                    <li><a class="icon logout radius" href="painel.php?logoff=true">Sair</a></li>
                </ul>

                <nav>
                    <h1><a href="painel.php" title="Dasboard">Dashboard</a></h1>

                    <?php
                    //ATIVA MENU
                    if (isset($getexe)):
                        $linkto = explode('/', $getexe);
                    else:
                        $linkto = array();
                    endif;
                    ?>

                    <ul class="menu">
                        <li class="li<?php if (in_array('posts', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Posts</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=posts/create">Criar Post</a></li>
                                <li><a href="painel.php?exe=posts/index">Listar / Editar Posts</a></li>
                            </ul>
                        </li>

                        <li class="li<?php if (in_array('categories', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Categorias</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=areaAtuacao/create">Criar Area de Atuacão</a></li>
                                <li><a href="painel.php?exe=areaAtuacao/index">Listar / Editar Categorias</a></li>
                            </ul>
                        </li> 

                        <li class="li<?php if (in_array('empresas', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Empresas</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=empresas/create">Cadastrar Empresa</a></li>
                                <li><a href="painel.php?exe=empresas/index">Listar / Editar Empresas</a></li>
                            </ul>
                        </li>
                        
                         <li class="li<?php if (in_array('profissional', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Profissional</a>
                            <ul class="sub">
                                <li><a href="painel.php?exe=profissional/create">Cadastrar Profissional</a></li>
                                <li><a href="painel.php?exe=profissional/index">Listar / Editar Profissional</a></li>
                            </ul>
                        </li>
                        <li class="li"><a href="../../Site cliente/index.html" class="opensub">Ver Site</a></li>
                    </ul>
                </nav>

                <div class="clear"></div>
            </div><!--/CONTENT-->
        </header>

        <div id="painel">
            <?php
            //QUERY STRING
            if (!empty($getexe)):
                $includepatch = __DIR__ . '\\system\\' . strip_tags(trim($getexe) . '.php');
            else:
                $includepatch = __DIR__ . '\\system\\home.php';
            endif;

            if (file_exists($includepatch)):
                require_once($includepatch);
            else:
                echo "<div class=\"content notfound\">";
                WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
                echo "</div>";
            endif;
            ?>
        </div> <!-- painel -->

        <footer class="main_footer">
            <a href="" target="_blank" title="SLM2A">&copy; SLM2A - Todos os Direitos Reservados</a>
        </footer>

    </body>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../_cdn/jmask.js"></script>
    <script src="../_cdn/combo.js"></script>
    <script src="__jsc/tiny_mce/tiny_mce.js"></script>
    <script src="__jsc/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
    <script src="__jsc/admin.js"></script>
<!--    <script> 
        var areaAtuacao = "<?php //echo $arrayAreaAtuacao;?>";
        var array = areaAtuacao.split(" | ");      
    </script>-->

    
      
</html>