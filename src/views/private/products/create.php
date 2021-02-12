<?php 
  $prod = $navAdm->getDado()['product'][0];
  $imgCover = 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSNNh4aGp56ELWHfEvqgodkbt094ohAtT9moaddw3AoelCKOH4g';
  $imgSingle = explode(',', $prod['product_cover']);
  $category = $navAdm->getDado()['product_category'];
  $files = $navAdm->getDado()['product_files'];
  $checkCat = $navAdm->getDado()['check_category'];
  $checkFil = $navAdm->getDado()['check_files'];
?>

<form action="" method="post" id="form_product" enctype="multipart/form-data">

  <input type="hidden" name="action" value="<?= ($prod['product_id'] ? 'update_product' : 'create_product') ?>">
  <input type="hidden" name="user_id" value="<?= $_SESSION['userlogin']['user_id'] ?>">
  <input type="hidden" name="product_id" value="<?= ($prod['product_id'] ? $prod['product_id'] : '0') ?>">

  
<div class="row card flex-row ml-auto mr-auto mt-3 border-0" style="max-width: 65em;">
<div class="col-11 shadow-lg p-4">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <label class="w-100 mb-4 position-relative">
         Nome do Produto
          <input type="text" name="product_name" class="form-control rounded-0 name_prod" maxlength="75" value="<?= $prod['product_name']?>">
          <span class="position-absolute text-muted limit_max" style="right: 10px; top: 35px; font-size: 11px; font-weight: 700;" data-toggle="tooltip" data-placement="top" title="Limite máximo, 75 caracteres.">75 / 0</span>
        </label>
        <label class="w-100">
          Descrição do Produto
          <textarea name="product_description"  cols="30" rows="10" class="tinymce"><?= $prod['product_description']?></textarea>
        </label>
      </div>
      <div class="tab-pane fade p-3" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        <div class="row">
          <div class="col" style="max-height: 277px; overflow: auto;">
            <div class="card border-0 shadow-sm">
            <div class="card-title col-6">
             Categorias
              </div>
              <div class="card-header bg-white border-light row m-0 justify-content-between align-items-center">
                <div class="custom-control custom-checkbox checkeding">
                  <input type="checkbox" class="custom-control-input" id="checkall">
                  <label class="custom-control-label text-muted" for="checkall" style="font-size: 13px;">Check All</label>
                </div>
                <label class="position-relative w-50">
                  <i class="fal fa-search position-absolute text-muted" style="right: 10px; top: 10px;"></i>
                  <input type="text" id="search" class="form-control rounded-0" placeholder="Search..." style="font-size: 13px">
                </label>
              </div>
              <ul class="list-group list-group-flush listcategory">
                <?php if($category): foreach($category as $cat): ?>
                  <li class="list-group-item border-light" style="font-size: 13px">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>" class="custom-control-input" id="cat_<?= $cat['category_id'] ?>" <?php 
                      if($checkCat){ foreach($checkCat as $checkC){
                        echo ($checkC['product_category_category_id'] == $cat['category_id'] ? 'checked' : false);
                      } }
                    ?>>
                    <label class="custom-control-label" for="cat_<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></label>
                  </div>
                </li>
                <?php endforeach; endif;?>
              </ul>
          </div>
          </div>
          <div class="col">
            <label class="w-100">
              <input type="file" class="d-none" id="cover" name="product_cover">
              <div class="coveimg shadow-sm">
                <img src="<?= ($prod['product_id'] ? '/public/img/upload/' . $imgSingle[0] : $imgCover); ?>" class="mw-100">
              </div>
            </label>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-4" style="max-height: 277px; overflow: auto;">
            <div class="card border-0 shadow-sm">
              <div class="card-title col">
              Video do youtube
              </div>
              <div class="card-header bg-white border-light text-right row m-0 justify-content-between align-items-center ybtinput">
                <small class="text-danger d-none txterror">This is Empty!</small>
                <input type="text"  class="form-control rounded-0 col-10" placeholder="Code Youtube" style="font-size: 13px"> 
                <i class="fas fa-plus-square text-primary"></i>
                <small style="text-align: left; font-size: 11px; color: #b7b7b7;"><i>Exemple: www.you.be/watch?v=</i><b style="color: #a7a7a7">1wNvi74lw08</b></small>
              </div>
              <ul class="list-group list-group-flush youtubelist">
                <?php if($prod['product_id']): foreach(explode(',', $prod['product_video']) as $video): ?>
                <li class="list list-group-item d-flex justify-content-between align-items-center border-light" data-url="<?= $video ?>">
                  <small><i><?= $video ?></i></small>
                  <i class="fas fa-minus-square text-danger delety"></i>
                </li>
                <?php endforeach; endif; ?>
              </ul>
            </div>
          </div>
          <div class="col-5" style="max-height: 277px; overflow: auto;">
            <div class="card border-0 shadow-sm">
            <div class="card-title col-6">
              Arquivos
              </div>
              <div class="card-header bg-white border-light row m-0 justify-content-between align-items-center">
                <div class="custom-control custom-checkbox checkedin">
                  <input type="checkbox" class="custom-control-input" id="checkal">
                  <label class="custom-control-label text-muted" for="checkal" style="font-size: 13px;">Check All</label>
                </div>
                <label class="position-relative w-50">
                  <i class="fal fa-search position-absolute text-muted" style="right: 10px; top: 10px;"></i>
                  <input type="text" id="searchfile" class="form-control rounded-0" placeholder="Search..." style="font-size: 13px">
                </label>
              </div>
              <ul class="list-group list-group-flush listfiles">
                <?php if($files): foreach($files as $file): ?>
                  <li class="list-group-item border-light" style="font-size: 13px">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="files[]" value="<?= $file['id_prodarchive'] ?>" class="custom-control-input" id="file_<?= $file['id_prodarchive'] ?>" <?php 
                      if($checkFil){ foreach($checkFil as $checkF){
                        echo ($checkF['product_achives_id_prodarchive'] == $file['id_prodarchive'] ? 'checked' : false);
                      } }
                    ?>>
                    <label class="custom-control-label" for="file_<?= $file['id_prodarchive'] ?>"><?= $file['prodarchives_name'] ?></label>
                  </div>
                </li>
                <?php endforeach; endif;?>
              </ul>
          </div>
          </div>
          <div class="col">
            <div class="card border-0 shadow-sm">
              <div class="card-title col">
                Status
              </div>
              <div class="custom-control custom-radio ml-3">
                <input type="radio" id="customRadio1" name="product_status" value="1" <?= ($prod['product_id'] && $prod['product_status'] == 1 ? 'checked' : false) ?> class="custom-control-input">
                <label class="custom-control-label" for="customRadio1">Online</label>
              </div>
              <div class="custom-control custom-radio ml-3">
                <input type="radio" name="product_status" value="0" id="customRadio2"  <?= ($prod['product_id'] && $prod['product_status'] == "0" ? 'checked' : false) ?> name="customRadio" class="custom-control-input">
                <label class="custom-control-label" for="customRadio2">Offline</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-4" style="max-height: 277px; overflow: auto;">
            <div class="card border-0 shadow-sm">
                <div class="card-title col">
                Preço do Produto
                </div>
                <div class="card-header bg-white border-light text-right row m-0 justify-content-between align-items-center ybtinput">
                  <input type="text" name="product_price"  class="form-control rounded-0 col-10" placeholder="R$ 1.800,00" style="font-size: 13px"> 
                </div>
            </div>
          </div>
          <div class="col-5" style="max-height: 277px; overflow: auto;">
            <div class="card border-0 shadow-sm">
                <div class="card-title col">
               Código do Produto
                </div>
                <div class="card-header bg-white border-light text-right row m-0 justify-content-between align-items-center ybtinput">
                  <input type="text" name="product_code"class="form-control rounded-0 col-10" placeholder="1238" style="font-size: 13px"maxlength="4"> 
                </div>
            </div>
        </div>
      </div>
    </div>  
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
        <label class="w-100">
          Product URL
          <input type="text" name="product_url" id="prdurl" class="form-control rounded-0" value="<?= $prod['product_url'] ?>">
          <small><b>Exemple</b>: <i>this-is-a-product</i></small>
        </label>
        <label class="w-100 mt-4 mb-4 position-relative">
          Seo descrição
          <div class="row m-0 align-items-center seodescript">
            <input type="text" name="product_seo_description" class="form-control rounded-0 col" maxlength="155" value="<?= $prod['product_seo_description']?>">
            <i class="fal fa-question-circle p-3" data-toggle="tooltip" data-placement="top" data-html="true" title="The meta <b>description</b> is a snippet of up to about 155 characters – a tag in HTML – which summarizes a page's content."></i>
            <span class="position-absolute" style="right: 60px; top: 40px; font-size: 11px; font-weight: 700;">155 / 0</span>
          </div>
        </label>
        <label class="w-100">
          Seo MetaTags
          <div class="row m-0 align-items-center">
            <div class="tag-container col seo_tags" data-seo="<?= ($prod['product_id'] ? $prod['product_seo_tags'] : false) ?>">
              
              
             
              <input type="text" onkeydown="return event.key != 'Enter';">
            </div>
            
            <i class="fal fa-question-circle p-3" data-toggle="tooltip" data-placement="top" data-html="true" title="Meta tags são linhas de código HTML ou 'etiquetas' que, entre outras coisas, descrevem o conteúdo do seu site para os buscadores."></i>
          </div>
          <small class="text-muted"><i class="fad fa-exclamation mr-2" style="font-size: 11px"></i>Press <kbd>Enter</kbd> after letter end</small>
        </label>
        <label class="position-relative mt-5">
          <input type="submit"  value="Save Product" class="btn btn-primary rounded-0 pr-5" id="inputSub">
          <i class="fad fa-save position-absolute text-white" style="right: 10px; top: 12px"></i>
        </label>
      </div>
    </div>
  </div>
  <div class="col-1 pr-0" style="background: #fbfbfb">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="p-3 active item_menu rounded-0 border text-center mb-2 position-relative active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fal fa-font-case"></i></a>
      <a class="p-3 item_menu rounded-0 border text-center mb-2 position-relative" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="far fa-window-restore"></i></a>
      <a class="p-3 item_menu rounded-0 border text-center position-relative" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fad fa-analytics"></i></a>
    </div>
  </div>
</div>
</form>
<div aria-live="polite" aria-atomic="true">
  <div class="toast border-0" style="position: absolute; top: 80px; right: 10px;">
    <div class="toast-header">
      
      <strong class="mr-auto"><i class="fad fa-comment-alt-exclamation text-danger"></i> Importante</strong>
      
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
        Alguns campos então em branco!
    </div>
  </div>
</div>