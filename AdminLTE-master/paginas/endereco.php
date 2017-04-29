<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';



$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($data['SendPostForm'])):
    unset($data['SendPostForm']);

    $data['idUsuario'] = $userlogin['idUsuario'];

    require '../../admin/_models/AdminEndereco.php';
    $cadastra = new AdminEndereco;
    $readEndereco = new Read;
    $readEndereco->ExeRead('enderecousuario', "WHERE idUsuario = :t", "t={$userlogin['idUsuario']}");

//verifica se existe um endereço cadastrado para o usuario, se existir ele atualiza, se nao existir cria um novo.
    if ($readEndereco->getResult()):
        $idEndereco = (int) $readEndereco->getResult()[0]['idEndereco'];
        $cadastra->ExeUpdate($idEndereco, $data);
    else:
        $cadastra->ExeCreate($data);
    endif;

    if ($cadastra->getError()):
        $_SESSION['userlogin']['msg'] = $cadastra->getError()[0];
        $_SESSION['userlogin']['tipoMsg'] = $cadastra->getError()[1];
    endif;
    
echo "<script>location.href='endereco.php';</script>";

else:
    $readEndereco = new Read;
    $readEndereco->ExeRead("enderecousuario", "WHERE idUsuario = :id", "id={$userlogin['idUsuario']}");
    if ($readEndereco->getResult()):
        $data = $readEndereco->getResult()[0];
    endif;
endif;
?>

<section class="content-header">
    <h1> <i class="fa fa-map-marker"></i> Localização</h1> 
</section>

<!-- Main content -->
<section class="content">
    <form role="form" action="" method="post" class="login-form">
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->

                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->

                    <div class="box-body box-profile" id="sales-chart" >

                        <div class="form-group">
                            <section class="col-lg-12 connectedSortable">

                                <label>CEP:</label>
                                <input type="text" id="cep" class="form-control" name="cep" value="<?php if (isset($data)) echo $data['cep']; ?>" required>
                                <label>Endereço:</label>
                                <input type="text" id="rua" class="form-control" name="logradouro" value="<?php if (isset($data)) echo $data['logradouro']; ?>" >
                                <label>Número:</label>
                                <input type="text" maxlength=10  class="form-control"  name="numero" value="<?php if (isset($data)) echo $data['numero']; ?>" required>
                                <label>Complemento:</label>
                                <input type="text" maxlength=60  class="form-control" name="complemento" value="<?php if (isset($data)) echo $data['complemento']; ?>" >
                                <label>Bairro:</label>
                                <input type="text" id="bairro" class="form-control" name="bairro" value="<?php if (isset($data)) echo $data['bairro']; ?>" >
                                <label>Cidade:</label>
                                <input type="text" id="cidade" class="form-control" name="cidade" value="<?php if (isset($data)) echo $data['cidade']; ?>" >
                                <label>Estado:</label>
                                <input type="text" id="uf"  class="form-control" name="estado" value="<?php if (isset($data)) echo $data['estado']; ?>" >
                            </section>
                        </div>

                    </div>
                </div>
            </div>        
        </section>



        <section class="col-lg-12 connectedSortable ">
            <button input type="submit" class="btn btn-block btn-success btn-lg" value="Cadastrar" name="SendPostForm"><i class="fa fa-floppy-o"></i> Salvar</button>
        </section>
    </form>

    <center> 
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li>
                    <a href="redeSocial.php" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <li><a href="perfil.php"><i class="ion-person"></i> Perfil</a></li>
                <li><a href="redeSocial.php"><i class="fa fa-commenting-o"></i> Redes Sociais</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Localização</a></li>
                <li><a href="experiencia.php"><i class="ion-briefcase"></i> Experiências</a></li>
                <li><a href="certificacao.php"><i class="fa fa-graduation-cap"></i> Certificados</a></li>
                <li><a href="competencia.php"><i class="fa fa-toggle-off"></i> Competências</a></li>
                <li>
                    <a href="experiencia.php" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </center>

    <div class="row">

<?php include 'menuFooter.php'; ?>