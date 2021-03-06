<?php
//define('HOME', 'http://localhost/cursos/ws_php/modulos/08-classes-auxiliares');

// CONFIGRAÇÕES DO SITE ####################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'slm2@');
define('DBSA', 'wsphp');

// AUTO LOAD DE CLASSES ####################
function __autoload($Class) {

    $cDir = ['Conn', 'Helpers', 'models'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$Class}.class.php") && !is_dir(__DIR__ . "\\{$dirName}\\{$Class}.class.php")):
            include_once (__DIR__ . "\\{$dirName}\\{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

// TRATAMENTO DE ERROS WSPHP #####################
//CSS constantes :: Mensagens de WSErro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//CSS constantes :: Mensagens de RentalErro
define('RENTAL_ACCEPT', 'alert-success');
define('RENTAL_INFOR', 'alert-info');
define('RENTAL_ALERT', 'alert-warning');
define('RENTAL_ERROR', 'alert-danger');

//WSErro :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}

//Rental :: Exibe erros lançados :: Front
function RentalErro ($ErrMsg, $ErrNo, $ErrDie = null) {
    $tipoIcon = ($ErrNo == RENTAL_ACCEPT) ? "fa-check" : ($ErrNo == RENTAL_INFOR ? "fa-info" : ($ErrNo == RENTAL_ALERT ? "fa-warning" : "fa-ban"));
    $tipoErro = ($ErrNo == RENTAL_ACCEPT) ? "Sucesso" : ($ErrNo == RENTAL_INFOR ? "Informação" : ($ErrNo == RENTAL_ALERT ? "Atenção" : "Erro"));
    echo "
            <div class=\"box-body\" id=\"msg-success\">
                <div class=\"alert {$ErrNo} alert-dismissible\">
                    
                    <h4><i class=\"icon fa {$tipoIcon}\"></i> {$tipoErro}</h4>
                    {$ErrMsg}
                </div>
            </div>
         ";
    if ($ErrDie):
        die;
    endif;
}

//Rental :: Exibe modal lançados :: Front
function RentalModal ($TituloModal = null, $MsgModal = null, $BotaoDiscordo = null, $BotaoAceito = null, $ParAceito = null) {
    echo "
           <div class=\"modal\" id=\"myModal\">
      <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
              <span aria-hidden=\"true\">&times;</span></button>
            <h4 class=\"modal-title\">{$TituloModal}</h4>
          </div>
          <div class=\"modal-body\">
            <p>{$MsgModal}</p>
          </div>
          <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-default pull-right-container\" data-dismiss=\"modal\">{$BotaoDiscordo}</button>
            <button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\" onClick=\"{$ParAceito}()\">{$BotaoAceito}</button>
          </div>
        </div>
      </div>
    </div> 
         ";
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}
// TRATAMENTO DE ERROS RENTAL #####################
//CASE constantes :: Mensagens de Erro





set_error_handler('PHPErro');
