<?php
include('Settings.php');

function loading($Class){
    $cDir = ['../../src/controller/', '../../src/models/'];
    $iDir = null;

    foreach($cDir as $dirName){
        if(!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php')){
            include_once(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php');
            $iDir = true;
        }
    }

    if(!$iDir){
        trigger_error("Sorry not possible include the {$Class}.class.php", E_USER_ERROR);
        die();
    }
}

spl_autoload_register('loading');