<?php
  $category = $navAdm->getDado()['tutorial_category'][0];
?>
<form action="" method="post" id="form_category" enctype="multipart/form-data">

  <input type="hidden" name="action" value="<?= ($category['category_id'] ? 'update_category' : 'create_category') ?>">
  <input type="hidden" name="category_id" value="<?= ($category['category_id'] ? $category['category_id'] : '0') ?>">

  
<div class="row card flex-row ml-auto mr-auto mt-3 border-0" style="max-width: 65em;">
<div class="col-11 shadow-lg p-4">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <label class="w-100 mb-4 position-relative">
          Nome da Categoria
          <input type="text" name="category_name" class="form-control rounded-0 name_prod" maxlength="75" value="<?= $category['category_name'] ?>">
          <span class="position-absolute text-muted limit_max" style="right: 10px; top: 35px; font-size: 11px; font-weight: 700;" data-toggle="tooltip" data-placement="top" title="Limite máximo, 75 caracteres.">75 / 0</span>
        </label>
        <div class="row m-0">
        <div class="col">
            <label class="w-100">
              Escolha a uma imagem
              <input type="file" class="d-none" id="cover" name="category_cover">
              <div class="coveimg">
                <img src="<?= ($category['category_id'] ? '/public/img/upload/' . $category['category_cover'] : 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSNNh4aGp56ELWHfEvqgodkbt094ohAtT9moaddw3AoelCKOH4g') ?>" class="mw-100">
              </div>
            </label>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm">
              <div class="card-title col">
                Status da Categoria
              </div>
              <div class="custom-control custom-radio ml-3">
                <input type="radio" id="customRadio1" name="category_status" value="1" <?= ($category['category_id'] && $category['category_status'] == 1 ? 'checked' : false) ?> class="custom-control-input">
                <label class="custom-control-label" for="customRadio1">Online</label>
              </div>
              <div class="custom-control custom-radio ml-3">
                <input type="radio" name="category_status" value="0" id="customRadio2" <?= ($category['category_id'] && $category['category_status'] == "0" ? 'checked' : false) ?>  name="customRadio" class="custom-control-input">
                <label class="custom-control-label" for="customRadio2">Offline</label>
              </div>
            </div>
        </div>
        </div>
      </div>
    </div>
    <label class="position-relative mt-5">
        <input type="submit"  value="Salvar Categoria" class="btn btn-primary rounded-0 pr-5" id="inputSub">
        <i class="fad fa-save position-absolute text-white" style="right: 10px; top: 12px"></i>
    </label>
  </div>
  <div class="col-1 pr-0" style="background: #fbfbfb">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="p-3 active item_menu rounded-0 border text-center mb-2 position-relative active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fal fa-font-case"></i></a>
    </div>
  </div>
</div>
</form>