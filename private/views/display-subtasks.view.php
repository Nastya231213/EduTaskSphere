<?php $this->view('includes/navigation', ['title' => 'View tasks']); ?>



<div class="container mx-auto shadow mt-5 p-2 container_task ">
    <?php $numberOfSubtasks = 1; ?>
    <a href="<?= isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '#' ?>" class="btn btn-outline-dark text-dark">Back <i class="fas fa-backward"></i></a>

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

            <?php elseif ($subtask->subtaskType == 'open-ended-question') : ?>
                <textarea class="form-control p-3 mb-2" rows="3" readonly><?= $subtask->question ?></textarea>

            <?php endif ?>
            <?php if (isset($role) && $role == 'teacher') : ?>
                <button type="button" class=" col-md-3 btn btn-sm btn-info mx-auto mt-3">Edit</button>
            <?php elseif (isset($role) && $role == 'pupil') : ?>

                <?php if (isset($subtask->answer->answer_option)) : ?>
                    <h5 align="center" class="mt-3">You have chosen the option with number:</h4>

                    <input type="number" value="<?= $subtask->answer->answer_option ?>" class="form-control mb-2 mt-3"  readonly>
                <?php elseif (isset($subtask->answer->answer_text)) : ?>
                    <h5 align="center" class="mt-3">Your answer:</h4>

                    <textarea value="<?= $subtask->answer->answer_text ?>" class="form-control p-3 mb-2" rows="3" readonly></textarea>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach ?>
    <br><br>
</div>
<?php $this->view('includes/footer'); ?>