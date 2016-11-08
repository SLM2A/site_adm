<?php

require('../../_app/Config.inc.php');

$readArea = new Read();

$acao = ($_POST['acao'] ? $_POST['acao'] : $_GET['acao']);
//$acao = mysql_real_escape_string($acao);

switch ($acao){
    case 'completar':
        if ($_GET['type'] == 'areaatuacao') {
            $readArea->ExeRead('areaatuacao', "where nomeProfissao like '%" . strtoupper($_GET['name_startsWith']) . "%' Order By nomeProfissao");
            $data = array();
            $id = array();

            for ($i = 0; $i < $readArea->getRowCount(); $i++) {
                array_push($data, $readArea->getResult()[$i]['nomeProfissao']);
            }
            
            echo json_encode($data);
        }  
    break;
    
    case 'pesquisar':
            
        
            $readArea->ExeRead('areaatuacao', "where nomeProfissao like '%" . strtoupper($_GET['name_startsWith']) . "%' Order By nomeProfissao");
            $data = array();
            $id = array();

            for ($i = 0; $i < $readArea->getRowCount(); $i++) {
                array_push($data, $readArea->getResult()[$i]['nomeProfissao']);
            }
            
            echo json_encode($data);   
    break;
    }
?>

