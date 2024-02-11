<?php $this->view('includes/navigation', ['title' => 'Notifications']); ?>

<div class="containerForNotifications">
    <?php if (isset($messageSuccess) || isset($messageError)) : ?>
        <?php
        $type = 'success';
        $message = isset($messageSuccess) ? $messageSuccess : $messageError;

        if (isset($messageError)) {
            $type = 'danger';
        }

        ?>
        <?php if (isset($allNotifications) && count($allNotifications) > 0) : ?>
            <div class="shadow notificationCard">
                <div id="write_post_bar">

                    <div align="center" class="alert alert-<?= $type ?> alert-dismissible fade show col-md-6 mt-3" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>

                        <?= $message ?>
                    </div>

                <?php endif; ?>
                <?php foreach ($allNotifications as $notification) : ?>
                    <div class="mt-3 notific shadow p-3">
                        <span class="title"><?= $notification->title ?></span>

                        <span class="message"><?= $notification->message ?></span>

                        <br>

                        <span class='date'><?= $notification->created_at ?></span>
                        <div align="right">
                            <?php if ($notification->type == 'Confirmation') : ?>
                                <form method="POST" action="<?= ROOT ?>/notification/accept/<?= $notification->sender_id ?>">

                                    <button type="submit" class="btn btn-success btn-sm">Accept</button>

                                <?php endif; ?>

                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash fa-sm"></i></button>
                                </form>

                        </div>

                    </div>

                </div>
            <?php endforeach; ?>


            </div>
        <?php else : ?>
            <div class="mt-5 mx-auto">
                <h2>No notifications</h2>

            </div>

        <?php endif ?>
</div>
<?php $this->view('includes/footer') ?>