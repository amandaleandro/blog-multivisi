<?php

class FileProduct{
    private $Dado,
            $Result;

    const tb_file = 'product_achives';


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
        $read->ExeRead(self::tb_file, 'WHERE prodarchives_name = :n', "n={$this->Dado['prodarchives_name']}");
        if($read->getResult()){
            return ['Name aredy exist', WS_ERROR];
        }else{
           if(isset($_FILES['prodarchives_link']) && !$_FILES['prodarchives_link']['error']){
               $this->Dado['prodarchives_link']  = createFile($_FILES['prodarchives'], 'files');  
               $this->Dado['prodarchives_size']  = $_FILES['prodarchives']['size'];
           }

           $create = new Create();
           $create->ExeCreate(self::tb_file, $this->Dado);
           if($create->getResult()){
               return ['Create sucessful', WS_ACCEPT];
           }
        }
    }

    private function updateFile(){
        ExDebug($this->Dado);
        $read = new Read();
        $read->ExeRead(self::tb_file, 'WHERE prodarchives_name = :u AND id_prodarchive != :i', "u={$this->Dado['prodarchives_name']}&i={$this->Dado['id_prodarchive']}");
        if($read->getRowCount()){
           ExDebug('error');
        }else{
            $read->ExeRead(self::tb_file, 'WHERE id_prodarchive = :i', "i={$this->Dado['id_prodarchive']}");
            if($read->getResult()){
                $this->Dado['prodarchives_link'] = $read->getResult()[0]['prodarchives_link'];
                
                if(isset($_FILES['prodarchives']) && !$_FILES['prodarchives']['error']){
                    unlink('../../public/img/upload/' . $this->Dado['prodarchives_link']);
                    $this->Dado['prodarchives_link'] = createFile($_FILES['prodarchives'], 'files');
                    $this->Dado['prodarchives_size']  = $_FILES['prodarchives']['size'];
                }

                
                
                $update = new Update();
                $update->ExeUpdate(self::tb_file, $this->Dado, 'WHERE id_prodarchive = :i', "i={$this->Dado['id_prodarchive']}");
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
            $read->ExeRead(self::tb_file, 'WHERE id_prodarchive = :id', "id={$this->Dado['file_id']}");
            if(!$read->getResult()){
                return ['Any product found!', WS_INFO];
            }else{ 
                $delete->ExeDelete('product_has_archives', 'WHERE product_achives_id_prodarchive = :id', "id={$this->Dado['file_id']}");
                if($delete->getResult()){
                    $delete->ExeDelete(self::tb_file, 'WHERE id_prodarchive = :id', "id={$this->Dado['file_id']}");
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