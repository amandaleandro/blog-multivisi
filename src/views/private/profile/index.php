<?php
    $user = $navAdm->getDado()['user'][0];    
?>
<form action="" method="post" class="form_user">
    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
    <input type="hidden" name="user_status" value="1">
    <input type="hidden" name="action" value="uup">
    <div class="container-fluid mt-3">
        <div class="boxwall bg-primary pl-5 pt-3 position-relative" style="height: 112px; background: url(https://pngimage.net/wp-content/uploads/2018/05/connecting-lines-png.png) no-repeat; background-size: contain; background-position-x: right;">    
        
            <div class="profile_image row position-absolute">
                <label class="positon-relative coverbg shadow-sm rounded-0" style="background: url('/public/img/upload/<?= $user['user_cover'] ?>')">
                    <i class="fad fa-camera-alt position-absolute text-white" style="bottom: 18px; left: 125px; font-size: 25px; opacity: .8"></i>
                    <input type="file" name="user_cover" class="d-none cover">
                </label>
                <div class="ml-4">
                    <h2 class="text-white"><?= $user['user_name'] .' '.$user['user_lastname'] ?></h2>
                    <small class="text-white">Developer Senior</small>
                </div>
            </div>
        </div>

        <div class="container mt-5" style="max-width: 800px">
            <h4 class="text-muted text-center m-5">Welcome - <?= $user['user_name']?></h4>
            <div class="form-group row mt-5">
                <label class="col">
                 Nome
                    <input type="text" name="user_name" id="" value="<?= $user['user_name']?>" class="form-control-lg w-100 border-0 shadow-sm rounded-0">
                </label>
                <label class="col">
                   Sobrenome
                    <input type="text" name="user_lastname" id="" value="<?= $user['user_lastname']?>" class="form-control-lg w-100 border-0 shadow-sm rounded-0">
                </label>
            </div>

            <div class="form-group row mt-5">
                <label class="col-8">
                    Email
                    <input type="text" name="user_email" id="" value="<?= $user['user_email']?>" class="form-control-lg w-100 border-0 shadow-sm roudend-0">
                </label>
                <label class="col">
                    Senha
                    <input type="password" name="user_password" id="" value="<?= $user['user_password']?>" class="form-control-lg w-100 border-0 shadow-sm roudend-0">
                </label>
            </div>

            <label class="position-relative float-right mt-5">
                <input type="submit" value="Save" class="btn btn-primary pr-5">
                <i class="fad fa-save position-absolute text-white" style="right: 15px; top: 12px"></i>
            </label>
        </div>
    </div>
</form>