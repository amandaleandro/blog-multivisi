<?php

class Product {
 
    private $Dado,
            $Result;

    const tb_product              = 'product',
          tb_user                 = 'user',
          tb_product_has_category = 'product_has_category',
          tb_product_has_archives = 'product_has_archives',
          tb_product_category     = 'product_category',
          tb_product_files        = 'product_archives';

    function __construct($Data){
        $this->Dado = $Data;
        $this->actionData($Data);
    }


    public function getResult(){
        return $this->Result;
    }

    private function actionData($data) {
        switch($data['action']){
            case 'create_product':
                unset($this->Dado['action']);
                $this->Result = $this->createProduct();
            break;
            case 'update_product':
                unset($this->Dado['action']);
                $this->Result = $this->updateProduct();
            break;
            case 'delete_product':
                unset($this->Dado['action']);
                $this->Result = $this->deleteProduct();
            break;
            case 'consultinhcategory':
                unset($this->Dado['action']);
                $this->Result = $this->returnClickedCategory();
            break;
            case 'search':
                unset($this->Dado['action']);
                $this->Result = $this->search();
            break;
        }
    }

    // Register the datas product in database
    private function createProduct(){
        $read = new Read();

        $read->ExeRead(self::tb_product, 'WHERE product_url = :u', "u={$this->Dado['product_url']}");
        if($read->getResult()){
            return ['The URL product alredy exists', WS_ERROR];
        }else{
           $cat = false;
           $file = false;
           $error = false;

           if(isset($_FILES['product_cover']) && !$_FILES['product_cover']['error']){
                $this->Dado['product_cover'] = createSizesImage($_FILES['product_cover'], 'product', true);
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
            $create->ExeCreate(self::tb_product, $this->Dado); 
            if($create->getResult()){
                $id = $create->getResult();
                $error = false;
            }

            if($cat){
                foreach($cat as $category){
                    $create->ExeCreate(self::tb_product_has_category, ['product_category_category_id' => $category, 'product_product_id' => $id]);
                    if($create->getResult()){
                        $error = false;
                    }
                }
            }
           
            if($file){
                foreach($file as $files){
                    $create->ExeCreate(self::tb_product_has_archives, ['product_achives_id_prodarchive' => $files, 'product_product_id' => $id]);
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

    private function updateProduct(){
        $read = new Read();
        $read->ExeRead(self::tb_product, 'WHERE product_url = :u AND product_id != :i', "u={$this->Dado['product_url']}&i={$this->Dado['product_id']}");
        if($read->getRowCount()){
            return ['Error', WS_ERROR];
        }else{
            $cat = false;
            $file = false;
            $error = false;
            $read->ExeRead(self::tb_product, 'WHERE product_id = :i', "i={$this->Dado['product_id']}");
            if($read->getResult()){
                $this->Dado['product_cover'] = $read->getResult()[0]['product_cover'];

                if(isset($_FILES['product_cover']) && !$_FILES['product_cover']['error']){
                    $exp = explode(',', $this->Dado['product_cover']);
                    foreach($exp as $imgs){ unlink('../../public/img/upload/' . $imgs); }

                    $this->Dado['product_cover'] = createSizesImage($_FILES['product_cover'], 'product', true);
                }

                if(isset($this->Dado['categories'])){
                    $cat = $this->Dado['categories'];
                    unset($this->Dado['categories']);
                }
    
                if(isset($this->Dado['files'])){
                    $file = $this->Dado['files'];
                    unset($this->Dado['files']);
                }


                $this->Dado['product_lastupdate'] = date('Y-m-d H:i:s');
                $update = new Update();
                $update->ExeUpdate(self::tb_product, $this->Dado, 'WHERE product_id = :i', "i={$this->Dado['product_id']}");
                if($update->getResult()){
                    if($cat){
                       $delete = new Delete();
                       $delete->ExeDelete(self::tb_product_has_category, 'WHERE product_product_id = :id', "id={$read->getResult()[0]['product_id']}");
                       if($delete->getResult()){
                           $create = new Create();
                            foreach($cat as $categs){
                                $create->ExeCreate(self::tb_product_has_category, ['product_category_category_id' => $categs, 'product_product_id' => $read->getResult()[0]['product_id']]);
                            }
                        } 
                    }else{
                        $delete = new Delete();
                        $delete->ExeDelete(self::tb_product_has_category, 'WHERE product_product_id = :id', "id={$read->getResult()[0]['product_id']}");
                    }

                    if($file){
                        $delete = new Delete();
                        $delete->ExeDelete(self::tb_product_has_archives, 'WHERE product_product_id = :id', "id={$read->getResult()[0]['product_id']}");
                        if($delete->getResult()){
                            $create = new Create();
                             foreach($file as $fil){
                                 $create->ExeCreate(self::tb_product_has_archives, ['product_achives_id_prodarchive' => $fil, 'product_product_id' => $read->getResult()[0]['product_id']]);
                             }
                         } 
                     }else{
                         $delete = new Delete();
                         $delete->ExeDelete(self::tb_product_has_archives, 'WHERE product_product_id = :id', "id={$read->getResult()[0]['product_id']}");
                     }

                     return ['Updated succesfull', WS_ACCEPT];
                }
            }
        }
    }

    private function deleteProduct(){
        if(empty($this->Dado['product_id']) && !is_numeric($this->Dado['product_id'])){
            return ['Error', WS_ERROR];
        }else{
            $read = new Read();
            $read->ExeRead(self::tb_product, 'WHERE product_id = :id', "id={$this->Dado['product_id']}");
            if($read->getResult()){
                $delete = new Delete();
                $delete->ExeDelete(self::tb_product, 'WHERE product_id = :id', "id={$this->Dado['product_id']}");
                if($delete->getResult()){
                    return ['Product deleted successful', WS_ACCEPT];
                }
            }else{
                return ['not found product!', WS_ALERT];
            }
        }
    }

    private function returnClickedCategory(){
        $id = $this->Dado['id'];
        $read = new Read();
        $read->ExeRead(self::tb_product_has_category, 'WHERE product_category_category_id = :id', "id={$id}");
        if($read->getResult()){
            foreach($read->getResult() as $category){
                $read->ExeRead(self::tb_product, 'WHERE product_id = :id', "id={$category['product_product_id']}");
                if($read->getResult()){
                    $x[] = $read->getResult();
                }
            }

            return $x;
        }
    }

    private function search(){
        $txt = $this->Dado['text'];

        $read = new Read();
        //$read->FullRead("SELECT * FROM product WHERE product_name like '%".$txt."%'");
        $read->FullRead("(SELECT * FROM product WHERE product_name like '%".$txt."%') UNION
                        (SELECT * FROM tutorial WHERE tutorial_title like '%".$txt."%')");
        if($read->getResult()){
            return $read->getResult();
        }
    }
}