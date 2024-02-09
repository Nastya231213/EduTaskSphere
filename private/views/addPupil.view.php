<?php $this->view('includes/navigation', ['title' => 'My pupils']); ?>

<div class="container mx-auto shadow rounded container_task mt-5">

    <center>
        <h2>Add a new pupil to the subject</h2>
    </center>
    <form method="GET">
        <div class="col-md-5 mt-5">

            <div class="input-group rounded">
                <input type="search" name="keyToFind" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn border-0 search-btn ">
                    <span class="input-group-text border-0 searchPupil" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </button>
            </div>
        </div>
    </form>
    <br><br>
    <?php if (isset($searchResult)) : ?>
        <form method="POST">

            <div class="card-group justify-content-center">
                <?php if (!empty($searchResult)) : ?>
                    <?php foreach ($searchResult as $pupil) : ?>

                        <div class="card m-2 shadow-sm" style="max-width: 14rem;min-width: 14rem;">
                            <img src="<?= getImage($pupil->gender) ?>" class="card-img-top rounded-circle p-4" style="width:14rem">
                            <input type="hidden" name="userId" value="<?= $pupil->userId ?>">
                            <div class="card-body">
                                <center>
                                    <h5 class="card-title"><?= $pupil->firstName ?> <?= $pupil->lastName ?></h5>
                                    <button href="<?= ROOT ?>/profile/<?= $pupil->url_address ?>" class="btn btn-primary">Profile</button>
                                    <input value="Add" name="submit" type="submit" class="btn btn-info">
                                </center>



                            </div>
                        </div>

                    <?php endforeach; ?>


            </div>
            </form>

            <?= $pagination->display() ?>

        <?php else : ?>
            <h4 class="mb-5">Nobody was found</h4>
        <?php endif ?>

    <?php else : ?>
        <center>


            <h4 class="text-gray ">Enter indentifying information about a pupil</h4>
        </center>
        <br><br>
    <?php endif; ?>
</div>