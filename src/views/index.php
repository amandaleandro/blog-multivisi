<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow,all">
    <meta name="googlebot" content="index,follow">
    <meta name="language" content="Portuguese">
    <meta http-equiv="content-language" content="pt-br">
    <meta name="copyright" content="Todos direitos reservados 2020." />
    <title>Blog Multivisi</title>


    <!-- css -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="/public/css/frontend/include/header.css">
    <link rel="stylesheet" href="/public/css/frontend/include/reset.css">
    <link rel="stylesheet" href="/public/css/frontend/include/footer.css">

    <?= $nav->getCssJs()['css'] ?>
</head>
<body>
    
<div class="container-fluid">
<?php
    include('src/views/public/include/header.php');
    if(!file_exists($nav->getPage())){
        WSErro('Not possible include the file!', 'error', true);
    }else{
        require_once($nav->getPage());
    }
    include('src/views/public/include/footer.php');
?>
</div>


    <!--- js ---->
    
    <script src=" https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="/public/js/public/header.js"></script>
    <script src="/public/js/public/footer.js"></script>
    <script type="text/javascript" src="https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js"></script>
    <script type="text/javascript"> new RDStationForms('formulario-newsletter-multivisi-ec5006826ca884947f76', 'UA-10932512-1').createForm();</script>
    <?= $nav->getCssJs()['js'] ?>
</body>
</html>