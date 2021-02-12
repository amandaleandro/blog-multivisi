<?php

class Navigation {
    private $URL,
            $Template = PATH . 'index.php',
            $Page,
            $cssJs,
            $Dado;

    // construct
    function __construct()
    {
        // get url param
        $this->URL = explode('/', strtolower(strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)))));

        $this->navPage();
    }

    // Gets
    public function getTemplate(){ return $this->Template; }
    public function getPage(){ return $this->Page; }
    public function getCssJs(){ return $this->cssJs; }
    public function getDado(){ return $this->Dado; }


    // Sets
    private function navPage(){
        if(empty($this->URL[0])){
            $this->returns('home');
        }elseif(is_dir(PATH . 'public' . PHPBAR . $this->URL[0]) || file_exists(PATH . 'public'. PHPBAR . $this->URL[0] . '.php')){
            $this->returns($this->URL[0]);
        }elseif($this->URL[0] == 'auth' && !empty($this->URL[1]) && $this->URL[1] == 'login'){
            $login = new Login(2);
            $this->Template = ($login->CheckLogin() ? 'src/views/private/index.php' : 'src/views/login.php');
        }else{
            $this->Template = PATH . '404.php';
        }
    }

    private function returns($param){
        switch($param){
            case 'home':
                $this->Page = PATH . 'public' . PHPBAR . 'index.php';
                $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/frontend/index.css">';
                $this->cssJs['js'] = '<script src="/public/js/public/script.js"></script>';
                   /*inicializando leitura no banco*/ 
                    $read = new Read(); 
                    $read->ExeRead("tutorial","WHERE tutorial_status = 1 ORDER BY tutorial_id DESC LIMIT 30");
                    if($read->getResult()){
                        $this->Dado['blogs'] = $read->getResult();
                       
                        $x = filter_input(INPUT_GET,'p',FILTER_DEFAULT);
                        $read->ExeRead("tutorial","WHERE tutorial_status = 1 ORDER BY tutorial_id DESC");
                        
                        $limit   = 12;
                        $total   = $read->getRowCount();
                        $totPage = ceil($total / $limit);
                        $offset  = ceil( ($limit * $x) - $limit );
                        
                        if($offset <= 0){
                            $offset = 0;
                        }
                        $read->ExeRead('tutorial', 'ORDER BY tutorial_id DESC LIMIT :limit OFFSET :offset', "limit={$limit}&offset={$offset}");
                        if($read->getResult()){
                            $this->Dado['blogs'] = $read->getResult();
                            $this->Dado['btn_1']    = ( ($x - 1 ) > 0 ? ($x - 1) : 0 );
                            $this->Dado['btn_2']    = ( ($x + 1 ) <= $totPage ? ($x + 1) : 0 );
                            
                        }else{
                             $this->Dado['blogs'] = $this->Dado['blogs'];
                        }
                        
                        
                    }
            break;
            case 'busca':
                
                if(!empty($this->URL[0])){
                    $param =filter_input(INPUT_GET,'p',FILTER_SANITIZE_STRIPPED);
                    $this->Dado['title']= $param;
                    $read = new Read();
                    $read->ExeRead("tutorial", "WHERE tutorial_status = 1 ORDER BY tutorial_id DESC LIMIT 3");
                    if($read->getResult()){
                        $this->Dado['post'] = $read->getResult();
                        if($read->getResult()){
                            $this->Dado['blog_home'] = $read->getResult();
                        }
                    } 
                    $read ->ExeRead("tutorial","WHERE tutorial_title LIKE '%".$param."%' LIMIT 4");
                   
                    if($read->getResult()){
                       $this->Dado['tutorial']= $read->getResult();
                    }
                    $read ->ExeRead("product","WHERE product_name LIKE '%".$param."%' LIMIT 4");
    
                    if($read->getResult()){
                        $this->Dado['prod']= $read->getResult();
                    }
                    
                    $this->Page = PATH . 'public'  . PHPBAR .'busca.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/frontend/busca.css">';
                    $this->cssJs['js'] = null;
                }
               
            break;
            case 'post':
            
                    $this->Page = PATH . 'public' . PHPBAR.'post.php';
                    $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/frontend/post.css">';
                    $this->cssJs['js'] = '<script src="/public/js/public/post.js"></script>';
                    $read = new Read(); 
                    if($read->getResult()){
                        $this->Dado['post'] = $read->getResult()[0];
                        $read->ExeRead("tutorial", "WHERE tutorial_status = 1 ORDER BY tutorial_id DESC LIMIT 3");
                        if($read->getResult()){
                            $this->Dado['blog_home'] = $read->getResult();
                        }
                        
                          $update = new Update();
                        $view = ['tutorial_like' => $this->Dado['post']['tutorial_like'] +1];
                        $update->ExeUpdate('tutorial', $view, 'WHERE tutorial_id = :id',"id={$this->Dado['post']['tutorial_id']}");


                        $read->ExeRead('tutorial', 'WHERE tutorial_status = 1');
                        $arr = [];
                        // $arr[] = rand(1, 30);
                        // $arr[] = rand(31, 50);
                        // $arr[] = rand(51, 150);
                        // $arr[] = rand(151, 170);
                        // $arr[] = rand(171, 190);
                        // $arr[] = rand(190, 200);
                        $arr[] = rand(1, count($read->getResult()));



                        $read->ExeRead('tutorial_has_category', 'WHERE tutorial_tutorial_id = :id', "id={$read->getResult()[0]['tutorial_id']}");
                        if($read->getResult()){
                            $read->ExeRead('tutorial_has_category', 'WHERE tutorial_category_category_id = :id', "id={$read->getResult()[0]['tutorial_category_category_id']}");
                            if($read->getResult()){
                                foreach($read->getResult() as $item){
                                    $read->ExeRead('tutorial', 'WHERE tutorial_status = "1" and tutorial_id = :id ',"id={$item['tutorial_tutorial_id']}");
                                    if($read->getResult()){
                                        $this->Dado['relacionados'][] = $read->getResult();
                                    }
                                }
                                
                            }
                        }
                    }
               
            break; 

            case 'category':
                $this->Page = PATH . 'public' . PHPBAR . 'category' . PHPBAR . 'index.php';
                $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/frontend/category.css"/>';
                $this->cssJs['js'] = null;
                $read = new Read();
                $read->ExeRead('product_has_category', 'WHERE product_category_category_id = :id', "id={$this->URL[1]}");
                if($read->getResult()){
                    foreach($read->getResult() as $prod){
                        $read->ExeRead('product', 'WHERE product_id = :id', "id={$prod['product_product_id']}");
                        if($read->getResult()){
                            $this->Dado['category'][] = $read->getResult();
                        }
                    }
                }
            break;
            case 'politica-privacidade':
              
                $this->Page = PATH . 'public' . PHPBAR .'politica-privacidade.php';
                $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/frontend/politicas.css">';
                $this->cssJs['js'] = null;
            break;
            case 'politica-cookies':
                $this->Page = PATH . 'public' . PHPBAR .'politica-cookies.php';
                $this->cssJs['css'] = '<link rel="stylesheet" href="/public/css/frontend/politicas.css">';
                $this->cssJs['js'] = null;
            break;
        }
    }
}