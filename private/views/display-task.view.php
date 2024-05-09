 <?php $this->view('includes/navigation', ['title' => 'View tasks']); ?>


 <div class="container mx-auto shadow mt-5 container_task ">
     <div class="text-center">
         <h2 class="mb-3  py-4"><?php echo $role == 'teacher' ? 'Tasks created by you' : 'Tasks that were sent to you' ?></h2>
     </div>
     <div class="shadow container my-5 w-75 p-4 ">
         <form>
             <input type="hidden" name="role" value="<?= $role ?>">

             <div class="row">
                 <div class="col-md-6">
                     <div class="input-group rounded w-75">
                         <input type="search" class="form-control rounded" name="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                         <span class="input-group-text border-0" id="search-addon">
                             <i class="fas fa-search"></i>
                         </span>
                     </div>

                 </div>
                 <div class="col-md-4 wrapper">
                     <select name="subject" class="form-select mb-3" aria-label="Default select example">
                         <option selected value="">Choose subject</option>
                         <?php foreach (POSSIBLE_SUBJECTS as $subject) : ?>
                             <option value="<?= $subject ?>"><?= $subject ?></option>
                         <?php endforeach; ?>
                     </select>
                 </div>

                 <div class="col-md-2">
                     <div class="input-group date" data-target-input="nearest">
                         <input type="text" name="deadline" class="form-control datetimepicker-input" id="datepicker" data-target="#datepicker" placeholder="Deadline" />
                         <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                             <div class="input-group-text"><i class="fa fa-calendar p-2"></i></div>
                         </div>
                     </div>
                 </div>
             </div>

             <div align="center ">
                 <input type="submit" value="Apply" class="btn btn-primary btn-sm w-25 mt-5">
             </div>
         </form>
     </div>
     <div class="card-group ">
         <div class="card-body">

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

             <table class="table table-striped" id="tasks">
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
                                 <td> <?= $task->completionStatus ?></td>
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
                         </tr>
                     <?php endforeach; ?>
                 <?php else : ?>
                     <h4>No tasks were found at this time</h4>
                 <?php endif; ?>
             </table>
         </div>
     </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
 <script>
     $(function() {
         $("#datepicker").datepicker();
     });
     $(document).ready(function() {
         $('form').submit(function(event) {
             event.preventDefault();
             var tasksData = <?php echo json_encode($tasks); ?>;

             var formData = $(this).serialize();

             formData += '&tasks=' + JSON.stringify(tasksData);

             $.ajax({
                 type: 'POST',
                 url: '../core/helper_functions.php',
                 data: formData,
                 success: function(data) {
                     $('#tasks').html(data);
                 },
                 error: function(xhr, status, error) {
                     console.error(xhr.responseText);

                 }
             });
         });
     });;
 </script>
 <?php $this->view('includes/footer'); ?>