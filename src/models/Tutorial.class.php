<?php

class Tutorial{
    // variable private
    private $Dado;
    private $Result;

    // variables constants
    const tb_tutorial = 'tutorial',
          tb_tutorial_archives = 'tutorial_archives',
          tb_tutorial_category = 'tutorial_category',
          tb_tutorial_has_archives = 'tutorial_has_archives',
          tb_tutorial_has_category = 'tutorial_has_category';


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
            case 'tutorial_create':
                unset($this->Dado['action']);
                $this->Result = $this->depCreate();
            break;
            case 'tutorial_update':
                unset($this->Dado['action']);
                $this->Result = $this->depUpdate();
            break;
            case 'tutorial_delete':
                unset($this->Dado['action']);
                $this->Result = $this->depDelete();
            break;
            case 'consultinhcategory':
                unset($this->Dado['action']);
                $this->Result = $this->returnClickedCategory();
            break;
        }
    }

    // tutorial create
    private function depCreate(){
        $read = new Read();

        $read->ExeRead(self::tb_tutorial, 'WHERE tutorial_url = :u', "u={$this->Dado['tutorial_url']}");
        if($read->getResult()){
            return ['The URL tutorial alredy exists', WS_ERROR];
        }else{
           $cat = false;
           $file = false;
           $error = false;

           if(isset($_FILES['tutorial_cover']) && !$_FILES['tutorial_cover']['error']){
                $this->Dado['tutorial_cover'] = createSizesImage($_FILES['tutorial_cover'], 'tutorial', true);
            }

            if(isset($this->Dado['categories'])){
                $cat = $this->Dado['categories'];
                unset($this->Dado['categories']);
            }

            if(isset($this->Dado['files'])){
                $file = $this->Dado['files'];
                unset($this->Dado['files']);
            }


            $create = new Create();
            $create->ExeCreate(self::tb_tutorial, $this->Dado); 
            if($create->getResult()){
                $id = $create->getResult();
                $error = false;
            }

            if($cat){
                foreach($cat as $category){
                    $create->ExeCreate(self::tb_tutorial_has_category, ['tutorial_category_category_id' => $category, 'tutorial_tutorial_id' => $id]);
                    if($create->getResult()){
                        $error = false;
                    }
                }
            }
           
            if($file){
                foreach($file as $files){
                    $create->ExeCreate(self::tb_tutorial_has_archives, ['tutorial_archives_archives_id' => $files, 'tutorial_tutorial_id' => $id]);
                    if($create->getResult()){
                        $error = false;
                    }
                }
            }

            if(!$error){
                return ['Create Sucessful', WS_ACCEPT];
            }
        } 
    }

    // tutorial update
    private function depUpdate(){
        $read = new Read();
        $read->ExeRead(self::tb_tutorial, 'WHERE tutorial_url = :u AND tutorial_id != :i', "u={$this->Dado['tutorial_url']}&i={$this->Dado['tutorial_id']}");
        if($read->getRowCount()){
           ExDebug('error');
        }else{
            $cat = false;
            $file = false;
            $error = false;
            $read->ExeRead(self::tb_tutorial, 'WHERE tutorial_id = :i', "i={$this->Dado['tutorial_id']}");
            if($read->getResult()){
                $this->Dado['tutorial_cover'] = $read->getResult()[0]['tutorial_cover'];

                if(isset($_FILES['tutorial_cover']) && !$_FILES['tutorial_cover']['error']){
                    $exp = explode(',', $this->Dado['tutorial_cover']);
                    foreach($exp as $imgs){ unlink('../../public/img/upload/' . $imgs); }

                    $this->Dado['tutorial_cover'] = createSizesImage($_FILES['tutorial_cover'], 'tutorial', true);
                }

                if(isset($this->Dado['categories'])){
                    $cat = $this->Dado['categories'];
                    unset($this->Dado['categories']);
                }
    
                if(isset($this->Dado['files'])){
                    $file = $this->Dado['files'];
                    unset($this->Dado['files']);
                }


                $this->Dado['tutorial_lastupdate'] = date('Y-m-d H:i:s');
                $update = new Update();
                $update->ExeUpdate(self::tb_tutorial, $this->Dado, 'WHERE tutorial_id = :i', "i={$this->Dado['tutorial_id']}");
                if($update->getResult()){
                    if($cat){
                       $delete = new Delete();
                       $delete->ExeDelete(self::tb_tutorial_has_category, 'WHERE tutorial_tutorial_id = :id', "id={$read->getResult()[0]['tutorial_id']}");
                       if($delete->getResult()){
                           $create = new Create();
                            foreach($cat as $categs){
                                $create->ExeCreate(self::tb_tutorial_has_category, ['tutorial_category_category_id' => $categs, 'tutorial_tutorial_id' => $read->getResult()[0]['tutorial_id']]);
                            }
                        } 
                    }else{
                        $delete = new Delete();
                        $delete->ExeDelete(self::tb_tutorial_has_category, 'WHERE tutorial_tutorial_id = :id', "id={$read->getResult()[0]['tutorial_id']}");
                    }

                    if($file){
                        $delete = new Delete();
                        $delete->ExeDelete(self::tb_tutorial_has_archives, 'WHERE tutorial_tutorial_id = :id', "id={$read->getResult()[0]['tutorial_id']}");
                        if($delete->getResult()){
                            $create = new Create();
                             foreach($file as $fil){
                                 $create->ExeCreate(self::tb_tutorial_has_archives, ['tutorial_archives_archives_id' => $fil, 'tutorial_tutorial_id' => $read->getResult()[0]['tutorial_id']]);
                             }
                         } 
                     }else{
                         $delete = new Delete();
                         $delete->ExeDelete(self::tb_tutorial_has_archives, 'WHERE tutorial_tutorial_id = :id', "id={$read->getResult()[0]['tutorial_id']}");
                     }

                     return ['Updated succesfull', WS_ACCEPT];
                }
            }
        }
    }

    // tutorial delete
    private function depDelete(){
        if(empty($this->Dado['tutorial_id']) && !is_numeric($this->Dado['tutorial_id'])){
            return ['Error', WS_ERROR];
        }else{
            $read = new Read();
            $read->ExeRead(self::tb_tutorial, 'WHERE tutorial_id = :id', "id={$this->Dado['tutorial_id']}");
            if($read->getResult()){
                $delete = new Delete();
                $delete->ExeDelete(self::tb_tutorial, 'WHERE tutorial_id = :id', "id={$this->Dado['tutorial_id']}");
                if($delete->getResult()){
                    return ['Product deleted successful', WS_ACCEPT];
                }
            }else{
                return ['not found product!', WS_ALERT];
            }
        }
    }


    // load category clicked
    private function returnClickedCategory(){
        $id = $this->Dado['id'];
        $read = new Read();
        $read->ExeRead(self::tb_tutorial_has_category, 'WHERE tutorial_category_category_id = :id', "id={$id}");
        if($read->getResult()){
            foreach($read->getResult() as $category){
                $read->ExeRead(self::tb_tutorial, 'WHERE tutorial_id = :id', "id={$category['tutorial_tutorial_id']}");
                if($read->getResult()){
                    $x[] = $read->getResult();
                }
            }

            return $x;
        }
    }
    
}