<html>
    <head>

        <!-- Page Title -->
        <title><?php echo $page_title ?></title>
        
        <!-- Include CSS & JS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/qunit.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/comingsoon.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/media.css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        
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
                <img id="logo-univ-header" src="<?php echo base_url() ?>/images/logoui.png">
                <img id="logo-hmd" src="<?php echo base_url() ?>images/HMD-Kimia.png">
            </div>
            <div class="col-md-8">
                <span id="comingsoon">COMING SOON</span>
            </div>
        </div>

        <div class="logo-cf-header-container">
            <img src="<?php echo base_url() ?>images/bigLogo.svg">
            <div>
                <p>CHEMISTRY FAIR<br/><span>2016</span></p>
            </div>
        </div>

        <div class="fixed-bot">
            <div class="col-md-4">
                <p class="quote"><i>Maximizing Chemistry Potential to Maintain The Sustainablility of Energy</i></p>
            </div>

            <div class="col-md-2">
            
            </div>

            <div class="col-md-6 countdown-area">
                <div class="countdown-number">
                    <span><?php echo $countdown ?></span>
                </div>
                <div>
                    <p>HARI LAGI MENUJU<br/>OPEN REGISTRATION</p>
                </div>
            </div>
        </div>
