<?php
    $p = $navAdm->getDado()['products'];
    $t = $navAdm->getDado()['tutorial'];
    $n = $navAdm->getDado()['newsletter'];
?>
<div class="row mr-0 ml-0 mt-2">
    <div class="dash-analisy col mt-2">
        <div class="row">
            <div class="col-sm-4">
                <div class="border-0 shadow-sm media col align-items-center p-4">
                    <i class="fad fa-boxes-alt mr-3 text-primary" style="font-size: 32px"></i>
                    <div class="media-body">
                    <h5 class="mt-0 mb-1">Produtos</h5>
                    <?= ($p != 0 ? count($p) : $p) ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            <div class="border-0 shadow-sm media col align-items-center p-4">
                    <i class="fas fa-chalkboard-teacher mr-3 text-primary" style="font-size: 32px"></i>
                    <div class="media-body">
                    <h5 class="mt-0 mb-1">Blog</h5>
                    <?= ($t != 0 ? count($t) : $t) ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            <div class="border-0 shadow-sm media col align-items-center p-4">
                    <i class="fad fa-users mr-3 text-primary" style="font-size: 32px"></i>
                
                    <div class="media-body">
                    <h5 class="mt-0 mb-1">Newsletter</h5>
                    <?= ($n != 0 ? count($n) : $n) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-3">
                <div class="card border-0 shadow-sm">
                    <a href="?page=products/create"><img src="/public/img/images/Card-cria-um-produto.png" alt="" class="mw-100"></a>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="card border-0 shadow-sm">
                    <a href="?page=tutorials/create"><img src="/public/img/images/Card-criar-post-de-blog.png" alt="" class="mw-100"></a>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="card border-0 shadow-sm">
                    <a href="/" target="_blank"><img src="/public/img/images/Card-vizualizar-site.png" alt="" class="mw-100"></a>
                </div>
            </div>
            <div class="col-sm-3">
            <div class="card border-0 shadow-sm">
                    <a href="?page=support"><img src="/public/img/images/Card-solicitar-ajuda-site.png" alt="" class="mw-100"></a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your are sure delete this archive?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Not</button>
                    <button type="button" class="btn btn-light">Yes</button>
                </div>
            </div>
    </div>
</div>