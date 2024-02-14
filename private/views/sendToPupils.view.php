<?php $this->view('includes/navigation', ['title' => 'Simple task']); ?>


<div class="container mx-auto shadow rounded container_task mt-5">
    <center>
        <h2>The task</h2>
    </center>
    <br>
    <div class="float-start">
        <a href="<?= isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '#' ?>" class="btn btn-outline-dark text-dark">
            Back <i class="fas fa-backward"></i>
        </a>
    </div>
    <br><br>

    <div class="card-group justify-content-center">
        <?php if (isset($message) && $message != '') : ?>

            <div class="alert alert-success mb-5" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <br><br>

        <?php if (isset($task)) : ?>

            <table class="table table-striped table-hover">

                <tr>
                    <th>Title</th>
                    <td><?= $task->title ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?= $task->description ?></td>

                </tr>
                <?php if (isset($user)) : ?>
                    <tr>
                        <th>Created by</th>
                        <td><?= $user->firstName ?> <?= $user->lastName ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th>Deadline</th>
                    <td><?= $task->deadline ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?= $task->type ?></td>
                </tr>






            <?php else : ?>
                <h4>No tasks were found with this ID</h4>
            <?php endif; ?>
            </table>

    </div>
    <nav class="navbar navbar-light bg-light">


        <form class="form-inline">
            <div class="input-group flex-nowrap">
                <button class="input-group-text"><i class="fas fa-search"> </i></button>
                <input name="keyToFind" type="text" class="form-control" placeholder="Enter your key" aria-label="Username">
            </div>

        </form>
    </nav>
    <form method="POST">

        <div class="card-group justify-content-center">
            <?php if (is_array($pupils) && count($pupils) > 0) : ?>
                <?php foreach ($pupils as $pupil) : ?>

                    <div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
                        <img src="<?= getImage($pupil->gender) ?>" class="card-img-top rounded-circle p-4" style="width:14rem">
                        <input type="hidden" name="userId" value="<?= $pupil->userId ?>">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title"><?= $pupil->firstName ?> <?= $pupil->lastName ?></h5>
                                <button href="<?= ROOT ?>/profile/<?= $pupil->url_address ?>" class="btn btn-primary">Profile</button>
                                <input value="Select" name="submit" type="submit" class="btn btn-success">
                            </center>



                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else : ?>
                <h4 class="mt-5 mb-5">No staff members were found at this time</h4>
            <?php endif ?>

        </div>
    </form>

</div>

</div>



</div>
<?= $pagination->display() ?>

<?php $this->view('includes/footer'); ?>