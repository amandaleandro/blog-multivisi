<?php
    ob_start();
        require_once('src/configs/Autoload.php');
        $nav = new Navigation();
        if(!require($nav->getTemplate())){
            WSErro('Não foi possível incluir esse arquivo, entre em contato com o desenvolvedor', 'error', true);
        }
    ob_end_flush();
    