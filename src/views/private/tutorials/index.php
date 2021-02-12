
<?php
  $tutorial = $navAdm->getDado()['tutorials'];
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
      <th scope="col" class="text-center">Post blog </th>
      <th scope="col">Status</th>
      <th scope="col">Data da Criação</th>
      <th scope="col">Vizualizações</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody class="text-muted">
    <?php if($tutorial): foreach($tutorial as $tuor): ?>
      <tr>
        <th scope="row" class="text-center"><?= $tuor['tutorial_id'] ?></th>
        <td class="text-center"><?= $tuor['tutorial_title'] ?></td>
        <td><span class="<?= ($tuor['tutorial_status'] == 1 ? 'bg-success' : 'bg-danger') ?> d-block rounded-circle ml-3" style="width: 8px; height: 8px;"></span></td>
        <td><?= $tuor['tutorial_create_at'] ?></td>
        <td><?= $tuor['tutorial_like'] ?></td>
        <td class="actionicon">
            <a href="?page=tutorials/create/<?= $tuor['tutorial_id'] ?>" class="text-secondary"><i class="fad fa-pencil"></i></a>
            <a href="https://www.<?= SITENAME . '/blog/' . $tuor['tutorial_url'] ?>" class="text-secondary ml-1 mr-1"><i class="fad fa-globe-americas"></i></a>
            <a href="#" class="text-secondary"><i class="fad fa-trash-undo trash" data-id="<?= $tuor['tutorial_id'] ?>" data-toggle="modal" data-target="#exampleModal" data-name="<?= $tuor['tutorial_title'] ?>"></i></a>
        </td>
      </tr>
    <?php endforeach; else: echo "<p class='alert alert-warning text-center col '>Any tutorials yet. click <b><a href='?page=tutorials/create' class='alert-link'>here</a></b> for create a tutorial</p>"; endif;?>
  </tbody>
</table>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end float-right shadow-sm">
      <li class="page-item disabled">
        <a class="page-link border-0 text-muted" href="#" tabindex="-1" aria-disabled="true">Previous</a>
      </li>
      <li class="page-item"><a class="page-link border-0 text-muted" href="#">1</a></li>
      <li class="page-item"><a class="page-link border-0 text-muted" href="#">2</a></li>
      <li class="page-item"><a class="page-link border-0 text-muted" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link border-0 text-muted" href="#">Next</a>
      </li>
    </ul>
  </nav>
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
            <h5 class="mt-0">Importante!</h5>
           Você tem certeza que quer Excluir esse post?
          </div>
      </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-danger rounded-0" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn rounded-0 btn-light btnyes" data-id="">Excluir</button>
      </div>
    </div>
  </div>
</div>