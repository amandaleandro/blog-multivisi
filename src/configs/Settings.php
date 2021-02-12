<?php

// including the functions globals
include('Func.php');

// url base
define('SITENAME', $_SERVER['HTTP_HOST']);

// server auth
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'blogmulti');

// customization
define('PHPBAR', DIRECTORY_SEPARATOR);
define('COMPANY', 'Universidade');
define('PATH', 'src' . PHPBAR . 'views' . PHPBAR);

// sets mail
define('MAILUSER', 'contato@zesk.com.br');
define('MAILPASS', '38931373g8d75j8z');
define('MAILHOST', 'mail.zesk.com.br');
define('MAILPORT', '465'); //465 587

// erros
define('WS_ACCEPT', 'accept');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');
define('WS_INFO', 'info');
