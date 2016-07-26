<html>
        <head>
            
            <!-- Page Title -->
            <title><?php echo $page_title ?></title>
            
            <!-- Include CSS & JS -->
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-theme.min.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/qunit.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/style.css">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/media.css">
            <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery-2.0.2.js"></script>
            <script type="text/javascript" src="<?php echo base_url() ?>/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url() ?>/js/qunit.js"></script>
            
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
        <div class="logo-cf-header-container-small mobile-only">
            <img src="<?php echo base_url() ?>images/bigLogo.svg">
            <div>
                <p>CHEMISTRY FAIR<br/><span>2016</span></p>
            </div>
        </div>
        <div id="top-bar">
            <div id="logo-univ-header-container" class="col-md-2">
                <img id="logo-univ-header" src="<?php echo base_url() ?>/images/logo_univ_box.png">
            </div>
            <div class="col-md-9">
                <ul class="nav">
                    <li class="col-md-2"><a href="<?php echo site_url('admin/') ?>">DASHBOARD</a></li>
                    <li class="col-md-2"><a href="<?php echo site_url('admin/news_new_form') ?>">BUAT BERITA BARU</a></li>
                    <li class="col-md-2"><a href="<?php echo site_url('admin/check') ?>">Check Lomba</a></li>
                    <li class="col-md-3"><a href="<?php echo site_url('admin/pendaftar') ?>">Semniar</a></li>
                </ul>
            </div>
        </div>
        <div class="logo-cf-header-container">
            <img src="<?php echo base_url() ?>images/bigLogo.svg">
            <div>
                <p>CHEMISTRY FAIR<br/><span>2016</span></p>
            </div>
        </div>
        <br/>
        <br/>