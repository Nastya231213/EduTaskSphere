<?php $this->view('includes/navigation', ['title' => 'Simple task']); ?>


<div class="container mx-auto shadow rounded container_task mt-5">
    <center>
        <h2>The task</h2>
    </center>
    <br>
    <div class="float-start">
    <a  href="<?=ROOT.'/home'?>"class="btn btn-dark" >Back<i class="fas fa-long-arrow-alt-left"></i></a>

    </div>
    <br><br>

    <div class="card-group justify-content-center">
        <?php if (isset($message) && $message!='') : ?>

            <div class="alert alert-success mb-5" role="alert">
                <?=$message?>
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
            <div class="container-fluid">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <h5> <a class="nav-link <?= $pageTab == 'test-question' ? 'active_' : '' ?> aria-current=" href="<?= ROOT ?>/task/addSubtasks/<?= $task->task_id ?>?tab=test-question">Test question</a></h5>
                    </li>
                    <li class="nav-item">
                        <h5> <a class="nav-link <?= $pageTab == 'open-ended-question' ? 'active_' : '' ?>" href="<?= ROOT ?>/task/addSubtasks/<?= $task->task_id ?>?tab=open-ended-question">Open Ended question</a></h5>
                    </li>
                    <li class="nav-item">
                        <h5> <a class="nav-link <?= $pageTab == 'multiplechoice-question' ? 'active_' : '' ?>" href="<?= ROOT ?>/task/addSubtasks/<?= $task->task_id ?>?tab=multiplechoice-question">MultipleChoice question</a></h5>
                    </li>
                </ul>
                <br>

                <?php
                switch ($pageTab) {
                    case 'test-question':
                        include(viewsPathInc('testQuestion-tab'));
                        break;
                    case 'open-ended-question':
                        include(viewsPathInc('openEndedQuestion'));
                        break;
                    case 'multiplechoice-question':
                        include(viewsPathInc('multiple-choiceQuestion'));
                        break;
                }

                ?>


            </div>
    </div>

</div>

<?php $this->view('includes/footer'); ?>