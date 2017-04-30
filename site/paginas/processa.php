<?php
require_once ('../../_app/Config.inc.php');
require_once ('../../_app/Includes.php');
include 'menuHeader.php';

$termos = $_POST['cidade'];

$readProfissional = new Read();
$readProfissional->FullRead("Select * From usuario u inner join enderecousuario en on u.idUsuario=en.idUsuario inner join habilidadeusuario hu on u.idUsuario=hu.idUsuario inner join areaatuacao aa on hu.idAreaAtuacao=aa.idAreaAtuacao where  (u.idTipoUsuario=2 and en.cidade like '%{$termos}%' and u.situacao=1)");

?>