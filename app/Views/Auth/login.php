<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>Masuk ke Nawasena</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>/backend/vendors/images/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>/backend/vendors/images/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/backend/vendors/images/favicon-16x16.png" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/backend/vendors/styles/core.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/backend/vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/backend/vendors/styles/style.css" />

</head>

<body class="login-page">

	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="<?= base_url(); ?>/backend/vendors/images/login-page-img.png" alt="" />
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Masuk ke Nawasena</h2>
						</div>
						<form action="<?= route_to('login') ?>" method="POST" class="user">
							<?= csrf_field() ?>
							<?= view('Myth\Auth\Views\_message_block') ?>

							<?php if (isset($config) && $config->validFields === ['email']) : ?>
								<!-- Jika hanya menggunakan email untuk login -->
								<div class="input-group custom mb-3">

									<input type="email" class="form-control 
                                    <?php if (session('errors.login')): ?> is-invalid
                                        
                                    <?php endif ?> 
                                    " name="login" placeholder="<?= lang('Auth.email') ?>" value="<?= old('login') ?>">

									<?php if (session('errors.login')) : ?>
										<div class="invalid-feedback">
											<?= session('errors.login') ?>
										</div>
									<?php endif; ?>


								</div>
							<?php else : ?>
								<!-- Jika menggunakan email atau username untuk login -->
								<div class="input-group custom mb-3">
									<input type="text" class="form-control 
                                    <?php if (session('errors.login')) : ?> is-invalid
                                    <?php endif ?>"
										name="login" placeholder="Email atau Username" value="<?= old('login') ?>">
									<div class="invalid-feedback">
										<?= session('errors.login') ?>
									</div>
								</div>
							<?php endif; ?>

							<div class="input-group custom mb-3">
								<input type="password" name="password" class="form-control 
                                <?php if (session('errors.password')) : ?>is-invalid
                                <?php endif ?>"
									placeholder="Kata Sandi">


								<?php if (session('errors.password')) : ?>
									<div class="invalid-feedback">
										<?= session('errors.password') ?>
									</div>
								<?php endif; ?>
							</div>

							<?php if (isset($config) && $config->allowRemembering) : ?>
								<div class="row pb-30">
									<div class="col-6 d-flex align-items-center" style="font-size: 14px;">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" name="remember" class="custom-control-input" id="rememberMe" style="width: 1em; height: 1em;" <?php if (old('remember')) : ?> checked <?php endif ?>>
											<label class="custom-control-label" for="rememberMe" style="font-size:13px;">Ingat Saya!</label>
										</div>
									</div>

									<div class="col-6 text-right">
										<div class="forgot-password">
											<a href="<?= url_to('forgot') ?>" style="font-size: 0.8rem;">Lupa Password?</a>
										</div>
									</div>
								</div>
							<?php endif; ?>

							<div class="input-group mb-3">
								<button class="btn btn-primary btn-lg btn-block" type="submit">Masuk
								</button>
							</div>

							<!-- OR Divider -->
							<div class="font-16 weight-600 text-center" style="position: relative; margin-top: -5px; margin-bottom: 10px;">
								<span style="background: white; padding: 0 10px;"><?= lang('atau') ?></span>
							</div>

							<div class="input-group">
								<a class="btn btn-outline-primary btn-lg btn-block" href="<?= url_to('register') ?>" style="margin-top: 1px;">Daftarkan Akun!</a>
							</div>


						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- js -->
	<script src="<?= base_url(); ?>/backend/vendors/scripts/core.js"></script>
	<script src="<?= base_url(); ?>/backend/vendors/scripts/script.min.js"></script>
	<script src="<?= base_url(); ?>/backend/vendors/scripts/process.js"></script>
	<script src="<?= base_url(); ?>/backend/vendors/scripts/layout-settings.js"></script>

</body>

</html>