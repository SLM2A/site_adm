<?php
/**
 * Login.class [ MODEL]
 * Responsavel por autenticar, validar, e checar usuário do sistema de login!
 * 
 * @category (c) 2016, Marcelo Lima.
 */

class LoginSite {
    
    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;
    
    /**
     * <b>Informa Level</b> Informa o nível de acesso minimo para a área a ser protegida.
     * @param INT $Level = Nível mínimo para acesso.
     */
    function __construct($Level) {
        $this->Level = (int) $Level;
    }
    
    /**
     * <b>Efetua Login:</b>
     * @param array $UserData
     */
    public function ExeLogin(array $UserData) {
        $this->Email = (string) strip_tags(trim($UserData['email']));
        $this->Senha = (string) strip_tags(trim($UserData['senha'])); 
        $this->setLogin();
    }
    
    function getResult() {
        return $this->Result;
    }
    
    function getError() {
        return $this->Error;
    }
    
    public function CheckLogin() {
        if (empty($_SESSION['userlogin']) || $_SESSION['userlogin']['idTipoUsuario'] < $this->Level):
            unset($_SESSION['userlogin']);
            return false;
        else:
            return true;
        endif;
    }
    
    
    /**
     * Verifica os dados para liberar acesso.
     */
    private function setLogin() {
        if(!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe seu E-mail e senha para efetuar o login!', WS_INFOR];
            $this->Result = false;
        elseif(!$this->getUser()):
            $this->Error = ['Os dados informados não são compatíveis!', WS_ALERT];
            $this->Result = false;
        elseif($this->Result['idTipoUsuario']< $this->Level):
            $this->Error = ["Desculpe {$this->Result['nomeUsuario']}, você nao tem permissão para acessar esta área!", WS_ERROR];
            $this->Result = false;
        else:
            $this->Execute();
        endif;    
    }
    
    
    /**
     * Resgata o usuario do banco
     */
    private function getUser() {
        $this->Senha = md5($this->Senha);
        
        $read = new Read;
        $read->ExeRead("usuario", "WHERE email = :e AND senha = :p", "e={$this->Email}&p={$this->Senha}");
        if($read->getResult()):
            $this->Result = $read->getResult()[0];
            return TRUE;
        else:
            return FALSE;
        endif;
    }
    
    private function Execute() {
        if(!session_id()):
            session_start();
        endif;
        
        $_SESSION['userlogin'] = $this->Result;
        $this->Error = ["Olá {$this->Result['nomeUsuario']}, seja bem vindo(a). Aguarde redirecionamento!", WS_ACCEPT];
        $this->Result = true; 
    }    
}