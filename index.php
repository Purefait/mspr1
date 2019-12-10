<?php require_once 'includes/header.php'; ?>
<?php require_once 'config/config.php'; ?>
<?php use Carbon\Carbon; ?>

    <section>
        <div class="container">

            <?php echo Carbon::make(date('Y-m-d 09:25:00'))->diffForHumans(); ?>

            <main class="login-form">
                <div class="cotainer">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Register</div>
                                <div class="card-body">
                                    <form action="" method="">
                                        <div class="form-group row">
                                            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input type="text" id="email_address" class="form-control" name="email-address" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                            <div class="col-md-6">
                                                <input type="password" id="password" class="form-control" name="password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember"> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit"  class="btn btn-primary">
                                                Register
                                            </button>
                                            <a  type="submit" href="register.php" class="btn btn-light">
                                                S'inscrire
                                            </a>
                                            <a href="#" class="btn btn-link">
                                                Forgot Your Password?
                                            </a>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        </div>
    </section>

<?php require_once 'includes/footer.php'; ?>