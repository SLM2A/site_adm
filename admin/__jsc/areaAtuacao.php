<?php

require('../../_app/Config.inc.php');


$readArea = new Read();

if($_GET['type'] == 'areaatuacao'){
    $readArea->ExeRead('areaatuacao', "where nomeProfissao like '%".strtoupper($_GET['name_startsWith'])."%' Order By nomeProfissao");
    $data = array();
    $id = array();
    
    for( $i = 0; $i<$readArea->getRowCount(); $i++ ){  
        array_push($data, $readArea->getResult()[$i]['idAreaAtuacao'].' '. $readArea->getResult()[$i]['nomeProfissao']);
       // array_push($id, $readArea->getResult()[$i]['idAreaAtuacao'], getResult()[$i]['nomeProfissao']);
    }
    echo json_encode($data);
    
}
//echo json_encode($id);

?>