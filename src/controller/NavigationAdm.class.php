<?php

class NavigationAdm {
    private $URL,
            $Page,
            $cssJs,
            $Dado;

    // construct
    function __construct(){
        // get url param
        $this->URL = explode('/', strtolower(strip_tags(trim(filter_input(INPUT_GET, 'page', FILTER_DEFAULT)))));

        $this->navPage();
    }

    // Gets
    public function getPage(){ return $this->Page; }
    public function getCssJs(){ return $this->cssJs; }
    public function getDado(){ return $this->Dado; }


    // Sets
    private function navPage(){
        $read = new Read();
        $read->ExeRead('level_user', 'WHERE level_user = :id', "id={$_SESSION['userlogin']['level_user']}");
        if($read->getResult()){
            $this->Dado['level_user'] = $read->getResult();
        }

        $read->ExeRead('user', 'WHERE user_id = :id', "id={$_SESSION['userlogin']['user_id']}");
        if($read->getResult()){
            $this->Dado['usering'] = $read->getResult();
        }
       
        if(empty($this->URL[0])){
            $this->Page = PATH . 'private' . PHPBAR . 'dashboard.php';
            $this->retuns('dash');
        }elseif(is_dir(PATH . 'private' . PHPBAR . $this->URL[0])){
            $this->retuns($this->URL[0]);
        }else{
            $this->Page = PATH . '404.php';
        }
    }

    private function retuns($param){
        switch($param){
            case 'dash':
                $this->cssJs['css'] = '<link rel="/public/css/backend/dash.css">';
                $this->cssJs['js'] = '<script src="/public/js/private/dashboard.js"></script>';

                $this->Dado['products'] = 0;
                $this->Dado['tutorial'] = 0;
                $this->Dado['newsletter'] = 0;

                $read = new Read();
                $read->ExeRead('product');
                if($read->getResult()){
                    $this->Dado['products'] = $read->getResult();
                }

                $read->ExeRead('tutorial');
                if($read->getResult()){
                    $this->Dado['tutorial'] = $read->getResult();
                }

                $read->ExeRead('newsletter');
                if($read->getResult()){
                    $this->Dado['newsletter'] = $read->getResult();
                }
            break;
            case 'tutorials':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'tutorials' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/tutorials/index.js"></script>';

                    $read = new Read();
                    $read->ExeRead('tutorial');
                    if($read->getResult()){
                        $this->Dado['tutorials'] = $read->getResult();
                    }
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                    $this->Page = PATH . 'private' . PHPBAR . 'tutorials' . PHPBAR . 'create.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/create.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/tutorials/create.js"></script>';

                    $this->Dado['tutorial'] = null;
                    $this->Dado['check_category'] = null;
                    $this->Dado['check_files'] = null;
                    $this->Dado['tutorial_category'] = null;
                    $this->Dado['tutorial_files'] = null;

                    // Categories
                    $read = new Read();
                    $read->ExeRead('tutorial_category', 'WHERE category_status = 1 ORDER BY category_id DESC');
                    if($read->getResult()){
                        $this->Dado['tutorial_category'] = $read->getResult();
                    }

                    //files
                    $read->ExeRead('tutorial_archives');
                    if($read->getResult()){
                        $this->Dado['tutorial_files'] = $read->getResult();
                    }

    
                    if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                        $read->ExeRead('tutorial', 'WHERE tutorial_id = :id', "id={$this->URL[2]}");
                        if($read->getResult()){ 
                            $this->Dado['tutorial'] = $read->getResult(); 

                            $read->ExeRead('tutorial_has_category', 'WHERE tutorial_tutorial_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){
                                $this->Dado['check_category'] = $read->getResult();
                            }

                            $read->ExeRead('tutorial_has_archives', 'WHERE tutorial_tutorial_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){
                                $this->Dado['check_files'] = $read->getResult();
                            }
                        } 
                    } 
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'category_tutorials':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'category_tutorials' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/category/index.js"></script>';

                    $read = new Read();
                    $read->ExeRead('tutorial_category');
                    if($read->getResult()){
                        $this->Dado['category'] = $read->getResult();
                    }
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                  
                        $this->Page = PATH . 'private' . PHPBAR . 'category_tutorials' . PHPBAR . 'create.php';
                        $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/create.css">';
                        $this->cssJs['js'] = '<script src="/public/js/private/tutorials/category.js"></script>';
                        $this->Dado['tutorial_category'] = null;
                        if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                            $read = new Read();
                            
                            $read->ExeRead('tutorial_category', 'WHERE category_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){ $this->Dado['tutorial_category'] = $read->getResult(); } 
                        } 
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'products':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'products' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/product/index.js"></script>';

                    $read = new Read();
                    $read->ExeRead('product');
                    $this->Dado['product'] = null;
                    if($read->getResult()){
                        $this->Dado['product'] = $read->getResult();
                    }
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                  
                    $this->Page = PATH . 'private' . PHPBAR . 'products' . PHPBAR . 'create.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/create.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/product/create.js"></script>';

                    $this->Dado['product'] = null;
                    $this->Dado['check_category'] = null;
                    $this->Dado['check_files'] = null;
                    $this->Dado['product_category'] = null;
                    $this->Dado['product_files'] = null;

                    // Categories
                    $read = new Read();
                    $read->ExeRead('product_category', 'WHERE category_status = 1 ORDER BY category_id DESC');
                    if($read->getResult()){
                        $this->Dado['product_category'] = $read->getResult();
                    }

                    //files
                    $read->ExeRead('product_achives');
                    if($read->getResult()){
                        $this->Dado['product_files'] = $read->getResult();
                    }

    
                    if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                        $read->ExeRead('product', 'WHERE product_id = :id', "id={$this->URL[2]}");
                        if($read->getResult()){ 
                            $this->Dado['product'] = $read->getResult(); 

                            $read->ExeRead('product_has_category', 'WHERE product_product_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){
                                $this->Dado['check_category'] = $read->getResult();
                            }

                            $read->ExeRead('product_has_archives', 'WHERE product_product_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){
                                $this->Dado['check_files'] = $read->getResult();
                            }
                        } 
                    } 
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'category_product':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'category_product' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/category/index.js"></script>';

                    $read = new Read();
                    $read->ExeRead('product_category');
                    if($read->getResult()){
                        $this->Dado['category'] = $read->getResult();
                    }
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                  
                        $this->Page = PATH . 'private' . PHPBAR . 'category_product' . PHPBAR . 'create.php';
                        $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/create.css">';
                        $this->cssJs['js'] = '<script src="/public/js/private/product/category.js"></script>';

                        $this->Dado['product_category'] = null;

                        if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                            $read = new Read();
                            $read->ExeRead('product_category', 'WHERE category_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){ $this->Dado['product_category'] = $read->getResult(); } 
                        } 
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'files_tutorial':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'files_tutorial' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/tutorials/files.js"></script>';
                    $read = new Read();
                    $read->ExeRead('tutorial_archives');
                    if($read->getResult()){
                        $this->Dado['files'] = $read->getResult();                        
                    }
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                  
                        $this->Page = PATH . 'private' . PHPBAR . 'files_tutorial' . PHPBAR . 'create.php';
                        $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/create.css">';
                        $this->cssJs['js'] = '<script src="/public/js/private/tutorials/files.js"></script>';
    
                        if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                            $read = new Read();
                            $read->ExeRead('tutorial_archives', 'WHERE archives_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){ $this->Dado['tutorial_files'] = $read->getResult(); } 
                        } 
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'files_product':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'files_product' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/file/index.js"></script>';
                    $read = new Read();
                    $read->ExeRead('product_achives');
                    if($read->getResult()){
                  
                        $this->Dado['product_files'] = null;                       
                    }
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                  
                        $this->Page = PATH . 'private' . PHPBAR . 'files_product' . PHPBAR . 'create.php';
                        $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/create.css">';
                        $this->cssJs['js'] = '<script src="/public/js/private/product/files.js"></script>';
                        $this->Dado['product_files'] = null;
    
                        if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                            $read = new Read();
                            $read->ExeRead('product_achives', 'WHERE id_prodarchive = :id', "id={$this->URL[2]}");
                           
                            if($read->getResult()){ $this->Dado['product_files'] = $read->getResult(); } 
                        } 
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'newsletter':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'newsletter' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/newsletter/createBody.js"></script>';
                    $this->Dado['email_body'] = null;
                    $read = new Read();
                    $read->ExeRead('newsletter_body');
                    if($read->getResult()){
                        $this->Dado['email_body'] = $read->getResult();
                    }
                   
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                    if($this->URL[1] == 'createbody'){
                        $this->Dado['email_body'] = null;
                        $this->Page = PATH . 'private' . PHPBAR . 'newsletter' . PHPBAR . 'createBody.php';
                        $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/newsletter/createBody.css">';
                        $this->cssJs['js'] = '<script src="/public/js/private/newsletter/createBody.js"></script>';
    
                        if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                            $read = new Read();
                            $read->ExeRead('newsletter_body', 'WHERE newsletter_id = :id', "id={$this->URL[2]}");
                            if($read->getResult()){ $this->Dado['email_body'] = $read->getResult(); } 
                        } 
                    }elseif($this->URL[1] == 'email_shot'){
                        $this->Page = PATH . 'private' . PHPBAR . 'newsletter' . PHPBAR . 'email_shot.php';
                    }
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'event':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'event' . PHPBAR . 'index.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/index.css">';
                    $this->cssJs['js'] = '<script src="/public/js/private/event/create.js"></script>';
                    $this->Dado['pagination'] = 0;
                    $this->Dado['events'] = null;
                    $read = new Read();
                    $read->ExeRead('events');
                    if($read->getResult()){
                        $this->Dado['events'] = $read->getResult();

                        $pagination = (!empty($this->Dado['events']) ? ceil(count($this->Dado['events']) / 10) : 1);
                        $this->Dado['pagination'] = $pagination;
                    }
                }elseif(file_exists(PATH . 'private' . PHPBAR . $this->URL[0]  . PHPBAR . $this->URL[1] .'.php')){
                    $this->Dado['event'] = null;
                    $this->Page = PATH . 'private' . PHPBAR . 'event' . PHPBAR . 'create.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/product/create.css">' .
                    $this->cssJs['css'] = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">' .
                    $this->cssJs['css'] = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">';
                    
                    $this->cssJs['js'] = '<script src="/public/js/private/event/create.js"></script>' . 
                    $this->cssJs['js'] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>';

    
                    if(!empty($this->URL[2]) && is_numeric($this->URL[2]) && $this->URL[2] > 0){
                        $read = new Read();
                        $read->ExeRead('events', 'WHERE event_id = :id', "id={$this->URL[2]}");
                        if($read->getResult()){ 
                            $this->Dado['event'] = $read->getResult(); 
                        } 
                    } 
                }else{
                    $this->Page = PATH . '404.php';
                }
            break;
            case 'support':
                $this->Page = PATH . 'private' . PHPBAR . 'support' . PHPBAR . 'index.php';
                $this->cssJs['css'] = null;
                $this->cssJs['js'] = '<script src="/public/js/private/support.js"></script>';
            break;
            case 'profile':
                $this->Page = PATH . 'private' . PHPBAR . 'profile' . PHPBAR . 'index.php';
                $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/backend/user.css">';
                $this->cssJs['js'] = '<script src="/public/js/private/user.js"></script>';
              
                $read = new Read();
                $read->ExeRead('user', 'WHERE user_id = :id', "id={$_SESSION['userlogin']['user_id']}");
                if($read->getResult()){
                    $this->Dado['user'] = $read->getResult();
                }
            break;
            case 'videos':
                if(empty($this->URL[1])){
                    $this->Page = PATH . 'private' . PHPBAR . 'videos' . PHPBAR . 'index.php';
                    $read = new Read();
                    $read->ExeRead('videos');
                    $this->Dado['videos'] = null;
                    if($read->getResult()){
                        $this->Dado['videos'] = $read->getResult();
                    }
                }else{
                    $this->Page = PATH . 'private' . PHPBAR . 'videos' . PHPBAR . 'create.php';
                }
                $this->cssJs['css'] = null;
                $this->cssJs['js'] = '<script src="/public/js/private/videos.js"></script>';
            break;
        }
    }
}