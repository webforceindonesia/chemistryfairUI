<html>
        <head>
            
        	<!-- Favicons -->
        	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url() ?>/images/favicons/apple-icon-57x57.png">
			<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url() ?>/images/favicons/apple-icon-60x60.png">
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() ?>/images/favicons/apple-icon-72x72.png">
			<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>/images/favicons/apple-icon-76x76.png">
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() ?>/images/favicons/apple-icon-114x114.png">
			<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url() ?>/images/favicons/apple-icon-120x120.png">
			<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url() ?>/images/favicons/apple-icon-144x144.png">
			<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() ?>/images/favicons/apple-icon-152x152.png">
			<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>/images/favicons/apple-icon-180x180.png">
			<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url() ?>/images/favicons/android-icon-192x192.png">
			<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>/images/favicons/favicon-32x32.png">
			<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>/images/favicons/favicon-96x96.png">
			<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>/images/favicons/favicon-16x16.png">
			<link rel="manifest" href="/manifest.json">
			<meta name="msapplication-TileColor" content="#ffffff">
			<meta name="msapplication-TileImage" content="<?php echo base_url() ?>/images/favicons/ms-icon-144x144.png">
			<meta name="theme-color" content="#ffffff">


            <!-- Page Title -->
            <title><?php echo $title ?></title>
            
            <!-- Include CSS & JS -->
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-theme.min.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/qunit.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/style.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/media.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/sweetalert.css">
            <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery-2.0.2.js"></script>
            <script type="text/javascript" src="<?php echo base_url() ?>/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url() ?>/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url() ?>/js/qunit.js"></script>
            <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery.stellar.min.js"></script>
            <?php if (isset($import_captcha)) : ?>
                <script src='https://www.google.com/recaptcha/api.js'></script>
            <?php endif; ?>

            <!-- Metas -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            
            <!---------------------------------
            ----    Copyright Weborn 2016    --
            ---- Do Not Attempt to Duplicate --
            ---------------------------------->
            
            <style>
				@media (max-width:995px)
				{
					.logo_univ
					{
						display:none;	
					}
				}
				
			</style>
       
        </head>
        <body>
        <div id="background" data-stellar-background-ratio="0.5">
        <div class="logo-cf-header-container-small mobile-only">
            <img src="<?php echo base_url() ?>images/CF16-02.png">
        </div>
        <div id="top-bar">
            <div id="logo-univ-header-container" class="col-md-2">
                <img id="logo-univ-header" src="<?php echo base_url() ?>/images/logo_univ_box.png">
            </div>
            <div class="col-md-9">
                <ul class="nav">
                    <li class="col-md-2"><a href="<?php echo site_url() ?>">BERANDA</a></li>
                    <li class="col-md-2"><a href="<?php echo site_url() . 'acara/' ?>">ACARA</a></li>
                    <li class="col-md-1"><a href="<?php echo site_url() . 'lomba/' ?>">LOMBA</a></li>
                    <li class="col-md-2"><a href="<?php echo site_url() . 'contactus/' ?>">HUBUNGI KAMI</a></li>
                    <li class="col-md-2"><a href="<?php echo site_url() . 'aboutus/' ?>">TENTANG KAMI</a></li>
                    <li class="col-md-3 header-account-box-container">
                    <?php if (!isset($disable_user_bar) || $disable_user_bar === FALSE) : ?>
                        <div class="header-account-box">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <span class="header-user-icon glyphicon glyphicon-user" aria-hidden="true" style="color: green"></span>
                                &nbsp;
                                <span><?php echo $_SESSION['user_fullname']; ?></span>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <a href="<?php echo site_url() . 'akun/dashboard' ?>" class="btn btn-default">Dashboard</a>
                                    <a href="<?php echo site_url() . 'akun/logout' ?>" class="btn btn-default">Logout</a>
                                </div>
                            <?php else : ?>
                                <span class="header-user-icon glyphicon glyphicon-user" aria-hidden="true" style="color: grey"></span>
                                &nbsp;
                                <span>Selamat datang!</span>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <a href="<?php echo site_url() . 'akun/register' ?>" class="btn btn-default">Register</a>
                                    <a href="<?php echo site_url() . 'akun/login' ?>" class="btn btn-default">Login</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="logo-cf-header-container">
            <?php if (!isset($disable_user_bar) || $disable_user_bar === FALSE) : ?>
                <img src="<?php echo base_url() ?>images/CF16-02.png">
            <?php endif; ?>
        </div>
        <br/>
        <br/>
