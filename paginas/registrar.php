<?php
session_start();
require('../_app/Config.inc.php');
require '../_app/Includes.php';


//        WSErro("<b>Erro ao cadastrar:</b> Existem campos ogrigatórios sem preencher.", WS_ALERT);
//        WSErro("<b>Erro ao cadastrar:</b> A logo da empresa deve ser em JPG ou PNG e ter exatamente 578x288px", WS_ALERT);
//        WSErro("<b>Sucesso:</b> Empresa cadastrada com sucesso. <a target=\"_blank\" href=\"../empresa/nome_empresa\">Ver Empresa no Site</a>", WS_ACCEPT);        

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);
    $data['senha'] = md5($data['senha']);
    require '../admin/_models/SiteRegistrar.class.php';
    $cadastra = new SiteRegistrar;
    $cadastra->ExeCreate($data);

    if (!$cadastra->getResult()):
        WSErro($cadastra->getError()[0], $cadastra->getError()[1]);
    else:
        header('Location: login.php');
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



        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="../AdminLTE-master/plugins/iCheck/all.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../AdminLTE-master/dist/css/AdminLTE.min.css">

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
                                        <div class="col-sm-6">
                                            <input type="radio"  name="idTipoUsuario" value="1" checked>
                                            <label>Empresário</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="radio" name="idTipoUsuario" value="2" >
                                            <label>Profissional</label>
                                        </div>

                                        <!--                                            <label>
                                                                                        <input type="radio" name="idTipoUsuario" class="flat-red" value="1" checked>
                                                                                        Empresário
                                                                                    </label>
                                                                                    <label>
                                                                                        <input type="radio" name="idTipoUsuario" class="flat-red" value="2" >
                                                                                        Profissional
                                                                                    </label>-->
                                        <?php if (isset($data)) echo $data['idTipoUsuario']; ?>
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
                                    <input type="text" name="email" placeholder="E-mail" class="form-username form-control" id="form-email"
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
        <!-- iCheck 1.0.1 -->
        <script src="../AdminLTE-master/plugins/iCheck/icheck.min.js"></script>

<!--        <script>
            $(function () {
//iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                });
//Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
//Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-orange',
                    radioClass: 'iradio_flat-orange'
                });
            });
        </script>-->

        <script>
            $(document).ready(function () {
                $('input').each(function () {
                    var self = $(this),
                            label = self.next(),
                            label_text = label.text();

                    label.remove();
                    self.iCheck({
                        checkboxClass: 'icheckbox_line-orange',
                        radioClass: 'iradio_line-orange',
                        insert: '<div class="icheck_line-icon"></div>' + label_text
                    });
                });
            });
        </script>

    </body>

</html>
