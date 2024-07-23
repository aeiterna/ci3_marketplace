<?php
$this->load->view('customer/header');
?>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">
                            <div class="mb-4"></div>

                            <?php if(isset($error_message) && !empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                            <?php endif; ?>

                            <div class="p-3">
                                <h4 class="text-muted font-size-18 mb-1 text-center">Enter OTP Code</h4>
                                <p class="text-center">A code has been sent to <?php echo $email; ?>.</p>
                                <form class="form-horizontal mt-4" action="<?php echo base_url("customer/verify_otp"); ?>" method="post">

                                    <input type='hidden' name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                      value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <div class="mb-3">
                                        <label for="otp_code">OTP Code</label>
                                        <input type="text" class="form-control" id="otp_code" name="otp_code" placeholder="Enter OTP Code" required>
                                    </div>

                                    <div class="mb-3 row mt-4">
                                        <div class="col-6 text">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Verify</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-center mt-4">
                                    <a href="<?php echo base_url('customer/resend_otp'); ?>">Resend OTP Code</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    $this->load->view('customer/footer');
?>
