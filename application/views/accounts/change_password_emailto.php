<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="login-account-container">

    <!-- The form -->
    <div class="login-form">

        <h1 class="login-title">Permintaan Ganti Password</h1>
        <h5>Masukkan email atau email cadangan anda yang anda gunakan saat registrasi akun Chemistry Fair 2016</h5>
        <h5>Jika ditemukan dalam database kami, kami akan mengirimkan email yang berisi link untuk merubah password anda.</h5>

        <!-- Show the form for password change -->
        <?php echo form_open('accounts/change_password');

        // Alamat Email
        echo form_label('Alamat Email', 'email', array('class' => 'form-label'));
        echo form_error('email');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'email',
            'placeholder'   => 'Masukkan email anda.'
        )); 
        echo '<br/>';

        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Kirim Email'));

        echo '<br/>';
        echo '<br/>';

        echo form_close(); ?>
    </div>
</div>