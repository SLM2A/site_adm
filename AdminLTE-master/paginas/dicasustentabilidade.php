<?php

require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$readSustentabilidade = new Read();
$readSustentabilidade->FullRead("SELECT * FROM dicasustentabilidade");
?>



<section class="content-header">
        <h1> <i class="fa fa-leaf"></i> Dicas de Sustentabilidade</h1>
</section>


<section class="content">
<?php
foreach($readSustentabilidade->getResult() as $item):

    echo "
<div class=\"col-lg-4 connectedSortable\">
    <div class=\"alert alert-success alert-dismissible\" style='height: 200px;'>

                <h4><i class=\"icon fa fa-leaf\"></i> </h4>
                {$item['dica']}
              </div></div>";
endforeach;

?>

</section>



<div class="row">
<?php include 'menuFooter.php'; ?>