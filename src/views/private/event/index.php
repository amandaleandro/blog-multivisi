<?php
  $events = $navAdm->getDado()['events'];
  $navp = $navAdm->getDado()['pagination'];
?>

<div class="container-fluid mt-3">
    <div class="mb-4">
        <form action="" method="post" class="position-relative col-2 p-0 ml-auto" id="form_search">
            <input type="text" name="search" id="" class="form-control border-0 shadow-sm" placeholder="Search...">
            <i class="fal fa-search position-absolute" style="top: 13px; right: 15px"></i>
        </form>
    </div>
 
    <table class="table table-striped border-0 shadow-sm">
  <thead>
    <tr class="bg-light">
      <th scope="col" class="text-center">ID</th>
      <th scope="col" class="text-center">Event title</th>
      <th scope="col">Status</th>
      <th scope="col">Date event</th>
      <th scope="col">Event Branch</th>
      <th scope="col">Event tag</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="text-muted box_list">
    <?php if($events): foreach($events as $event): ?>
      <tr>
        <th scope="row" class="text-center"><?= $event['event_id'] ?></th>
        <td class="text-center"><?= $event['event_title'] ?></td>
        <td><span class="<?= ($event['event_status'] == 1 ? 'bg-success' : 'bg-danger') ?> d-block rounded-circle ml-3" style="width: 8px; height: 8px;"></span></td>
        <td><?= $event['event_date'] ?></td>
        <td><?= ($event['event_branch'] == 1 ? '<i class="fas fa-star text-warning"></i>' : '<i class="fas fa-star text-secondary"></i>') ?></td>
        <td><?= $event['event_tag'] ?></td>
        <td class="actionicon">
            <a href="?page=event/create/<?= $event['event_id'] ?>" class="text-secondary"><i class="fad fa-pencil"></i></a>
            <a href="#" class="text-secondary"><i class="fad fa-trash-undo trash" data-id="<?= $event['event_id'] ?>" data-toggle="modal" data-target="#exampleModal" data-name="<?= $event['event_title'] ?>"></i></a>
        </td>
      </tr>
    <?php endforeach; else: echo '<p class="alert alert-warning text-center">Yet no have event, create <a class="alert-link" href="?page=event/create">here</a></p>'; endif;?>
  </tbody>
</table>
<div class="border-0 text-muted pag">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end m-0">
                        <li class="page-item disabled shadow-sm">
                            <a class="page-link border-0" href="#" tabindex="-1" aria-disabled="true">
                                <small>first</small>
                            </a>
                        </li>
                        <?php for($i = 1; $i <= $navp['pagination']; $i++): ?>
                        <li class="page-item shadow-sm"><a class="page-link border-0" href="#" data-page="<?=$i?>"><small><?=$i?></small></a></li>
                        <?php endfor; ?>
                        <li class="page-item shadow-sm"><a class="page-link border-0" href="#"><small>last</small></a></li>
                    </ul>
                </nav>
            </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 rounded-0 shadow">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel">Delete: <i><span class="nameprod" style="font-weight: 100"></span></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="media">
          <i class="fad fa-comment-alt-exclamation mr-3 text-danger" style="font-size: 78px"></i>
          <div class="media-body text-muted">
            <h5 class="mt-0">Important!</h5>
            Are you sure you want to delete this file?
          </div>
      </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-danger rounded-0" data-dismiss="modal">Not</button>
        <button type="button" class="btn rounded-0 btn-light btnyes" data-id="">Yes, I'm sure!</button>
      </div>
    </div>
  </div>
</div>