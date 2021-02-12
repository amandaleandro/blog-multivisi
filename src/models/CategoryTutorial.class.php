<?php

class CategoryTutorial{
    private $Dado,
            $Result;

    const tb_category = 'tutorial_category';


    function __construct($Dado){
        $this->Dado = $Dado;
        $this->actionData($Dado);
    }

    public function getResult(){ return $this->Result; }

    private function actionData($data) {
        switch($data['action']){
            case 'create_category':
                unset($this->Dado['action']);
                $this->Result = $this->categoryTutorial();
            break;
            case 'update_category':
                unset($this->Dado['action']);
                $this->Result = $this->updateCategory();
            break;
            case 'delete_category':
                unset($this->Dado['action']);
                $this->Result = $this->deleteCategory();
            break;
            
        }
    }

    private function categoryTutorial(){
        $read = new Read();
        $read->ExeRead(self::tb_category, 'WHERE category_name = :n', "n={$this->Dado['category_name']}");
        if($read->getResult()){
            return ['Name aredy exist', WS_ERROR];
        }else{
           if(isset($_FILES['category_cover']) && !$_FILES['category_cover']['error']){
               $this->Dado['category_cover']  = createSizesImage($_FILES['category_cover'], 'category');
               
           }

           $create = new Create();
           $create->ExeCreate(self::tb_category, $this->Dado);
           if($create->getResult()){
               return ['Create sucessful', WS_ACCEPT];
           }
        }
    }

    private function updateCategory(){
        $read = new Read();
        $read->ExeRead(self::tb_category, 'WHERE category_name = :u AND category_id != :i', "u={$this->Dado['category_name']}&i={$this->Dado['category_id']}");
        if($read->getRowCount()){
           ExDebug('error');
        }else{
            $read->ExeRead(self::tb_category, 'WHERE category_id = :i', "i={$this->Dado['category_id']}");
            if($read->getResult()){
                $this->Dado['category_cover'] = $read->getResult()[0]['category_cover'];
                if(isset($_FILES['category_cover']) && !$_FILES['category_cover']['error']){
                    unlink('../../public/img/upload/' . $this->Dado['category_cover']);
                    $this->Dado['category_cover'] = createSizesImage($_FILES['category_cover'], 'category');
                }
                
                $update = new Update();
                $update->ExeUpdate(self::tb_category, $this->Dado, 'WHERE category_id = :i', "i={$this->Dado['category_id']}");
                if($update->getResult()){
                    return ['Update sucessfull', WS_ACCEPT];
                }
            }
        }
    }

    private function deleteCategory(){
        if(empty($this->Dado['category_id']) && !is_numeric($this->Dado['category_id'])){
            return ['Erro', WS_ERROR];
        }else{
            $read = new Read();
            $delete = new Delete();
            $read->ExeRead(self::tb_category, 'WHERE category_id = :id', "id={$this->Dado['category_id']}");
            if(!$read->getResult()){
                return ['Any product found!', WS_INFO];
            }else{     
                $delete->ExeDelete('product_has_category', 'WHERE product_category_category_id = :id', "id={$this->Dado['category_id']}");
                if($delete->getResult()){
                    $delete->ExeDelete(self::tb_category, 'WHERE category_id = :id', "id={$this->Dado['category_id']}");
                    if(!$delete->getResult()){
                        return ['erro', WS_ERROR];
                    }else{
                        return ['category deleted!', WS_ACCEPT];
                    }
                }
            }
        }
    }

    
}