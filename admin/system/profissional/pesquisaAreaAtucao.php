<?php

$conn = mysqli_connect('localhost', 'root', '', 'wsphp');
$search = mysqli_real_escape_string($conn, $_GET['term']);
$qr = "SELECT * FROM areaatuacao WHERE nome LIKE '%$search%' Order by nomeProfissao";
$ex = mysqli_query($conn, $qr);
        
        $resJson="[";
        $first = true;
     
        while($res = mysql_fetch_assoc($ex)):
            if(!$first):
                $resJson .=', ';
            else:
                $first = false;
            endif;
           
        $resJson .= json_encode($res['nomeProfissao']);  
        
        endwhile;      
                
       $resJson .=']';
       
       echo $resJson;
?>