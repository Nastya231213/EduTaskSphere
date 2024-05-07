<?php $this->view('includes/navigation', ['title' => 'Perform the task']); ?>





<div class="container mx-auto shadow mt-5 p-2 container_task ">

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
                        <th>Your teacher</th>
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
    <form method="POST">
        <?php $numberOfSubtasks = 1; ?>

        <?php foreach ($subtasks as $subtask) : ?>

            <div class="card rounded col-md-6 mt-5 mx-auto p-3 ">
                <h3 align="center"> Subtask <?= $numberOfSubtasks++ ?></h3>
                <?php $type = $subtask->subtaskType; ?>
                <?php if ($type == 'test-question' || $type == 'multiplechoice-question') : ?>

                    <textarea name="questionTest" readonly class="form-control p-3" rows="4" required><?= $subtask->question ?></textarea>

                    <?php $i = 1; ?>
                    <?php foreach ($subtask->choices as $choice) : ?>
                        <label for="option1">
                            <h5 class="mt-2">Option <?= $i++; ?>:</h5>
                        </label>
                        <input type="text" value='<?= $choice->optionText ?>' class="form-control " readonly required>

                    <?php endforeach; ?>
                    <label for="correctAnswer">
                        <h5>Your answer (Option Number):</h5>
                    </label>
                    <input type="number" id="correctAnswer" name="correctAnswer<?= $subtask->subtaskId ?>" class="form-control mb-2" required>

                <?php elseif ($subtask->subtaskType == 'open-ended-question') : ?>
                    <textarea class="form-control p-3 mb-2" rows="3" readonly><?= $subtask->question ?></textarea>
                    <label for="correctAnswer">
                        <h5>Correct Answer </h5>
                    </label>
                    <textarea name="correctAnswer<?= $subtask->subtaskId?>" class="form-control p-3 mb-2" rows="3" required></textarea>

                <?php endif ?>

            </div>
        <?php endforeach ?>
        <center class="mt-4">
            <input type="submit" class="btn btn-success " value="Submit answers">

            <input type="submit" class="btn btn-secondary " value="Save">

        </center>
    </form>
</div>
<?php $this->view('includes/footer'); ?>