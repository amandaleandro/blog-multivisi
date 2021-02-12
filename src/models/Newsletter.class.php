<?php


class Newsletter{
    private $Dado,
            $Result;

    const tb_newsletter_body = 'newsletter_body',
          tb_newsletter     = 'newsletter';


    function __construct($Dado){
        $this->Dado = $Dado;

        $this->actionData($Dado);
    }

    public function getResult(){ return $this->Result; }

    private function actionData($data) {
        switch($data['action']){
            case 'create_newsletter':
                unset($this->Dado['action']);
                $this->Result = $this->createNewsletter();
            break;
            case 'update_newsletter':
                unset($this->Dado['action']);
                $this->Result = $this->updateNewsletter();
            break;
            case 'delete_newsletter':
                unset($this->Dado['action']);
                $this->Result = $this->deleteNewsletter();
            break;
        }
    }



    private function createNewsletter(){
        $read = new Read();
        $read->ExeRead(self::tb_newsletter_body, 'WHERE newsletter_title = :n', "n={$this->Dado['newsletter_title']}");
        if($read->getResult()){
            return ['This title aready exist', WS_ERROR];
        }else{
            $create = new Create();
            $create->ExeCreate(self::tb_newsletter_body, $this->Dado);
            if($create->getResult()){
                return ['Created successful', WS_ACCEPT];
            }
        }
    }

    private function updateNewsletter(){
        $read = new Read();
        $read->ExeRead(self::tb_newsletter_body, 'WHERE newsletter_title = :u AND newsletter_id != :i', "u={$this->Dado['newsletter_title']}&i={$this->Dado['newsletter_id']}");
        if($read->getResult()){
            return ['error newsletter update'];
        }else{
            $update = new Update();
            $update->ExeUpdate(self::tb_newsletter_body, $this->Dado, 'WHERE newsletter_id = :id', "id={$this->Dado['newsletter_id']}");
            if($update->getResult()){
                return ['updated newsletter successful', WS_ACCEPT];
            }
        }
    }

    private function deleteNewsletter(){
        $read = new Read();
        $read->ExeRead(self::tb_newsletter_body, 'WHERE newsletter_id = :id', "id={$this->Dado['newsletter_id']}");
        if(!$read->getResult()){
            return ['Sorry dont have newsletter for delete', WS_ERROR];
        }else{
            $delete = new Delete();
            $delete->ExeDelete(self::tb_newsletter_body, 'WHERE newsletter_id = :id', "id={$this->Dado['newsletter_id']}");
            if($delete->getResult()){
                return ['Deleted newsletter succesful', WS_ACCEPT];
            }
        }
    }
}