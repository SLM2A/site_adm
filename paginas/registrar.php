<?php
session_start();
require('../_app/Config.inc.php');
require '../_app/Includes.php';

$_SESSION['teste'] = 'ok';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);
    $data['senha'] = md5($data['senha']);
    require '../admin/_models/SiteRegistrar.class.php';
    $cadastra = new SiteRegistrar;
    $cadastra->ExeCreate($data);

    if (!$cadastra->getResult()):
        RentalErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        header('Location: login.php ');
    endif;
endif;

?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rental Easy</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/form-elements.css">
        <link rel="stylesheet" href="../css/style.css">

      
    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>Faça seu registro</strong> </h1>
                        <div class="description">
                            <p>
                                Aqui você encontra seu espaço
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Crie sua conta</h3>
                                <p>Coloque seu nome, e-mail e senha:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>

                        <div class="form-bottom">
                            <form role="form" action="" method="post" class="login-form">

                                <div class="form-group col-sm-12">
                                    <center>  

                                        <div class="row">
                                         <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <input type="radio" aria-label="..." name="idTipoUsuario" value="1" required>
                                                    </span>
                                                    <input type="text" class="form-control" value="Empresário" aria-label="..." disabled="">
                                                </div><!-- /input-group -->
                                            </div><!-- /.col-lg-6 -->
                                              <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <input type="radio" aria-label="..." name="idTipoUsuario" value="2" required> 
                                                    </span>
                                                    <input type="text" class="form-control" value="Profissional" aria-label="..." disabled="">
                                                </div><!-- /input-group -->
                                            </div><!-- /.col-lg-6 -->
                                        </div><!-- /.row -->

                                        <?php if (isset($data)) $data['idTipoUsuario']; ?>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="form-usernome">Nome</label>
                                    <input type="text" name="nomeUsuario" placeholder="Nome" class="form-username form-control" id="form-nome"
                                           value="<?php if (isset($data)) echo $data['nomeUsuario']; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-usersobrenome">Sobrenome</label>
                                    <input type="text" name="sobrenomeUsuario" placeholder="Sobrenome" class="form-username form-control" id="form-sobrenome"
                                           value="<?php if (isset($data)) echo $data['sobrenomeUsuario']; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-useremail">E-mail</label>
                                    <input type="email" name="email" placeholder="E-mail" class="form-username form-control" id="form-email"
                                           value="<?php if (isset($data)) echo $data['email']; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-usersenha">Senha</label>
                                    <input type="password" name="senha" placeholder="Senha" class="form-password form-control" id="form-password"
                                           value="<?php if (isset($data)) echo md5($data['senha']); ?>" required />
                                </div>
                                <button input type="submit" class="btn" Value="Registrar" name="SendPostForm"/>Registrar</button>									
                            </form>

                            <div class="pull-right">
                                <a href="login.php"><label>Já sou cadastrado</label></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <!-- Javascript -->
        <script src="../vendor/jquery/jquery-1.11.1.min.js"></script>

        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/jquery/jquery.backstretch.min.js"></script>
        <script src="../js/scripts.js"></script>
        
    </body>

</html>
<script>
    setTimeout(function(){
        var msg = document.getElementById("msg-success");
        msg.parentNode.removeChild(msg);
    }, 4000);
</script>