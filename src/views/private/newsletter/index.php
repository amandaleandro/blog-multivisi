<?php
  $email = $navAdm->getDado()['email_body'];
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
      <th scope="col" class="text-center">Email</th>
      <th scope="col">Data de criação</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody class="text-muted">
    <?php if($email): foreach($email as $mail): ?>
      <tr>
        <th scope="row" class="text-center"><?= $mail['newsletter_id'] ?></th>
        <td class="text-center"><?= $mail['newsletter_title'] ?></td>
        <td><?= $mail['newsletter_create_at'] ?></td>
        <td class="actionicon">
            <a href="?page=newsletter/createBody/<?= $mail['newsletter_id'] ?>" class="text-secondary"><i class="fad fa-pencil"></i></a>
            <a href="#" class="text-secondary"><i class="fad fa-trash-undo trash" data-id="<?= $mail['newsletter_id'] ?>" data-toggle="modal" data-target="#exampleModal" data-name="<?= $mail['newsletter_title'] ?>"></i></a>
        </td>
      </tr>
    <?php endforeach; endif;?>
  </tbody>
</table>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end float-right shadow-sm">
      <li class="page-item disabled">
        <a class="page-link border-0 text-muted" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
      </li>
      <li class="page-item"><a class="page-link border-0 text-muted" href="#">1</a></li>
      <li class="page-item"><a class="page-link border-0 text-muted" href="#">2</a></li>
      <li class="page-item"><a class="page-link border-0 text-muted" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link border-0 text-muted" href="#">Próximo/a>
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
            Tem Certeza que você deseja Excluir o Arquivo?
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