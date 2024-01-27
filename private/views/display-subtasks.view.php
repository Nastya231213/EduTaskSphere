<?php $this->view('includes/navigation', ['title' => 'View tasks']); ?>



<div class="container mx-auto shadow mt-5 p-2 container_task ">
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

            <?php elseif ($subtask->subtaskType == 'open-ended-question') : ?>
                <textarea class="form-control p-3 mb-2" rows="3" readonly ><?= $subtask->question?></textarea>

            <?php endif ?>
            <button type="button" class=" col-md-3 btn btn-sm btn-info mx-auto mt-3">Edit</button>
        </div>
    <?php endforeach ?>
    <br><br>
</div>
<?php $this->view('includes/footer'); ?>