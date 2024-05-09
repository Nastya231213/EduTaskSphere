<?php $this->view('includes/navigation', ['title' => 'View tasks']); ?>



<div class="container mx-auto shadow mt-5 container_task ">
    <div class="card-group ">
        <div class="card-body">

 <h2 align="center">Solutions</h2>
            <a href="<?= ROOT ?>/home" class="btn btn-outline-dark text-dark mb-2">
                Back <i class="fas fa-backward"></i>
            </a>
            <?php if (isset($messageSuccess) || isset($messageError)) : ?>
                <?php
                $type = 'success';
                $message = isset($messageSuccess) ? $messageSuccess : $messageError;

                if (isset($messageError)) {
                    $type = 'danger';
                }
                ?>

        </div>
    <?php endif; ?>

    <table class="table table-striped ">
        <tr>
            <th>Pupil</th>
            <th>Task</th>
            <th>Date</th>
            <th>Action</th>


        </tr>
        <?php if (isset($solutions)) : ?>

            <?php foreach ($solutions as $solution) : ?>
                <tr>
                    <td><?= $solution->firstName ?> <?= $solution->lastName ?></td>
                    <td>
                        <?= $solution->title ?>
                    </td>
                    <td><?= $solution->date ?></td>
                    <td> <a href="<?= ROOT ?>/task/answer/<?=$solution->taskId?>/<?=$solution->pupilId?>">
                            <button class="btn btn-sm btn-info"> See answer</button>
                        </a>
                    </td>
                <tr>
                <?php endforeach; ?>
            <?php else : ?>
                <h4>No tasks were found at this time</h4>
            <?php endif; ?>
    </table>
    </div>
</div>
</div>
<?php $this->view('includes/footer'); ?>