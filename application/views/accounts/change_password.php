<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="login-account-container">

    <!-- The form -->
    <div class="login-form">

        <h1 class="login-title">Password Baru</h1>

        <!-- Show the form for password change -->
        <?php echo form_open('accounts/change_password/' . $secret_code);

        // Password
        echo form_label('Password Baru', 'password', array('class' => 'form-label'));
        echo form_error('password');
        echo form_password(array(
            'class'         => 'form-input-generic', 
            'name'          => 'password',
            'placeholder'   => 'Masukkan password anda.',
        ));

        echo '<br/>';

        // Password Confirmation
        echo form_label('Konfirmasi Password Baru', 'passconf', array('class' => 'form-label'));
        echo form_error('passconf');
        echo form_password(array(
            'class'         => 'form-input-generic', 
            'name'          => 'passconf',
            'placeholder'   => 'Ketik ulang password anda.',
        ));

        echo '<br/>';

        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Ganti Password'));

        echo '<br/>';
        echo '<br/>';

        echo form_close(); ?>
    </div>
</div>