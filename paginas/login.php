<!DOCTYPE html>
<?php

require('../_app/Config.inc.php');
require '../_app/Includes.php';

$login = new LoginSite(0);


$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dataLogin['AdminLogin'])):
    $login->ExeLogin($dataLogin);
    if (!$login->getResult()):
        RentalErro($login->getError()[0], $login->getError()[1]);
    else:
        header('Location: ../AdminLTE-master/paginas/index.php ');
    endif;
    
endif;


?>  

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

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Faça seu login</strong> </h1>
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
                                    <h3>Entre com sua conta</h3>
                                    <p>Coloque seu e-mail e senha:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-useremail">E-mail</label>
                                        <input type="text" name="email" placeholder="E-mail" class="form-username form-control" id="form-email"
                                               value="<?php if (isset($data)) echo $data['email']; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-usersenha">Senha</label>
                                        <input type="password" name="senha" placeholder="Senha" class="form-password form-control" id="form-password"
                                               value="<?php if (isset($data)) echo md5($data['senha']); ?>" required />
                                    </div>
                                    <button input type="submit" class="btn" name ="AdminLogin" value="Logar"/>Entre</button>
                                </form>
                                
                                 <div class="pull-right">
                                     <a href="registrar.php"><label>Criar conta</label></a>
                                </div>
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