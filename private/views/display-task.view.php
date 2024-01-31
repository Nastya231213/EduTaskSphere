 <?php $this->view('includes/navigation',['title'=>'View tasks']);?>



 <div class="container mx-auto shadow mt-5 container_task " >
    <div class="card-group justify-content-center">
    <h2 align="center" class="mb-5 mt-3">Tasks created by you</h2>

        <table class="table table-striped ">
            <tr>
                <th>Details</th>
                <th>Task</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Actions</th>
                <th>
                    <a href="<?= ROOT ?>/schools/add"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add New</button></a>
                </th>

            </tr>
            <?php if (isset($tasks)) : ?>

                <?php foreach ($tasks as $task) : ?>
                    <tr>
                    <td><a class="btn btn-info" href="<?= ROOT ?>/task/subtasks/<?=$task->task_id?>"> <i class="fa fa-chevron-right"></i></a></td>
                        <td><?= $task->title ?></td>
                        <td><?=$task->description?></td>
                        <td><?=$task->deadline?></td>

                        <td>
                            <a href="<?= ROOT ?>/task/addSubtasks/<?= $task->task_id ?>">
                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/task/addPupils/<?= $task->task_id ?>">
                                <button class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add user</button>
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
<?php $this->view('includes/footer'); ?>






