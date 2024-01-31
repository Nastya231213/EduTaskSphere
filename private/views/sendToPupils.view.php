<?php $this->view('includes/navigation', ['title' => 'Simple task']); ?>


<div class="container mx-auto shadow rounded container_task mt-5">
    <center>
        <h2>The task</h2>
    </center>
    <br>
    <div class="float-start">
        <a href="<?= ROOT . '/home' ?>" class="btn btn-dark">Back<i class="fas fa-long-arrow-alt-left"></i></a>

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
    <div class="card-group justify-content-center">
        <?php if (is_array($pupils)) : ?>
            <?php foreach ($pupils as $pupil) : ?>

                <div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
                    <img src="<?= getImage($pupil->gender) ?>" class="card-img-top rounded-circle p-4" style="width:14rem">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title"><?= $pupil->firstName ?> <?= $pupil->lastName ?></h5>
                            <a href="<?= ROOT ?>/profile/<?= $pupil->url_address ?>" class="btn btn-primary">Profile</a>
                        <a href="<?= ROOT ?>/profile/<?= $pupil->url_address ?>" class="btn btn-success">Select</a>
                        </center>
 


                    </div>
                </div>

            <?php endforeach; ?>
        <?php else : ?>
            <h4>No staff members were found at this time</h4>
        <?php endif ?>

    </div>

</div>

</div>



</div>

<?php $this->view('includes/footer'); ?>