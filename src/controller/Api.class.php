<?php

// require the Autoload
require_once('../configs/Autoload.php');

// Filter url POST params
$dataURL = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// check the params
if(!isset($dataURL['jController'])){
    echo json_encode(['System error, invalid request Controller #1', WS_ERROR]);
}else{
    switch($dataURL['jController']){
        case 'admin-panel':
            // clear dataUrl
            unset($dataURL['jController']);

            if(!isset($dataURL['admAction'])){
                echo json_encode(['System error, invalid request Cotroller #3', WS_ERROR]);
            }else{
                switch($dataURL['admAction']){
                    case 'login':
                        unset($dataURL['admAction']);
                        $login = new Login(4);
                        $login->ExeLogin($dataURL);
                        echo json_encode($login->getResult());
                    break;
                    case 'logout':
                        unset($dataURL['admAction']);
                        session_start();
                        session_destroy();
                        header("Refresh: 0");
                    break;
                    case 'product':
                        unset($dataURL['admAction']);
                        $product = new Product($dataURL);
                        echo json_encode($product->getResult());
                    break;
                    case 'product_category':
                        unset($dataURL['admAction']);
                        $category = new CategoryProduct($dataURL);
                        echo json_encode($category->getResult());
                    break;
                    case 'product_file':
                        unset($dataURL['admAction']);
                        $file = new FileProduct($dataURL);
                        echo json_encode($file->getResult());
                    break;
                    case 'tutorials':
                        unset($dataURL['admAction']);
                        $tuor = new Tutorial($dataURL);
                        echo json_encode($tuor->getResult());
                    break;
                    case 'tutorial_category':
                        unset($dataURL['admAction']);
                        $category = new CategoryTutorial($dataURL);
                        echo json_encode($category->getResult());
                    break;
                    case 'tutorial_file':
                        unset($dataURL['admAction']);
                        $file = new FileTutorial($dataURL);
                        echo json_encode($file->getResult());
                    break;
                    case 'newsletter':
                        unset($dataURL['admAction']);
                        $file = new Newsletter($dataURL);
                        echo json_encode($file->getResult());
                    break;
                    case 'event':
                        unset($dataURL['admAction']);
                        $event = new Event($dataURL);
                        echo json_encode($event->getResult());
                    break;
                    case 'support':
                        unset($dataURL['admAction']);
                        $suport = new Contact($dataURL);
                    break;
                    case 'user':
                        unset($dataURL['admAction']);
                        $user = new User($dataURL);
                        echo json_encode($user->getResult());
                    break;
                    case 'video':
                        unset($dataURL['admAction']);
                        $video = new Video($dataURL);
                        echo json_encode($video->getResult());
                    break;
                }
            }
        break;
    }
}


