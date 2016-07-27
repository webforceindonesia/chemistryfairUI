<div class="login-account-container">

    <!-- The form -->
    <div class="login-form">

        <h1 class="login-title">Login</h1>
        <!-- Show the form for account registration -->
        <?php echo form_open('accounts/login');

        // Alamat Email
        echo form_label('Alamat Email', 'email', array('class' => 'form-label'));
        echo form_error('email');
        echo form_input(array(
            'class'         => 'form-input-generic', 
            'name'          => 'email',
            'placeholder'   => 'Masukkan email anda.'
        )); 
        echo '<br/>';

        // Password
        echo form_label('Password', 'password', array('class' => 'form-label'));
        echo '<a href="' . site_url() . 'akun/change_password' . '">Lupa password?</a>';
        echo form_error('password');
        echo form_password(array(
            'class'         => 'form-input-generic', 
            'name'          => 'password',
            'placeholder'   => 'Masukkan password anda.',
        ));

        echo '<br/>';

        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Login'));

        if ($show_invalid_credentials_error === TRUE)
        {
            echo '<div class="form-error" style="display:inline-block;margin-left:5px">Email atau Password yang anda berikan tidak cocok.</div>';
        }

        echo '<br/>';
        echo '<br/>';

        echo '<a href="' . site_url() . 'akun/register' . '">Register</a> akun baru jika anda belum memiliki akun Chemistry Fair 2016.';

        echo form_close(); ?>
    </div>
</div>