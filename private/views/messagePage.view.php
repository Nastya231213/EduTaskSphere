<?php $this->view('includes/navigation', ['title' => 'Message']); ?>
<a href="<?= ROOT ?>/home" class="btn btn-outline-dark text-dark m-4 ">
    Back <i class="fas fa-backward"></i>
</a>
<?php if (isset($message)) : ?>
    <div class="container mt-4">
        <center>
            <h2><?= $message ?></h2>
        </center>
    </div>
<?php endif; ?>