<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="contentAll" class="error-container">
    <h1 class="error-title"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;</i><?php echo $error_title; ?></h1>
    <p class="error-message"><?php echo $error_message; ?></p>
    <a class="error-button" href="<?php echo $error_button_link; ?>"><?php echo $error_button_label; ?></a>
</div>