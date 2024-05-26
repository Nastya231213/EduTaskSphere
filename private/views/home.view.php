<?php $this->view('includes/navigation',['title'=>'Home']) ?>
<?php
if (!isSignIn()) {
    $this->redirect('login');
}
?>
<h2 class="text-center mt-5">Welcome, <?= getUserInformation('firstName'); ?> <?= getUserInformation('lastName'); ?>!</h2>


<br>
<div class="container p-3">
    <div class="row">
        <div class="col-md-6 ">
            <a href="<?= ROOT ?>/task/display">
                <div class="card rounded-card shadow ">
                    <div class="card-body ">
                        <i class="fas fa-tasks fa-4x card_blue"></i><br>
                        <h2>Your tasks</h2>
                    </div>

                </div>
            </a>


        </div>
        <div class="col-md-6">
            <a href="<?= ROOT ?>/task/display" style="color: #4E4FEB">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-check fa-4x" style="color: #4E4FEB;"></i><br>
                        <h2>Completed tasks</h2>
                    </div>

                </div>
            </a>
        </div>



        <div class="col-md-6 mt-3">
            <a href="#" style="color: #A66CFF;">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-window-restore fa-4x" style="color: #A66CFF;"></i><br>
                        <h2>Your marks </h4>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-md-3 mt-3">
            <a href="#">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-sign-out-alt fa-4x" style="color: #5837D0;"></i><br>
                        <h2>Your teachers</h2>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-md-3 mt-3">
            <a href="logout">
                <div class="card rounded-card shadow">
                    <div class="card-body">
                        <i class="fas fa-sign-out-alt fa-4x" style="color: #5837D0;"></i><br>
                        <h2>Logout</h2>
                    </div>

                </div>
            </a>


        </div>
        <ul>

        </ul>
    </div>

</div>

<?php $this->view('includes/footer') ?>