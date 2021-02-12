<?php
  $file = $navAdm->getDado()['product_files'][0];
?>
<form action="" method="post" id="form_file" enctype="multipart/form-data">

  <input type="hidden" name="action" value="<?= ($file['id_prodarchive'] ? 'update_file' : 'create_file') ?>">
  <input type="hidden" name="id_prodarchive" value="<?= ($file['id_prodarchive'] ? $file['id_prodarchive'] : '0') ?>">
<div class="row card flex-row ml-auto mr-auto mt-3 border-0" style="max-width: 65em;">
<div class="col-11 shadow-lg p-4">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <label class="w-100 mb-4 position-relative">
         Nome do Arquivo
          <input type="text" name="prodarchives_name" class="form-control rounded-0 name_prod" maxlength="75" value="<?= $file['prodarchives_name'] ?>">
          <span class="position-absolute text-muted limit_max" style="right: 10px; top: 35px; font-size: 11px; font-weight: 700;" data-toggle="tooltip" data-placement="top" title="Limite máximo, 75 caracteres.">75 / 0</span>
        </label>
        <div class="row m-0 align-items-center">
        <div class="col-9">
            <label class="w-100">
              Escolha o arquivo            
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Enviar</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input fileprod" id="inputGroupFile01"  aria-describedby="inputGroupFileAddon01" accept="application/pdf" name="prodarchives_link">
                    <label class="custom-file-label" for="inputGroupFile01">Escolha o arquivo </label>
                </div>
                </div>
            </label>
            <div class="filesuploadeds">
                <ul class="list-group">
                    <?php if($file['id_prodarchive']): ?>
                        <li class="list-group-item position-relative shadow-sm border-0">
                            <?= $file['prodarchives_name'] ?>
                            <i class="fas fa-window-close ml-3 text-danger position-absolute" style="right: 15px; top: 17px"></i>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
        <p class="m-0 text-muted sizeupload">Size: <?= ($file['id_prodarchive'] ? $file['prodarchives_size'] : '0') ?> KB</p>
        </div>
      </div>
    </div>
    <label class="position-relative mt-5">
        <input type="submit"  value="Salvar Arquivo" class="btn btn-primary rounded-0 pr-5" id="inputSub">
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