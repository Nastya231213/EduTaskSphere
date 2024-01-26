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
                <th>
                    <a href="<?= ROOT ?>/schools/add"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add New</button></a>
                </th>

            </tr>
            <?php if (isset($tasks)) : ?>

                <?php foreach ($tasks as $task) : ?>
                    <tr>

                    <td><button class="btn  btn-info"><i class="fa fa-chevron-right"></i></button></td>
                        <td><?= $task->title ?></td>
                        <td><?=$task->description?></td>
                        <td><?=$task->deadline?></td>

                        <td>
                            <a href="<?= ROOT ?>/task/<?= $task->taskId ?>">
                                <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                            </a>
                        
                        </td>
                    <tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h4>No schools were found at this time</h4>
                <?php endif; ?>
        </table>

    </div>
 </div>
<?php $this->view('includes/footer'); ?>






