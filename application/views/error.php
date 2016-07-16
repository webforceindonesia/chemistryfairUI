<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='error_box'>
    <span class='error_text'><?php echo $error_reason; ?></span>
</div>

<a href='<?php echo site_url() . $error_redirect; ?>'>
    <div class='continue_box'>
        <span class='continue_text'>Lanjutkan</span>
    </div>
</a>