<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
</head>

<body>
  <div class="container-fluid vh-75 mt-4">
    <div class="rounded d-flex justify-content-center">
      <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
        <div class="text-center">
          <h3 class="text-success">Login</h3>
        </div>
        <?php if (isset($errors) && count($errors) > 0) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Errors:</strong>
                    <?php foreach ($errors as $error) : ?>
                        <br><?= $error ?>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <div class="p-4">
          <form method="POST" action="">
    
            <div class="input-group mb-3">
              <span class="input-group-text bg-success"><i class="bi bi-envelope text-white"></i></span>
              <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text bg-success"><i class="bi bi-key-fill text-white"></i></span>
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
        
            <div class="d-grid col-12 mx-auto">
              <button class="btn btn-success" type="submit"><span></span> Sign in</button>
            </div>
            <p class="text-center mt-3">Don't you have an account?
             <a href="<?=ROOT?>/registration"> <span class="text-success">Sign up</span></a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>