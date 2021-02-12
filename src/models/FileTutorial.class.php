<?php

class FileTutorial{
    private $Dado,
            $Result;

    const tb_file = 'tutorial_archives';


    function __construct($Dado){
        $this->Dado = $Dado;
        $this->actionData($Dado);
    }

    public function getResult(){ return $this->Result; }

    private function actionData($data) {
        switch($data['action']){
            case 'create_file':
                unset($this->Dado['action']);
                $this->Result = $this->FileProduct();
            break;
            case 'update_file':
                unset($this->Dado['action']);
                $this->Result = $this->updateFile();
            break;
            case 'delete_file':
                unset($this->Dado['action']);
                $this->Result = $this->deleteFile();
            break;
            
            
        }
    }

    private function FileProduct(){
        $read = new Read();
        $read->ExeRead(self::tb_file, 'WHERE archives_name = :n', "n={$this->Dado['archives_name']}");
        if($read->getResult()){
            return ['Name aredy exist', WS_ERROR];
        }else{
           if(isset($_FILES['archives_url']) && !$_FILES['archives_url']['error']){
               $this->Dado['archives_url']  = createFile($_FILES['archives_url'], 'files');  
               $this->Dado['archives_size']  = $_FILES['archives_url']['size'];
           }

           $create = new Create();
           $create->ExeCreate(self::tb_file, $this->Dado);
           if($create->getResult()){
               return ['Create sucessful', WS_ACCEPT];
           }
        }
    }

    private function updateFile(){
        $read = new Read();
        $read->ExeRead(self::tb_file, 'WHERE archives_name = :u AND archives_id != :i', "u={$this->Dado['archives_name']}&i={$this->Dado['archives_id']}");
        if($read->getRowCount()){
           ExDebug('error');
        }else{
            $read->ExeRead(self::tb_file, 'WHERE archives_id = :i', "i={$this->Dado['archives_id']}");
            if($read->getResult()){
                $this->Dado['archives_url'] = $read->getResult()[0]['archives_url'];
                
                if(isset($_FILES['archives_url']) && !$_FILES['archives_url']['error']){
                    unlink('../../public/img/upload/' . $this->Dado['archives_url']);
                    $this->Dado['archives_url'] = createFile($_FILES['archives_url'], 'files');
                    $this->Dado['archives_size']  = $_FILES['archives_url']['size'];
                }

                
                
                $update = new Update();
                $update->ExeUpdate(self::tb_file, $this->Dado, 'WHERE archives_id = :i', "i={$this->Dado['archives_id']}");
                if($update->getResult()){
                    return ['Update sucessfull', WS_ACCEPT];
                }
            }
        }
    }

    private function deleteFile(){
        if(empty($this->Dado['file_id']) && !is_numeric($this->Dado['file_id'])){
            return ['Erro', WS_ERROR];
        }else{
            $read = new Read();
            $delete = new Delete();
            $read->ExeRead(self::tb_file, 'WHERE archives_id = :id', "id={$this->Dado['file_id']}");
            if(!$read->getResult()){
                return ['Any product found!', WS_INFO];
            }else{ 
                $delete->ExeDelete('tutorial_has_archives', 'WHERE tutorial_archives_archives_id = :id', "id={$this->Dado['file_id']}");
                if($delete->getResult()){
                    $delete->ExeDelete(self::tb_file, 'WHERE archives_id = :id', "id={$this->Dado['file_id']}");
                    if(!$delete->getResult()){
                        return ['erro', WS_ERROR];
                    }else{
                        return ['File deleted!', WS_ACCEPT];
                    }
                }
                
            }
        }
    }

    
}