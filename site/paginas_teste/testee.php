<?php
require_once('../../_app/Config.inc.php');
require_once('../../_app/Includes.php');
include 'menuHeader.php';
?>

<select name="estado"> 
   <?php
                        $readState = new Read;
                        $readState->ExeRead("app_estados", "ORDER BY estado_nome ASC");
                        foreach ($readState->getResult() as $estado):
                            extract($estado);                             
                            echo "<option value=\"{$estado_id}\"> {$estado_uf} / {$estado_nome} </option>";
                        endforeach;                        
                        ?>  
</select>
<br>
<select name="cidades">
<option class="ma" value="cidade1">Cidade 1</option> 
  <option class="ma" value="cidade1">Cidade 2</option> 
  <option class="sp" value="cidade1">Cidade 3</option> 
  <option class="ro"  value="cidade1">Cidade 4</option> 
  <option class="ro" value="cidade1">Cidade 5</option> 
  <option class="ma" value="cidade1">Cidade 6</option> 
  <option class="sp" value="cidade1">Cidade 7</option> 
  <option class="ro" value="cidade1">Cidade 8</option> 
  <option class="sp" value="cidade1">Cidade 9</option> 
</select>

<?php include 'menuFooter.php'; ?>
<script>

$('[name="estado"]').click(function(){

// ocultando todas
$('[name="cidades"] option').css('display', 'none');
 
// exibindo as do estado selecionado
$('[name="cidades"] .' + $(this).val()).css('display', '');

});

</script>
