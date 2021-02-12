<?php
  $email = $navAdm->getDado()['email_body'][0];
?>


<div class="container">
    <form action="" method="post" class="form_body mt-3 col">
        <input type="hidden" name="action" value="<?= ($email['newsletter_id'] ? 'update_newsletter' : 'create_newsletter') ?>">
        <input type="hidden" name="newsletter_id" value="<?= ($email['newsletter_id'] ? $email['newsletter_id'] : '0') ?>">
        <label class="col">
            Email
            <input type="text" name="newsletter_title" value="<?= $email['newsletter_title'] ?>" class="form-control border-0 shadow-sm">
        </label>
        <label class="col">
            <textarea name="newsletter_content" id="" cols="30" rows="10" class="tinymce"><?= $email['newsletter_content'] ?></textarea>
        </label>
        <label class="col position-relative">
            <input type="submit" value="Save Newsletter" class="btn btn-primary pr-5">
            <i class="fad fa-save position absolute text-white" style="top: 3px; right: 25px;"></i>
        </label>
    </form>
</div>


