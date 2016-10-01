    <div class="col-md-2"></div>
    <div class="dashboard-content-container col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Peserta Seminar Nasional</h3>
            </div>
            <div class="panel-body">
                <!-- The form -->
                <div class="login-form">

                    <?php
                        if($this->session->flashdata('upload_failed')): ?>
                        <?php foreach ($this->session->flashdata('upload_failed') as $error_msg) : ?>
                            <div class="alert alert-danger">
                                <?php echo $error_msg; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php
                        if($this->session->flashdata('upload')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('upload'); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                        if($this->session->flashdata('make_failed')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('make_failed'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Show the form for account registration -->
                    <?php echo form_open_multipart('daftar/seminar/' . $mode);

                    // Kategori Pendidikan
                    $options = array(
                        'public' 	=> 'Umum',
                        'student' 	=> 'Pelajar'
                    );
                    echo form_label('Kategori Partisipan', 'type', array('class' => 'form-label'));
                    echo '<br/>';
                    echo form_error('type');
                    echo form_dropdown('type', $options, empty($user_category) ? set_value('type') : $user_category, array('class' => 'form-control'));
                    echo '<br/>';

                    // Fullname
                    echo form_label('Nama Lengkap', 'fullname', array('class' => 'form-label'));
                    echo form_error('fullname');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname',
                        'value'         => empty($user_fullname) ? set_value('fullname') : $user_fullname
                    )); 
                    echo '<br/>';

					// Gender
					$options = array(
                        'male' 	=> 'Laki-laki',
                        'female'=> 'Perempuan'
                    );
                    echo form_label('Jenis Kelamin', 'gender', array('class' => 'form-label'));
                    echo '<br/>';
                    echo form_error('gender');
                    echo form_dropdown('gender', $options, empty($user_category) ? set_value('gender') : $user_category, array('class' => 'form-control'));
                    echo '<br/>';

					// Identity Type
					$options = array(
                        'ktp' 	=> 'KTP',
                        'ktm' 	=> 'Kartu Tanda Mahasiswa',
						'kp'	=> 'Kartu Pelajar'
                    );
                    echo form_label('Jenis Identitas', 'type', array('class' => 'form-label'));
                    echo '<br/>';
                    echo form_error('identity_type');
                    echo form_dropdown('identity_type', $options, empty($user_category) ? set_value('identity_type') : $user_category, array('class' => 'form-control'));
                    echo '<br/>';

                    // Identitiy No
                    echo form_label('Nomor Identitas', 'identity_number', array('class' => 'form-label'));
                    echo form_error('identity_number');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_number',
                        'value'         => empty($user_identity_number) ? set_value('identity_number') : $user_identity_number
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal 1
                    echo form_label('Upload Scan Identitas', 'identity_link', array('class' => 'form-label'));
                    if (!empty($user_identity_link)) echo '<img src="'.base_url().$user_identity_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('identity_link');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_link',
                    )); 
                    echo '<br/>';

                    // Pasfoto
                    echo form_label('Upload Pas Foto', 'passphoto_link', array('class' => 'form-label'));
                    if (!empty($user_passphoto_link)) echo '<img src="'.base_url().$user_passphoto_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('passphoto_link');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link',
                    )); 
                    echo '<br/>';

                    // Birth
                    echo form_label('Tempat/Tanggal Lahir', 'birth', array('class' => 'form-label'));
                    echo form_error('birth');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'birth',
                        'value'         => empty($user_birth) ? set_value('birth') : $user_birth
                    )); 
                    echo '<br/>';

					// Address
                    echo form_label('Alamat', 'address', array('class' => 'form-label'));
                    echo form_error('address');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'address',
                        'value'         => empty($user_address) ? set_value('address') : $user_address
                    )); 
                    echo '<br/>';

					// Facebook
                    echo form_label('Nama Facebook', 'facebook', array('class' => 'form-label'));
                    echo form_error('facebook');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'facebook',
                        'value'         => empty($user_facebook) ? set_value('facebook') : $user_facebook
                    )); 
                    echo '<br/>';

					// Twitter
                    echo form_label('Nama Twitter', 'twitter', array('class' => 'form-label'));
                    echo form_error('twitter');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'twitter',
                        'value'         => empty($user_twitter) ? set_value('twitter') : $user_twitter
                    )); 
                    echo '<br/>';

                    echo '<br/>';

                    echo form_submit(array('class' => 'form-submit',  'submit', 'value' => 'Unggah'));

                    echo '<br/>';
                    echo '<br/>';

                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>