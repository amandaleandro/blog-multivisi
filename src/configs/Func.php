<?php

//Debug
function ExDebug($array){
    echo "<pre class='bg-white card shadow p-3 text-muted'>";
    print_r($array);
    echo "</pre>";
}

//WSErro :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFO : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<pre>";
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";
    echo "</pre>";

    if ($ErrDie):
        die;
    endif;
    return 0;
}

// PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFO : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<pre>";
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";
    echo "</pre>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Ano',
        'm' => 'Mês',
        'w' => 'Semana',
        'd' => 'Dia',
        'h' => 'Hora',
        'i' => 'Minuto',
        's' => 'Segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' atrás' : 'agora mesmo';
}


function createSizesImage($target, $folder, $sizing = false){
    $imgSize = [1200, 720, 480];
    $newString = null;
    $dat = null;
    if($sizing){
        foreach($imgSize as $sizes){
            $names = $target['name']. ' ' . $sizes;
            
             $coverUpload = new Upload('../../public/img/upload/');
             $coverUpload->Image($target, $names, $sizes, $folder);
             if($coverUpload->getResult()){
                $newString .= $coverUpload->getResult() . ',';
                $dat = substr($newString, 0, -1);
             }
        }
    }else{
        $coverUpload = new Upload('../../public/img/upload/');
        $coverUpload->Image($target, null, null, $folder);
        if($coverUpload->getResult()){
            $dat = $coverUpload->getResult();
        }
    }
    return $dat;
}

function createFile($target, $folder){
        $file = new Upload('../../public/pdf/');
        $file->File($target, null, $folder);
        if($file->getResult()){
            return $file->getResult();
        }
}


set_error_handler('PHPErro');