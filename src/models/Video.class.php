<?php

class Video{
    private $Dado, $Result;

    const tb_video  = 'videos';

    function __construct($Data){
        $this->Dado = $Data;
        $this->actionData($Data);
    }


    public function getResult(){
        return $this->Result;
    }

    private function actionData($data) {
        switch($data['action']){
            case 'create_video':
                unset($this->Dado['action']);
                $this->Result = $this->addVideo();
            break;
            case 'del_video':
                unset($this->Dado['action']);
                $this->Result = $this->deleteVideo();
            break;
        }
    }

    private function addVideo(){
        $create = new Create();
        $create->ExeCreate(self::tb_video, $this->Dado);
        if($create->getResult()){
            return 'Created video';
        }else{
            return 'Error created Video';
        }
    }

    private function deleteVideo(){
        $read = new Read();
        $read->ExeRead(self::tb_video, 'WHERE videos_id = :id', "id={$this->Dado['id']}");
        if($read->getResult()){
            $delete = new Delete();
            $delete->ExeDelete(self::tb_video, 'WHERE videos_id = :id', "id={$this->Dado['id']}");
            if($delete->getResult()){
                return 'Delete ok';
            }
        }
    }

}