<?php $navAdm = new NavigationAdm(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <!-- style -->
    <link rel="stylesheet" href="/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.0/css/pro.min.css">
    <link rel="stylesheet" href="/public/css/backend/login.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/reset.css">
    <link rel="stylesheet" href="/public/css/backend/header.css">
    <link rel="stylesheet" href="/public/css/backend/dashboard.css">
    <?= $navAdm->getCssJs()['css']; ?>
</head>
<body>
    <?php include('src/views/private/include/header.php'); ?>
    <div class="container-fluid p-0 float-left" style="max-width: calc(100% - 18rem);">
        <?php
            if(!file_exists($navAdm->getPage())){
                WSErro('Not possible include the file!', 'error', true);
            }else{
                require_once($navAdm->getPage());
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="/libs/fontawesome/js/fontawesome.min.js"></script>
    <script src="/libs/tinymce/tinymce.min.js"></script>
    <script src="/libs/tinymce/init-tinymce.js"></script>
    <script src="/libs/jquery/jquery-form.js"></script>
    <script src="/public/js/helpers.js"></script>
    <script src="/public/js/private/header.js"></script>
    <?= $navAdm->getCssJs()['js']; ?>
</body>
</html>