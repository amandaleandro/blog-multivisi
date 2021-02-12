<?php 
  $event = $navAdm->getDado()['event'][0];
  $imgCover = 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSNNh4aGp56ELWHfEvqgodkbt094ohAtT9moaddw3AoelCKOH4g';
  $imgSingle = explode(',', $event['event_cover']);
?>

<form action="" method="post" id="form_event" enctype="multipart/form-data">

  <input type="hidden" name="action" value="<?= ($event['event_id'] ? 'update_event' : 'create_event') ?>">
  <input type="hidden" name="event_id" value="<?= ($event['event_id'] ? $event['event_id'] : '0') ?>">

  
<div class="row card flex-row ml-auto mr-auto mt-3 border-0" style="max-width: 65em;">
<div class="col-11 shadow-lg p-4">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <label class="w-100 mb-4 position-relative">
          Title Event
          <input type="text" name="event_title" class="form-control rounded-0 name_prod" maxlength="20" value="<?= $event['event_title']?>">
          <span class="position-absolute text-muted limit_max" style="right: 10px; top: 35px; font-size: 11px; font-weight: 700;" data-toggle="tooltip" data-placement="top" title="Limite máximo, 75 caracteres.">75 / 0</span>
        </label>

        <label class="w-100">
          Description Event
          <textarea name="event_description"  cols="30" rows="10" class="tinymce"><?= $event['event_description']?></textarea>
        </label>
      </div>
      <div class="tab-pane fade p-3" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
        <div class="row">
          <div class="col" style="max-height: 277px; overflow: auto;">
            <div class="card border-0 shadow-sm">
            <div class="card-title col-6">
              Branch
              </div>
              <div class="card-header bg-white border-light row m-0 justify-content-between align-items-center">
               is is spotlight?
                <div class="row m-0 align-items-center">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="event_branch" class="custom-control-input checkbranch" id="customSwitch1" <?= ($event['event_branch'] == 1 ? 'checked' : false) ?>>
                    <label class="custom-control-label" for="customSwitch1"></label>
                    </div>
                    <i class="fad fa-plus-square text-primary addphoto" style="font-size: 20px; display: none"></i></div>
              </div>
              <ul class="list-group list-group-flush listcategory">
                <?php if($event['event_photos']): echo '<div class="lisphot">'; foreach(array_filter(explode(',', $event['event_photos'])) as $photos): ?>
                 
                      <li class="list-group-item border-light" data-url="<?= $photos ?>" style="font-size: 13px">
                        <div class="custom-control custom-checkbox">
                            <div class="media align-items-center">
                                <img src="/public/img/upload/<?= $photos ?>" class="mr-3 w-25" >
                                    <div class="media-body text-right">
                                        <i class="fad fa-window-close text-danger xpho"  style="font-size: 20px;"></i>
                                    </div>
                            </div>
                        </div>
                    </li>
                  
                <?php endforeach; echo '</div>'; endif;?>
              </ul>
          </div>

          <div class="row">
          <div class="border-0 shadow-sm mt-5 col">
            <div class="card-title col">
              Date event
              </div>
              <div class="card-header bg-white border-light row m-0 justify-content-between align-items-center">
              <div class="input-group date">
                <input type="text" class="form-control" name="event_date" value="<?= $event['event_date'] ?>">
            </div>
              </div>
          </div>
          <div class="border-0 shadow-sm mt-5 col">
            <div class="card-title col">
              Event City
              </div>
              <div class="card-header bg-white border-light row m-0 justify-content-between align-items-center">
              <div class="input-group">
                <input type="text" class="form-control" name="event_city" value="<?= $event['event_city'] ?>">
            </div>
              </div>
          </div>
          </div>
          
          </div>
          <div class="col">
            <label class="w-100">
              Choose the photo
              <input type="file" class="d-none" id="cover" name="event_cover">
              <div class="coveimg shadow-sm">
                <img src="<?= ($event['event_id'] ? '/public/img/upload/' . $event['event_cover'] : $imgCover); ?>" class="mw-100">
              </div>
            </label>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-4" style="max-height: 277px; overflow: auto;">
            <div class="card border-0 shadow-sm">
              <div class="card-title col">
              Event tag category
              </div>
              <div class="card-header bg-white border-light text-right row m-0 justify-content-between align-items-center ybtinput">
                <small class="text-danger d-none txterror">This is Empty!</small>
                <input type="text"  class="form-control rounded-0 col-10" placeholder="Tag" style="font-size: 13px"> 
                <i class="fas fa-plus-square text-primary"></i>
                <small style="text-align: left; font-size: 11px; color: #b7b7b7;"><i>Exemple: Plotter or Router</i></small>
              </div>
              <ul class="list-group list-group-flush youtubelist">  
              <?php if($event): foreach(explode(',', $event['event_tag']) as $events):?>
                <li class="list list-group-item d-flex justify-content-between align-items-center border-light" data-url="<?= $events ?>">
                    <small><?= $events ?></small>
                    <i class="fas fa-minus-square text-danger delety"></i>
                </li>             
              <?php endforeach; endif;?>
              </ul>
            </div>
          </div>
          <div class="col-5" style="max-height: 277px; overflow: auto;">
            <label class="w-100">
              Event URL or Link
              <input type="text" name="event_url" id="prdurl" class="form-control rounded-0" value="<?= $event['event_url'] ?>">
              <small><b>Exemple</b>: <i>https://www.yoursite.com/this-is-a-product</i></small>
          </label>
          
          </div>
          <div class="col">
            <div class="card border-0 shadow-sm">
              <div class="card-title col">
                Status
              </div>
              <div class="custom-control custom-radio ml-3">
                <input type="radio" id="customRadio1" name="event_status" value="1" <?= ($event['event_status'] == 1 ? 'checked' : false) ?> class="custom-control-input">
                <label class="custom-control-label" for="customRadio1">Online</label>
              </div>
              <div class="custom-control custom-radio ml-3">
                <input type="radio" name="event_status" value="0" id="customRadio2" name="customRadio" <?= ($event['event_status'] == "0" ? 'checked' : false) ?> class="custom-control-input">
                <label class="custom-control-label" for="customRadio2">Offline</label>
              </div>
            </div>
          </div>
        </div>
        <label class="mt-5 position-relative">
          <input type="submit" value="Save Event" class="btn btn-primary pr-5">
          <i class="fad fa-save text-white position-absolute" style="right: 10px; top: 12px"></i>
        </label>
      </div>
    </div>
  </div>
  <div class="col-1 pr-0" style="background: #fbfbfb">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="p-3 active item_menu rounded-0 border text-center mb-2 position-relative active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fal fa-font-case"></i></a>
      <a class="p-3 item_menu rounded-0 border text-center mb-2 position-relative" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="far fa-window-restore"></i></a>
    </div>
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