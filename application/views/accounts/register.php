<div class="registration-account-container">

    <!-- Decorative form title -->
    <div class="registration-account-header col-md-6">
        <!-- Form type title -->
        <h2>FORMULIR REGISTRASI</h2>

        <!-- Chemistry Fair title -->
        <div class="registration-account-logo">
            <img src="<?php echo base_url() ?>images/bigLogo.svg">
            <p>CHEMISTRY FAIR<br/><span>2016</span></p>
        </div>
    </div>

    <!-- The form -->
    <div class="registration-account-form col-md-6">
        <!-- Show the form for account registration -->
        <?php echo form_open('accounts/register');

        // Alamat Email
        echo form_label('Alamat Email', 'email', array('class' => 'form-label'));
        echo form_error('email');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'email',
            'placeholder'   => 'Masukkan email anda.',
            'value'         => set_value('email')
        )); 

        echo '<br/>';

        // Konfirmasi Alamat Email
        echo form_label('Konfirmasi Alamat Email', 'emailconf', array('class' => 'form-label'));
        echo form_error('emailconf');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'emailconf',
            'placeholder'   => 'Ketik ulang alamat email anda.',
        )); 

        echo '<br/>';

        // Password
        echo form_label('Password', 'password', array('class' => 'form-label'));
        echo form_error('password');
        echo form_password(array(
            'class'         => 'form-input-generic', 
            'name'          => 'password',
            'placeholder'   => 'Masukkan password anda.',
        ));

        echo '<br/>';

        // Password Confirmation
        echo form_label('Konfirmasi Password', 'passconf', array('class' => 'form-label'));
        echo form_error('passconf');
        echo form_password(array(
            'class'         => 'form-input-generic', 
            'name'          => 'passconf',
            'placeholder'   => 'Ketik ulang password anda.',
        ));

        echo '<br/>';

        // Fullname
        echo form_label('Nama Lengkap', 'fullname', array('class' => 'form-label'));
        echo form_error('fullname');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'fullname',
            'placeholder'   => 'Masukkan nama lengkap anda.',
            'value'         => set_value('fullname')
        ));

        echo '<br/>';

        // Phone number
        echo form_label('Nomor telepon', 'phone_number', array('class' => 'form-label'));
        echo form_error('phone_number');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'phone_number',
            'placeholder'   => 'Masukkan nomor telepon anda.',
            'value'         => set_value('phone_number')
        ));

        echo '<br/>';

        // Recovery Email
        echo form_label('Email Cadangan', 'email_recovery', array('class' => 'form-label'));
        echo form_error('email_recovery');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'email_recovery',
            'placeholder'   => 'Masukkan email cadangan anda.',
            'value'         => set_value('email_recovery')
        ));

        echo '<br/>';

        // Security Question
        echo form_label('Pertanyaan Keamanan', 'security_question', array('class' => 'form-label'));
        echo form_error('security_question');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'security_question',
            'placeholder'   => 'Masukkan pertanyaan keamanan anda.',
            'value'         => set_value('security_question')
        ));

        echo '<br/>';

        // Security Answer
        echo form_label('Jawaban Keamanan', 'security_answer', array('class' => 'form-label'));
        echo form_error('security_answer');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'security_answer',
            'placeholder'   => 'Masukkan jawaban keamanan anda.',
            'value'         => set_value('security_answer')
        ));

        echo '<br/>';

        // Captcha
        echo form_label('Verifikasi bahwa anda adalah manusia.', '', array('class' => 'form-label'));
        if ($show_captcha_error) echo '<div class="form-error">Verifikasi Captcha anda gagal, mohon dicoba lagi.</div>';
        echo '<div class="g-recaptcha" data-sitekey="6Lcr_SUTAAAAAJ-HOnPhgHwkC3Rb4BsvnqZw8KSX"></div>';

        echo '<br/>';

        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Register'));

        echo '&nbsp;&nbsp;&nbsp;Atau <a href="' . site_url() . 'akun/login' . '">login</a> jika anda sudah memiliki akun Chemistry Fair 2016.';

        echo form_close(); ?>
    </div>
</div>