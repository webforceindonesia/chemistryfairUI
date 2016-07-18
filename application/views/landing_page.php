<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
    
</head>
<body>
	<div class="container">
      <div id="header">
      <div class="row">
    	<div class="col-md-2">
    		<div class="logo_univ">
            	<img src="<?php echo base_url() ?>/images/logo_univ.png">
            </div>
        </div>
       	<div class="col-md-10">
        	<h4 id="comingSoon">Coming Soon</h4>
        </div>
      </div>
      </div>
      <div id="content">
      		<div class="row">
              <div id="container">
            	<div class="col-md-3">&nbsp;</div>
            	<div class="col-md-6">
                        <div id="bigLogo">
                            <p align="center"><img src="<?php echo base_url() ?>/images/bigLogo.svg"></p>
                        </div>
                </div>
            	<div class="col-md-3">&nbsp;</div>
                <div class="col-md-12">
                	<div id="bigTitle">
                            <h1 align="center">CHEMISTRY FAIR</h1>
                            <h2 align="center">04.07.2016</h2>
                    </div>
                </div>  
              </div>
            </div>
      </div>
      <div id="footer">
      	<div class="row">
        	<div class="col-md-7">
            	<div id="tagline">
           			<h4 id="tagline" align="left"><i>Maximizing Chemistry Potential to <br> Maintain The Sustainablility of Energy</i></h4>
                </div>
            </div>
            <div class="col-md-5" id="countdown">
            	<div class="left_number">
           			<h1><?php echo $countdown ?></h1>
                </div>
                <div class="right_number">
                    <h4>HARI LAGI MENUJU</h4>
                    <h3>OPEN REGISTRATION</h3>
                </div>
            </div>
      	</div>
      </div>
    </div>
    
    <!-- Parallax Must be on bottom -->
	<script type="text/javascript" src="<?php echo base_url() ?>/js/jquery.parallax.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>/js/script.js"></script>
    
</body>
</html>