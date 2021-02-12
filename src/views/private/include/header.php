<?php
$level = $_SESSION['userlogin']['level_user'][0];
$usering = $navAdm->getDado()['usering'][0];

?>
<nav class="navbar navbar-expand-lg justify-content-between shadow-sm pr-5 pl-5 pt-3 pb-3 menu-bar">
  <div class="row">
    <a class="navbar-brand mr-5" href="?page"><img src="/public/img/icons/header/logo-faciltec-preto.svg" width="100px" ></a>
  </div>
  <div id="navbarNavDropdown">
    <ul class="navbar-nav float-right">
        <li class="nav-item dropdown">
          <div class="media align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-3 rounded-circle" style="background: url('/public/img/upload/<?= $usering['user_cover'] ?>') no-repeat;
            background-size: cover; width: 32px; height: 32px; display: block; background-position: 50% 50%;"></span>
            
            <div class="media-body">
              <a class="mt-0 btn">Olá, <?= $usering['user_name'] ?></a>
            </div>
          </div>
         
            <div class="dropdown-menu dropdown-menu-right border-0 shadow mt-3" aria-labelledby="navbarDropdownMenuLink" style="width: 12rem">
              <ul class="list-group list-group-flush list-drop">
                <a class="list-group-item" href="?page=profile"><img src="/public/img/icons/header/user.svg" width="15" class="mr-2"> Perfil</a>
                <a class="list-group-item" onclick="logoutUser();"><img src="/public/img/icons/header/logout.svg" width="15" class="mr-2"> Sair</<img></a>
              </ul>
            </div>
        </li>
    </ul>
  </div>
</nav>
<div class="menu-left col float-left" style="height: calc(100vh - 80px); max-width: 17rem!important">
        <div class="menus text-center pt-2 mt-3 bg-white shadow-sm rounded position-relative" style="height: 89vh">
        <span class="mr-auto ml-auto mt-3" style="background: url('/public/img/upload/<?= $usering['user_cover'] ?>') no-repeat;
    background-size: cover; width: 100px; height: 100px; display: block; background-position: 50% 50%;" data-email="<?= $usering['user_email'] ?>"></span>

            <p class="d-block m-0 text-center text-muted"><b class="text-dark" style="font-weight:500"><?= $usering['user_name'] ?> <?= $usering['user_lastname'] ?></b></p>

            <!-- menus -->
            <ul class="mt-5 text-left p-0">
            <li>
                    <a class="nav-link p-3 drop" data-toggle="collapse" href="#tutorial" role="button" aria-expanded="false" aria-controls="tutorial"><img src="/public/img/icons/home/blog.svg" width="18" class="mr-2">Blog<i class="fas fa-chevron-right"></i></a>
                    <ul class="collapse p-0 linksmenu" id="tutorial">
                        <li class="nav-item"><a href="?page=tutorials/create" class="nav-link pl-5">Criar Post-Blog</a></li>
                        <li class="nav-item">
                            <a class="nav-link pl-5 dropp" data-toggle="collapse" href="#categorys" role="button" aria-expanded="false" aria-controls="newsview">Categorias<i class="fas fa-chevron-right"></i></a>
                            <ul class="collapse linkssub" id="categorys">
                                <li class="nav-item"><a href="?page=category_tutorials/create" class="nav-link pl-4">Criar Categoria</a></li>
                                <li class="nav-item"><a href="?page=category_tutorials" class="nav-link pl-4">Todas as Categorias</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-5 dropp" data-toggle="collapse" href="#filess" role="button" aria-expanded="false" aria-controls="newsview">Arquivos<i class="fas fa-chevron-right"></i></a>
                            <ul class="collapse linkssub" id="filess">
                                <li class="nav-item"><a href="?page=files_tutorial/create" class="nav-link pl-4">Criar Arquivos</a></li>
                                <li class="nav-item"><a href="?page=files_tutorial/" class="nav-link pl-4">Todos os Arquivos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="?page=tutorials" class="nav-link pl-5">Todos os Posts</a></li>
                    </ul>
                </li> 
                <li>
                    <a class="nav-link p-3 drop" data-toggle="collapse" href="#product" role="button" aria-expanded="false" aria-controls="product"><img src="/public/img/icons/home/automation.svg" width="18" class="mr-2"> Produtos <i class="fas fa-chevron-right"></i></a>
                    <ul class="collapse p-0 linksmenu" id="product">
                        <li class="nav-item"><a href="?page=products/create" class="nav-link pl-5">Criar</a></li>
                        
                        <li class="nav-item">
                            <a class="nav-link pl-5 dropp" data-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="newsview">Categorias<i class="fas fa-chevron-right"></i></a>
                            <ul class="collapse linkssub" id="category">
                                <li class="nav-item"><a href="?page=category_product/create" class="nav-link pl-4">Criar Categorias</a></li>
                                <li class="nav-item"><a href="?page=category_product" class="nav-link pl-4">Todas as Categorias</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-5 dropp" data-toggle="collapse" href="#files" role="button" aria-expanded="false" aria-controls="newsview">Arquivos <i class="fas fa-chevron-right"></i></a>
                            <ul class="collapse linkssub" id="files">
                                <li class="nav-item"><a href="?page=files_product/create" class="nav-link pl-4">Criar Arquivos</a></li>
                                <li class="nav-item"><a href="?page=files_product/" class="nav-link pl-4">Todos os Arquivos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="?page=products" class="nav-link pl-5">Todos os Produtos</a></li>
                    </ul>
                </li>
                <li>
                <li>
                    <a class="nav-link p-3 drop" href="http://www.faciltec.final.com.br/" target="_blank" ><img src="/public/img/icons/home/view.svg" width="18" class="mr-2"> Ver site <i class="far fa-question-circle" data-toggle="tooltip" data-placement="right" title="Aqui você visualiza o site, em tempo real para acompanhar as metas."></i></a>
                </li>   
                <li>
                    <a class="nav-link p-3 drop position-relative" href="?page=support"><img src="/public/img/icons/home/support.svg" width="18" class="mr-2">Ajuda</a>
                </li>                         
            </ul>
            <small class="position-absolute fixed-bottom p-3 text-muted">Version 1.0<br/>Copyright &copy;</small>
        </div>
    </div>