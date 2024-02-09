<?php $this->view('includes/navigation', ['title' => 'My pupils']); ?>


<div class="container mx-auto shadow rounded container_task mt-5">
    <center>
        <h2>Your pupils:</h2>
    </center>

    <div class="card-group justify-content-center">
        <?php if (is_array($pupils)) : ?>
            <?php foreach ($pupils as $pupil) : ?>
                <form method="POST" action="pupils/delete/<?=$pupil->userId?>">

                    <div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
                        <img src="<?= getImage($pupil->gender) ?>" class="card-img-top rounded-circle p-4" style="width:14rem;height:14rem;">
                        <input type="hidden" name="userId" value="<?= $pupil->userId ?>">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title"><?= $pupil->firstName ?> <?= $pupil->lastName ?></h5>
                                <button href="<?= ROOT ?>/profile/<?= $pupil->url_address ?>" class="btn btn-primary">Profile</button>
                                <input value="Delete" name="submit" type="submit" class="btn btn-danger">
                            </center>



                        </div>
                    </div>
                </form>

            <?php endforeach; ?>
        <?php else : ?>
            <h4>You don't have any pupils</h4>
        <?php endif ?>

    </div>
    <div class="mt-5" align="right">
        <a href="pupils/addPupil" class="btn btn-primary">Add a pupil <i class="fas fa-plus"></i></a>
    </div>
    <?= $pagination->display() ?>



</div>


<?php $this->view('includes/footer', ['title' => 'My pupils']); ?>