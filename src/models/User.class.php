<?php

class User{
    // variable private
    private $Dado;
    private $Result;

    // variables constants
    const tb_user = 'user';


    // the function construct datas
    function __construct($Dado){
        $this->Dado = $Dado;
        $this->switchApi($this->Dado['action']);
    }

    // get all results
    public function getResult(){ return $this->Result; }

    //switch
    private function switchApi($case){
        switch($case){
            case 'uup':
                unset($this->Dado['action']);
                $this->Result = $this->userUpdate();
            break;
        }
    }


    // user update
    private function userUpdate(){
        $read = new Read();
        $read->ExeRead(self::tb_user, 'WHERE user_id = :id', "id={$this->Dado['user_id']}");
        if($read->getResult()){
            $this->Dado['user_cover'] = $read->getResult()[0]['user_cover'];
            // check if exists photo profile
            if(isset($_FILES['user_cover'])){
                unlink('../../public/img/upload/' . $this->Dado['user_cover']);
                $this->Dado['user_cover'] = createSizesImage($_FILES['user_cover'], 'profile');
            }
            $update = new Update();
            $update->ExeUpdate(self::tb_user, $this->Dado, 'WHERE user_id = :e', "e={$this->Dado['user_id']}");
            if($update->getResult()){
                return ['Atualizado com sucesso!', WS_ACCEPT];
            }
        }
        return ['Não existe registro para ser atualizado!', WS_ALERT];
    }    
}