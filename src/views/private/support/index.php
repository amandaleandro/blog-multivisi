<form action="" method="post" id="form_suport" enctype="multipart/form-data">
  
<div class="row card flex-row ml-auto mr-auto mt-3 border-0" style="max-width: 65em;">
<div class="col shadow-lg p-4">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <label class="w-100 mb-4 position-relative">
          Title your question
          <input type="text" name="support_title" class="form-control rounded-0 name_prod" maxlength="75">
          <span class="position-absolute text-muted limit_max" style="right: 10px; top: 35px; font-size: 11px; font-weight: 700;" data-toggle="tooltip" data-placement="top" title="Limite máximo, 75 caracteres.">75 / 0</span>
        </label>

        <label class="w-100">
          Write your question
          <textarea name="support_description"  cols="30" rows="10" class="tinymce"></textarea>
        </label>

        <label>
        <input type="submit" value="Send" class="btn btn-primary rounded-0">
        </label>
      </div>
    </div>
  </div>
</div>

</form>

<div aria-live="polite" aria-atomic="true">
  <div class="toast border-0" style="position: absolute; top: 80px; right: 10px;">
    <div class="toast-header">
      
      <strong class="mr-auto"><i class="fad fa-laugh-wink"></i> Greate</strong>
      
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
        Sua mensagem foi enviada!
    </div>
  </div>
</div>