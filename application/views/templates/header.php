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
                                    <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                                    <li><a href="<?php echo base_url() ?>">Acara</a></li>
                                    <li><a href="<?php echo base_url() ?>">Lomba</a></li>
                                    <li><a href="<?php echo base_url() ?>">Tentang Kami</a></li>
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
                <div id="footer">
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
        </section>