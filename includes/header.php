<?php require_once 'vendor/autoload.php'; ?>
<?php require_once 'includes/config.php'; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Facebook</title>
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
<div id="app">
    <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">Responsive</div>
                    </div>
                    <div class="col-sm-6 hidden-xs">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Email Address">
                                    <div class="login-bottom-text checkbox hidden-sm">
                                        <label>
                                            <input type="checkbox" id="">
                                            Keep me sign in
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Password">
                                    <div class="login-bottom-text hidden-sm"> Forgot your password?  </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input type="button" value="login" class="btn btn-default btn-header-login">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <main id="main">