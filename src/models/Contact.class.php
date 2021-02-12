<?php

class Contact{

    private $Dado;

    function __construct($Dados){
        $this->Dado = $Dados;

        switch($this->Dado['action']){
            case 'auto':
                unset($this->Dado['action']);
                $this->homeForm();
            break;
        }
    }

    private function homeForm(){
        if(empty($this->Dado['support_title']) && empty($this->Dado['support_description'])){
            return 'error send email';
        }else{
            $arrayEmail = ['pablo@multivisi.com.br', 'diorge@multivisi.com.br'];
            $result = true;
                        
            for($i = 0; $i < count($arrayEmail); $i++){
                $arr = [
                    'Assunto'        => $this->Dado['support_title'],
                    'Mensagem'       => $this->Dado['support_description'],
                    'RemetenteNome'  => 'Plataforma universidade',
                    'RemetenteEmail' => 'pablo@multivis.com.br',
                    'DestinoNome'    => 'Administradores',
                    'DestinoEmail'   => $arrayEmail[$i]
                ];
    
                $mail = new Email();
                $mail->Enviar($arr);
                $result = ($mail->getResult() ? true : false);
            }
            
            if($result):
                return ['Obrigado por nos enviar uma mensagem, assim que possível entraremos em contato com você.', WS_ACCEPT ];
            endif; 
        }
    }    
}