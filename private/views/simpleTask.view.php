<?php $this->view('includes/navigation', ['title' => 'Simple task']); ?>


<div class="container mx-auto shadow rounded container_task mt-5">

    <div class="card-group justify-content-center">
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
                        <h5> <a class="nav-link  aria-current=" page" href="">Test question</a></h5>
                    </li>
                    <li class="nav-item">
                        <h5> <a class="nav-link <?= $page_tab == 'classes' ? 'active' : '' ?>" href="">fd</a></h5>
                    </li>
                    <li class="nav-item">
                    <h5>  <a class="nav-link <?= $page_tab == 'tests' ? 'active' : '' ?>" href="">Test</a></h5>
                    </li>
                </ul>


            </div>
    </div>

</div>
<?php $this->view('includes/footer'); ?>