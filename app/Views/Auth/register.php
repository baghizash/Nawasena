<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Daftar Akun</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/backend/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/backend/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/backend/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/style.css" />

    <!-- Custom CSS -->
    <style>
        .form-wrap {
            padding: 30px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-title h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .btn-block {
            padding: 10px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .register-page-wrap {
            background-color: #f8f9fa;
            padding: 60px 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-links {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .auth-links a {
            font-size: 12px;
            margin-right: 10px;
        }

        .btn-register {
            padding: 5px 15px;
        }

        .sign-in-text {
            font-size: 12px;
            margin-left: 10px;
        }

        .invalid-feedback {
            display: block;
            color: red;
            font-size: 12px;
        }
    </style>
</head>

<body class="login-page">

    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="/backend/vendors/images/register-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-title text-center">
                        <h1 class="text-primary mb-4">Registrasi</h1>
                    </div>
                    <div class="register-box mt-">
                        <div class="wizard-content">
                            <form class="tab-wizard2 wizard-circle wizard" action="<?= url_to('register') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="form-wrap max-width-600 mx-auto">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email*</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                            <small id="emailHelp" class="form-text text-muted">Kami tidak akan menyebarkan Email anda!</small>
                                            <?php if (session('errors.email')): ?>
                                                <div class="invalid-feedback">
                                                    <?= esc(session('errors.email')) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Username*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                                            <?php if (session('errors.username')): ?>
                                                <div class="invalid-feedback">
                                                    <?= esc(session('errors.username')) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Password*</label>
                                        <div class="col-sm-8">
                                            <input type="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" placeholder="Kata sandi" autocomplete="off">
                                            <?php if (session('errors.password')): ?>
                                                <div class="invalid-feedback">
                                                    <?= esc(session('errors.password')) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Konfirmasi Password*</label>
                                        <div class="col-sm-8">
                                            <input type="password" name="pass_confirm" class="form-control <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>" placeholder="Ulangi Kata sandi" autocomplete="off">
                                            <?php if (session('errors.pass_confirm')): ?>
                                                <div class="invalid-feedback">
                                                    <?= esc(session('errors.pass_confirm')) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="auth-links">
                                        <a href="<?= url_to('login') ?>" class="sign-in-text">Sudah punya akun? Masuk</a>
                                        <button type="submit" class="btn btn-primary btn-register">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="/backend/vendors/scripts/core.js"></script>
    <script src="/backend/vendors/scripts/script.min.js"></script>
    <script src="/backend/vendors/scripts/process.js"></script>
    <script src="/backend/vendors/scripts/layout-settings.js"></script>
</body>

</html>