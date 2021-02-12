<?php

class Notification{
    // variable private
    private $Dado;
    private $Result;

    // variables constants
    const tb_notification = 'post_notification';
    const tb_has_notification = 'departaments_has_post_notification';
    const tb_checkNotification = 'notification';


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
            case 'crd':
                unset($this->Dado['action']);
                $this->Result = $this->notCreate();
            break;
            case 'dup':
                unset($this->Dado['action']);
                $this->Result = $this->notUpdate();
            break;
            case 'ddel':
                unset($this->Dado['action']);
                $this->Result = $this->notDelete();
            break;
            case 'checkpt':
                unset($this->Dado['action']);
                $this->Result = $this->checkPost();
            break;
        }
    }

    // department create
    private function notCreate(){
        $read = new Read();
        $read->ExeRead(self::tb_notification, 'WHERE post_title = :e', "e={$this->Dado['post_title']}");
        
        if(!$read->getResult()){
            
            // check if exists photo profile
            if(isset($_FILES['post_cover'])){
                $profile = new Upload('../../public/img/');
                $profile->Image($_FILES['post_cover']);
                $this->Dado['post_cover'] = $profile->getResult();
            }

            // register the datas in database
            $create = new Create();
            $depart = (!empty($this->Dado['departament']) ? $this->Dado['departament'] : false);
            unset($this->Dado['departament']);

            $create->ExeCreate(self::tb_notification, $this->Dado);
            if($depart){
                $create->ExeCreate(self::tb_has_notification, ['departament' => $depart, 'post' => $create->getResult()]);
            }
            
            // check if created successful
            if($create->getResult()){
                return ['Registro criado com sucesso!', WS_ACCEPT];
            }
        }else{
            return ['Esse registro já existe', WS_ALERT];
        }
    }

    // department update
    private function notUpdate(){
        $read = new Read();
        $read->ExeRead(self::tb_notification, 'WHERE departaments_id = :id', "id={$this->Dado['departaments_id']}");
        if($read->getResult()){
            $this->Dado['departaments_cover'] = $read->getResult()[0]['departaments_cover'];
            // check if exists photo profile
            if(isset($_FILES['departaments_cover'])){
                unlink($read->getResult()[0]['departaments_cover']);
                $profile = new Upload('../../public/img/');
                $profile->Image($_FILES['departaments_cover']);
                $this->Dado['departaments_cover'] = $profile->getResult();
            }

            $update = new Update();
            $update->ExeUpdate(self::tb_notification, $this->Dado, 'WHERE departaments_id = :e', "e={$this->Dado['departaments_id']}");
            if($update->getResult()){
                return ['Atualizado com sucesso!', WS_ACCEPT];
            }
        }
        return ['Não existe registro para ser atualizado!', WS_ALERT];
    }

    // department delete
    private function notDelete(){
        if($this->Dado['id'] && is_numeric($this->Dado['id'])){
            $read = new Read();
            $read->ExeRead(self::tb_notification, 'WHERE id_notification = :id', "id={$this->Dado['id']}");
            if($read->getResult()){
                $delete = new Delete();
                $delete->ExeDelete(self::tb_has_notification, 'WHERE post = :id', "id={$this->Dado['id']}");
                if($delete->getResult()){
                    $delete->ExeDelete(self::tb_notification, 'WHERE id_notification = :i', "i={$this->Dado['id']}");
                    if($delete->getResult()){
                        return ['Deletado com successo!', WS_ACCEPT];
                    }
                }
            }
        }
    }

    // check status post
    private function checkPost(){
        $create = new Create();
        $create->ExeCreate(self::tb_checkNotification, $this->Dado);
        if($create->getResult()){
            return 'ok';
        }
    }
    
}