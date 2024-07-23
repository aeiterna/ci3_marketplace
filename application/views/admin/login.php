<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">

    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">
                            <h3 class="text-center mt-5 mb-4">
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="<?php echo base_url();?>assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark">
                                    <img src="<?php echo base_url();?>assets/images/logo-light.png" alt="" height="30" class="auth-logo-light">
                                </a>
                            </h3>

                            <?php if(isset($error_message) && !empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                            <?php endif; ?>

                            <div class="p-3">
                                <h4 class="text-muted font-size-18 mb-1 text-center">Login.</h4>
                                <form class="form-horizontal mt-4" action="<?php echo base_url("admin/index"); ?>" method="post">

                                    <input type='hidden' name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                      value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <div class="mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                    </div>

                                    <div class="mb-3 row mt-4">
                                        <div class="col-6 text">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Log In</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        ©
                        <script>document.write(new Date().getFullYear())</script></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
