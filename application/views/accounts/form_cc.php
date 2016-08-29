    <div class="col-md-2"></div>
    <div class="dashboard-content-container col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Peserta Chemistry Competition</h3>
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
                    <?php echo form_open_multipart('daftar/cc/' . $mode);

                    // Fullname 
                    echo form_label('Nama Institusi', 'institution_name', array('class' => 'form-label'));
                    echo form_error('institution_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'institution_name',
                        'value'         => empty($institution_name) ? set_value('institution_name') : $institution_name,
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Fullname 
                    echo form_label('Nama Lengkap Ketua', 'fullname_ketua', array('class' => 'form-label'));
                    echo form_error('fullname_ketua');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_ketua',
                        'value'         => empty($user1_fullname) ? set_value('fullname_ketua') : $user1_fullname,
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Fullname 
                    echo form_label('Nama Lengkap Anggota', 'fullname_anggota', array('class' => 'form-label'));
                    echo form_error('fullname');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_anggota',
                        'value'         => empty($user2_fullname) ? set_value('fullname') : $user2_fullname,
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // // Identitiy Ketua
                    // echo form_label('Nomor Identitas Ketua (KTP/Kartu Pelajar)', 'id_number_ketua', array('class' => 'form-label'));
                    // echo form_error('id_number');
                    // echo form_input(array(
                    //     'class'         => 'form-input-generic', 
                    //     'name'          => 'id_number_ketua',
                    //     'value'         => empty($user1_id_number) ? set_value('id_number_ketua') : $user1_id_number,
                    //     'required'      => ''
                    // )); 
                    // echo '<br/>';

                    //  // Identitiy Anggota
                    // echo form_label('Nomor Identitas Anggota (KTP/Kartu Pelajar)', 'id_number_anggota', array('class' => 'form-label'));
                    // echo form_error('id_number_anggota');
                    // echo form_input(array(
                    //     'class'         => 'form-input-generic', 
                    //     'name'          => 'id_number_anggota',
                    //     'value'         => empty($user2_id_number) ? set_value('id_number_anggota') : $user2_id_number,
                    //     'required'      => ''
                    // )); 
                    // echo '<br/>';

                    // Upload Tanda Pengenal
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa) Ketua Tim', 'identity_link_ketua', array('class' => 'form-label'));
                    if (!empty($user1_identity_link)) echo '<img src="'.base_url().$user1_identity_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('identity_link_ketua');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_link_ketua',
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa) Anggota Tim', 'identity_link_anggota', array('class' => 'form-label'));
                    if (!empty($user2_identity_link)) echo '<img src="'.base_url().$user2_identity_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('identity_link_anggota');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_link_anggota',
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Asal provinsi
                    $options = array(
                        '1' => titlecase('aceh'),
                        '2' => titlecase('bali'),
                        '3' => titlecase('banten'),
                        '4' => titlecase('bengkulu'),
                        '5' => titlecase('gorontalo'),
                        '6' => titlecase('jakarta'),
                        '7' => titlecase('jambi'),
                        '8' => titlecase('jawa_barat'),
                        '9' => titlecase('jawa_tengah'),
                        '10' => titlecase('jawa_timur'),
                        '11' => titlecase('kalimantan_barat'),
                        '12' => titlecase('kalimantan_selatan'),
                        '13' => titlecase('kalimantan_tengah'),
                        '14' => titlecase('kalimantan_timur'),
                        '15' => titlecase('kalimantan_utara'),
                        '16' => titlecase('kepulauan_bangka_belitung'),
                        '17' => titlecase('kepulauan_riau'),
                        '18' => titlecase('lampung'),
                        '19' => titlecase('maluku'),
                        '20' => titlecase('maluku_utara'),
                        '21' => titlecase('nusa_tenggara_barat'),
                        '22' => titlecase('nusa_tenggara_timur'),
                        '23' => titlecase('papua'),
                        '24' => titlecase('papua_barat'),
                        '25' => titlecase('riau'),
                        '26' => titlecase('sulawesi_barat'),
                        '27' => titlecase('sulawesi_selatan'),
                        '28' => titlecase('sulawesi_tengah'),
                        '29' => titlecase('sulawesi_timur'),
                        '30' => titlecase('sulawesi_utara'),
                        '31' => titlecase('sumatera_barat'),
                        '32' => titlecase('sumatera_selatan'),
                        '33' => titlecase('sumatera_utara'),
                        '34' => titlecase('yogyakarta')
                    );
                    echo form_label('Asal Provinsi', 'province_id', array('class' => 'form-label'));
                    echo form_error('province_id');
                    echo form_dropdown('province_id', $options, empty($user_province_id) ? set_value('province_id') : $user_province_id, array('class' => 'form-control'));
                    echo '<br/>';

                    // Alamat
                    echo form_label('Alamat Lengkap Ketua', 'address', array('class' => 'form-label'));
                    echo form_error('address');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'address',
                        'value'         => empty($address) ? set_value('address') : $address,
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // No Hp
                    echo form_label('Nomor Handphone Ketua', 'phone', array('class' => 'form-label'));
                    echo form_error('phone');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'phone',
                        'value'         => empty($phone) ? set_value('phone') : $phone,
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Email
                    echo form_label('E-mail Ketua', 'email', array('class' => 'form-label'));
                    echo form_error('email');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'email',
                        'value'         => empty($email) ? set_value('email') : $email,
                        'required'      => ''
                    )); 

                    echo '<br>';

                    // Pasfoto 1
                    echo form_label('Upload Pas Foto 3x4 Ketua Tim', 'passphoto_link1', array('class' => 'form-label'));
                    if (!empty($user1_passphoto_link)) echo '<img src="'.base_url().$user1_passphoto_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('passphoto_link1');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link1',
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Pasfoto 2
                    echo form_label('Upload Pas Foto 3x4 Anggota Tim', 'passphoto_link2', array('class' => 'form-label'));
                    if (!empty($user2_passphoto_link)) echo '<img src="'.base_url().$user2_passphoto_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('passphoto_link2');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link2',
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Teachers
                    echo form_label('Nama guru pendamping anda', 'teacher_name', array('class' => 'form-label', 'id' => 'teacher'));
                    echo form_error('teacher_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'teacher_name',
                        'value'         => empty($teacher_name) ? set_value('teacher_name') : $teacher_name,
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Teachers
                    echo form_label('No. Handphone guru pendamping anda', 'teacher_phone', array('class' => 'form-label', 'id' => 'teacher'));
                    echo form_error('teacher_phone');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'teacher_phone',
                        'value'         => empty($teacher_phone) ? set_value('teacher_phone') : $teacher_phone,
                        'required'      => ''
                    )); 
                    echo '<br/>';

                    // Teachers
                    echo form_label('Alamat email guru pendamping anda', 'teacher_email', array('class' => 'form-label', 'id' => 'teacher'));
                    echo form_error('teacher_email');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'teacher_email',
                        'value'         => empty($teacher_email) ? set_value('teacher_email') : $teacher_email,
                        'required'      => ''
                    )); 

                    echo '<br/>';
                    
                    echo '<br/>';

                    echo '<br/>';

                    echo form_submit(array('class' => 'form-submit',  'submit', 'value' => 'Update'));

                    echo '<br/>';
                    echo '<br/>';

                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>