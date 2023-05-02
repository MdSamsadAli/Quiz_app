<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="<?php base_url() ?>assets/css/bootstrap.min.css">

</head>
<body>


<!-- Section: Design Block -->
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 ">
            <form action="<?php base_url() ?>user" method="post" >
              <h3 class="mb-5 text-center"> Start Quiz Game </h3>

              <div class="form-outline mb-4">
                <span class="text-danger">
                  <?php echo form_error('username'); ?>
                </span>
                <input type="text" id="username" class="form-control form-control-lg" name="username" />
                <label class="form-label" for="typeEmailX-2" >Username</label>
              </div>

              <div class="text-center">
                  <button class="btn btn-primary btn-lg btn-block form-control" type="submit">Start</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
    
</body>
</html>