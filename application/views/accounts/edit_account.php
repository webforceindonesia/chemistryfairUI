    <div class="dashboard-content-container col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Detail Akun</h3>
            </div>
            <div class="panel-body">
                <!-- The form -->
                <div class="login-form">

                    <!-- Show the form for account registration -->
                    <?php echo form_open('accounts/dashboard/edit_account');

                    // Nama Lengkap
                    echo form_label('Nama Lengkap', 'fullname', array('class' => 'form-label'));
                    echo form_error('fullname');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname',
                        'value'         => $user_fullname
                    )); 
                    echo '<br/>';

                    // Nomor Telpon
                    echo form_label('Nomor Telepon', 'phone_number', array('class' => 'form-label'));
                    echo form_error('phone_number');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'phone_number',
                        'value'         => $user_phone_number
                    )); 
                    echo '<br/>';

                    // Email Cadangan
                    echo form_label('Email Cadangan', 'email_recovery', array('class' => 'form-label'));
                    echo form_error('email_recovery');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'email_recovery',
                        'value'         => $user_email_recovery
                    )); 
                    echo '<br/>';

                    echo '<br/>';

                    echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Ubah'));

                    echo '<br/>';
                    echo '<br/>';

                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>