 <?php $this->view('includes/navigation', ['title' => 'View tasks']); ?>



 <div class="container mx-auto shadow mt-5 container_task ">
     <div class="card-group ">
         <div class="card-body">

             <div class="text-center">
                 <h2 class="mb-3 mt-1"><?php echo $role == 'teacher' ? 'Tasks created by you' : 'Tasks that were sent to you' ?></h2>
             </div>
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
                 <div class="alert alert-<?= $type ?> alert-dismissible fade show mt-3 mx-auto text-center col-md-4" role="alert">
                     <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                         <use xlink:href="#check-circle-fill" />
                     </svg>
                     <?= $message ?>
                 </div>
             <?php endif; ?>

             <table class="table table-striped ">
                 <tr>
                     <th>Details</th>
                     <th>Task</th>
                     <th>Description</th>
                     <th>Deadline</th>
                     <?php if ($role == 'pupil') : ?>
                         <th>Teacher</th>
                         <th>Status</th>

                     <?php endif; ?>
                     <th>Actions</th>
                     <?php if ($role == 'teacher') : ?>
                         <th>
                             <a href="<?= ROOT ?>/task/add"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add New</button></a>
                         </th>
                     <?php endif; ?>

                 </tr>
                 <?php if (isset($tasks)) : ?>

                     <?php foreach ($tasks as $task) : ?>
                         <tr>
                             <td><a class="btn btn-info" href="<?= ROOT ?>/task/subtasks/<?= $task->task_id ?>"><i class="fa fa-chevron-right"></i></a></td>
                             <td><?= $task->title ?></td>
                             <td><?= $task->description ?></td>
                             <td><?= $task->deadline ?></td>
                             <?php if ($role == 'pupil') : ?>
                                 <td><?= $task->firstName ?> <?= $task->lastName ?></td>
                              <td> <?=$task->completionStatus?></td>   
                             <?php endif ?>
                             <td>
                                 <?php if ($role == 'teacher') : ?>
                                     <a href="<?= ROOT ?>/task/edit/<?= $task->task_id ?>">
                                         <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                                     </a>
                                     <a href="<?= ROOT ?>/task/sendToPupils/<?= $task->task_id ?>">
                                         <button class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add user</button>
                                     </a>
                                     <a href="<?= ROOT ?>/task/users/<?= $task->task_id ?>">
                                         <button class="btn btn-sm btn-info"><i class="fas fa-users"></i> View users</button>
                                     </a>
                                 <?php else : ?>
                                     <?php if ($task->completionStatus == 'Not Started') : ?>

                                         <a href="<?= ROOT ?>/task/accept/<?= $task->task_id ?>">
                                             <button class="btn btn-sm btn-success"><i class="fa fa-check"></i> Accept</button>
                                         </a>
                                         <a href="<?= ROOT ?>/task/reject/<?= $task->task_id ?>/<?= $task->userId ?>">
                                             <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Reject</button>
                                         </a>
                                     <?php else : ?>
                                         <p class="text-success">The task is accepted.</p>
                                         <a href="<?= ROOT ?>/task/perfom/<?= $task->task_id ?>">
                                             <button class="btn btn-sm btn-info"> Perform the task</button>
                                         </a>
                                      
                                     <?php endif ?>
                                 <?php endif; ?>
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