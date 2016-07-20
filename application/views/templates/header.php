<html>
        <head>
            
            <!-- Page Title -->
            <title><?php echo $title ?></title>
            
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
        <section id="headerAll">
            <div class="container">
                <section id="navBar">
                    <nav class="navbar navbar-default">
                        <div class="container">
                            <div class="col-md-2">
                                &nbsp;
                            </div>
                            <div class="col-md-10">
                                <ul class="nav navbar-nav">
                                    <li><a href="<?php echo base_url('Main') ?>">Beranda</a></li>
                                    <li><a href="<?php echo base_url('Acara') ?>/acara">Acara</a></li>
                                    <li><a href="<?php echo base_url('Lomba') ?>">Lomba</a></li>
                                    <li><a href="<?php echo base_url('Main') ?>/aboutus">Tentang Kami</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </section>
                <div class="row">
                    <div class="col-md-2">
                        <div class="logo_univ">
                            <img src="<?php echo base_url() ?>/images/logo_univ.png">
                        </div>
                    </div>
                </div>
                <br><br>
                <div id="footer" class="countdown">
                <div class="row">
                    <div class="col-md-6">
                        <div id="tagline">
                            <h4 id="tagline" align="left"><i>Maximizing Chemistry Potential to <br> Maintain The Sustainablility of Energy</i></h4>
                        </div>
                    </div>
                    <div class="col-md-6" id="countdown">
                        <div class="left_number">
                            <h1><?php echo $countdown ?></h1>
                        </div>
                        <div class="right_number">
                            <h4>HARI LAGI MENUJU</h4>
                            <h3>OPEN REGISTERATION</h3>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div id="top-bar">
            <div id="logo-univ-header-container" class="col-md-2">
                <img id="logo-univ-header" src="<?php echo base_url() ?>/images/logo_univ_box.png">
            </div>
            <div class="col-md-9">
                <ul class="nav">
                    <li class="col-md-2"><a href="<?php echo base_url() ?>">BERANDA</a></li>
                    <li class="col-md-2"><a href="<?php echo base_url() ?>">ACARA</a></li>
                    <li class="col-md-2"><a href="<?php echo base_url() ?>">LOMBA</a></li>
                    <li class="col-md-3"><a href="<?php echo base_url() ?>">TENTANG KAMI</a></li>
                </ul>
            </div>
        </div>
        <div class="logo-cf-header-container">
            <img src="<?php echo base_url() ?>images/biglogo.svg">
            <div>
                <p>CHEMISTRY FAIR<br/><span>2016</span></p>
            </div>
        </div>
        <br/>
        <br/>