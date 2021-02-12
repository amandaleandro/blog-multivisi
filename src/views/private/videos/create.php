<form action="" method="post" id="form_video" enctype="multipart/form-data">
  <input type="hidden" name="action" value="video_create">
<div class="row card flex-row ml-auto mr-auto mt-3 border-0" style="max-width: 35em;">
<h4 class="h5 p-3 text-muted">Vídeos Tutoriais | Dicas</h4>
<div class="col-12 shadow-lg p-4">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <label class="w-100 mb-4 position-relative">
          Title video
          <input type="text" name="videos_title" class="form-control rounded-0 name_prod" maxlength="20" value="" required>
          <span class="position-absolute text-muted limit_max" style="right: 10px; top: 35px; font-size: 11px; font-weight: 700;" data-toggle="tooltip" data-placement="top" title="Limite máximo, 20 caracteres.">20 / 0</span>
        </label>

        <label class="w-100 mb-4">
          Tag video
            <select class="form-control rounded-0" name="videos_tag">
                <option value="tutorial" selected>Tutorial</option>
                <option value="dicas">Dicas</option>
            </select>
        </label>

        <label>
            Code video
            <input type="text" name="videos_code" class="form-control rounded-0 name_prod" maxlength="20" value="" required>
            <small><b>Exemplo:</b> lTRiuFIWV54</small>
        </label>
      </div>
    </div>
    <label class="float-right d-block">
        <input type="submit" value="Salvar" class="btn btn-primary" />
    </label>
  </div>
  
</div>
</form>

<div aria-live="polite" aria-atomic="true">
  <div class="toast border-0" style="position: absolute; top: 80px; right: 10px;">
    <div class="toast-header">
      
      <strong class="mr-auto"><i class="fad fa-comment-alt-exclamation text-danger"></i> Important</strong>
      
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
        Alguns campos então em branco!
    </div>
  </div>
</div>