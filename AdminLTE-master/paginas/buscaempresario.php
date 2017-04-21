<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$termos = $_GET['q'];

$readProfissional = new Read();
$readProfissional->FullRead("Select * From usuario u inner join enderecousuario en on u.idUsuario=en.idUsuario inner join habilidadeusuario hu on u.idUsuario=hu.idUsuario inner join areaatuacao aa on hu.idAreaAtuacao=aa.idAreaAtuacao where  (u.idTipoUsuario=2 and aa.descricaoProfissao like '%{$termos}%' and u.situacao=1) or (u.idTipoUsuario=2 and aa.nomeProfissao like '%{$termos}%' and u.situacao=1 )");

?>


<section class="content-header">
    <h1>
        Resultados da busca por <b> <?php echo $termos; ?>:</b>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Estado</label>
                <select class="form-control select2" style="width: 100%;" disabled="">
                    <option selected disabled>São Paulo</option>
                    
                </select>
            </div>
        </div>
        <form>
        <div class="col-md-6">
            <div class="form-group">
                <label>Cidade</label>
                
                <select class="form-control select2 j_loadcity" style="width: 100%;">
                    <option selected="selected" disabled="">Escolha a Cidade</option>
                    <?php
                        $readState = new Read;
                        $readState->ExeRead("app_cidades", "WHERE estado_id=25 ORDER BY cidade_nome ASC");
                        foreach ($readState->getResult() as $estado):
                            extract($estado);
                            echo "<option value=\"{$cidade_id}\"> {$cidade_nome} </option>";
                        endforeach;
                        ?>  
                </select>
            </div>
        </div>
        </form>
    </div>
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

    <script type="text/javascript">
        $(document).ready(function(){
                $.(#cidade).keyup(function(){
                    $('form').submit(function(){
                        var dados = $(this).serialize();
                        $.ajax({
                            url: 'processa.php',
                            type: 'POST',
                            dataType: 'html',
                            data: dados,
                            success: function (data) {
                                $('resultado').empty().html(data);
                        }
                            
                        });
                        return false;
                    });
                    $('form').trigger('submit');
                });
                
        )}; 
        
    </script>