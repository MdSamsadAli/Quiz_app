<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin|Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<!-- Section: Design Block -->
<section class="vh-100 ">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong login-design" style="border-radius: 1rem;">
          <div class="card-body p-5 ">
            <form action="<?php base_url() ?>login" method="post" >
              <h3 class="mb-5 text-center"> Admin Login </h3>

              <div class="form-outline mb-4">
                <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email" />
                <label class="form-label bold" for="typeEmailX-2" >Email</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" />
                <label class="form-label bold" for="typePasswordX-2" >Password</label>
              </div>

              <!-- Checkbox -->
              <div class="text-center">
                  <button class="btn btn-primary btn-lg btn-block form-control" type="submit">Login</button>
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