<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$termos = $_GET['q'];

//$termos_separados = explode(" ", $_GET['q']);
//var_dump($termos_separados);

$readProfissional = new Read();
$readProfissional->FullRead("Select * From usuario u inner join enderecousuario en on u.idUsuario=en.idUsuario inner join habilidadeusuario hu on u.idUsuario=hu.idUsuario inner join areaatuacao aa on hu.idAreaAtuacao=aa.idAreaAtuacao where  (u.idTipoUsuario=2 and aa.descricaoProfissao like '%{$termos}%' and u.situacao=1) or (u.idTipoUsuario=2 and aa.nomeProfissao like '%{$termos}%' and u.situacao=1 )");

//$readTermos = new Read();
//
//$tamanho = count($termos_separados);
//$i=0;
//
//while($i<$tamanho):
//    $separado = $termos_separados[$i];
//    $readTermos->FullRead("Select * From usuario u inner join enderecousuario en on u.idUsuario=en.idUsuario inner join habilidadeusuario hu on u.idUsuario=hu.idUsuario inner join areaatuacao aa on hu.idAreaAtuacao=aa.idAreaAtuacao where  (u.idTipoUsuario=2 and aa.descricaoProfissao like '%{$separado}%') or ( u.idTipoUsuario=2 and u.nomeUsuario like '%{$separado}%') or (u.idTipoUsuario=2 and sobrenomeUsuario like '%{$separado}%') or (u.idTipoUsuario=2 and en.cidade like '%{$separado}%')");
//    $i++;
//endwhile;
//var_dump($readProfissional->getResult());
?>


<section class="content-header">
    <h1>
        Resultados da busca por <b> <?php echo $termos; ?>:</b>
    </h1>
</section>

<section class="content">



<?php
foreach ($readProfissional->getResult() as $usuarios):

    echo "
                <div class=\"col-md-4\">
                  <!-- Widget: user widget style 1 -->
                  <div class=\"box box-widget widget-user\">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class=\"widget-user-header bg-aqua-active\" style=\"background: url('') center center;\">
                      <h3 class=\"widget-user-username\"><b>{$usuarios['nomeUsuario']} {$usuarios['sobrenomeUsuario']}</b></h3>
                     
                    </div>
                    <div class=\"widget-user-image\">
                      <img class=\"img-circle\" src=\"../uploads/{$readUsuario->getResult()[0]['avatar']}\" alt=\"User Avatar\">
                    </div>
                    <div class=\"box-footer\">
                       <div class=\"row\">
                        <div class=\"col-sm-4 border-right\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">Sexo</span>                    
                            <h5 class=\"description-header\">{$usuarios['sexoUsuario']}</h5>                    
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class=\"col-sm-4 border-right\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">PROFISSÃO</span>
                            <h5 class=\"description-header\">{$usuarios['nomeProfissao']}</h5>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class=\"col-sm-4\">
                          <div class=\"description-block\">
                            <span class=\"description-text\">CIDADE</span>
                            <h5 class=\"description-header\">{$usuarios['cidade']}/{$usuarios['estado']}</h5>
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        

                      </div>
                      <!-- /.row -->
                    <hr>
                        <a href=\"perfilProfissionalPublico.php?id={$usuarios['idUsuario']}\" class=\"btn btn-success btn-block\"><b>Ver Currículo Completo </b></a>

                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
                <!-- /.col -->";
endforeach;
?>
</section>       


<div class="row">
<?php include 'menuFooter.php'; ?>