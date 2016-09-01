    <div class="col-md-2"></div>
    <div class="dashboard-content-container col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Peserta Chemistry Innovation Project</h3>
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
                    <?php echo form_open_multipart('daftar/cip/' . $mode);

                    // Kategori Pendidikan
                    $options = array(
                        'highschool' => 'Sekolah Menengah Atas',
                        'university' => 'Perguruan Tinggi'
                    );
                    echo form_label('Kategori Peserta', 'type', array('class' => 'form-label'));
                    echo form_error('participant_type');
                    echo form_dropdown('participant_type', $options, empty($user_category) ? set_value('participant_type') : $user_category);
                    echo '<br/>';
                    echo '<br/>';

                    // Nama Institusi
                    echo form_label('Nama Institusi Pendidikan', 'institution_name', array('class' => 'form-label'));
                    echo form_error('institution_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'institution_name',
                        'value'         => empty($user_institution_name) ? set_value('institution_name') : $user_institution_name
                    )); 
                    echo '<br/>';

                    // Fullname Member 1
                    echo form_label('Nama Lengkap Ketua Tim', 'fullname_member1', array('class' => 'form-label'));
                    echo form_error('fullname_member1');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_member1',
                        'value'         => empty($user_fullname_member1) ? set_value('fullname_member1') : $user_fullname_member1
                    )); 
                    echo '<br/>';

                    // Identitiy No. 1
                    echo form_label('Nomor Identitas Ketua Tim (KTP/Kartu Pelajar)', 'id_number_member1', array('class' => 'form-label'));
                    echo form_error('id_number_member1');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'id_number_member1',
                        'value'         => empty($user_id_number_member1) ? set_value('id_number_member1') : $user_id_number_member1
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal 1
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa) Ketua Tim', 'identity_member1_link', array('class' => 'form-label'));
                    if (!empty($user_identity_member1_link)) echo '<img src="'.base_url().$user_identity_member1_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('identity_member1_link');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_member1_link',
                    )); 
                    echo '<br/>';

                    // Pasfoto 1
                    echo form_label('Upload Pas Foto 3x4 Ketua Tim', 'passphoto_link1', array('class' => 'form-label'));
                    if (!empty($user_passphoto_link1)) echo '<img src="'.base_url().$user_passphoto_link1.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('passphoto_link1');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link1',
                    )); 
                    echo '<br/>';

                    // Fullname Member 2
                    echo form_label('Nama Lengkap Peserta 2', 'fullname_member2', array('class' => 'form-label'));
                    echo form_error('fullname_member2');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_member2',
                        'value'         => empty($user_fullname_member2) ? set_value('fullname_member2') : $user_fullname_member2
                    )); 
                    echo '<br/>';

                    // Identitiy No. 2
                    echo form_label('Nomor Identitas Ketua Tim (KTP/Kartu Pelajar) Peserta 2', 'id_number_member2', array('class' => 'form-label'));
                    echo form_error('id_number_member2');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'id_number_member2',
                        'value'         => empty($user_id_number_member2) ? set_value('id_number_member2') : $user_id_number_member2
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal 2
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa) Peserta 2', 'identity_member2_link', array('class' => 'form-label'));
                    if (!empty($user_identity_member2_link)) echo '<img src="'.base_url().$user_identity_member2_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_member2_link',
                    )); 
                    echo '<br/>';

                    // Pasfoto 2
                    echo form_label('Upload Pas Foto 3x4 Peserta 2', 'passphoto_link2', array('class' => 'form-label'));
                    if (!empty($user_passphoto_link2)) echo '<img src="'.base_url().$user_passphoto_link2.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link2',
                    )); 
                    echo '<br/>';

                    // Fullname Member 3
                    echo form_label('Nama Lengkap Peserta 3', 'fullname_member3', array('class' => 'form-label'));
                    echo form_error('fullname_member3');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_member3',
                        'value'         => empty($user_fullname_member3) ? set_value('fullname_member3') : $user_fullname_member3
                    )); 
                    echo '<br/>';

                    // Identitiy No. 3
                    echo form_label('Nomor Identitas Ketua Tim (KTP/Kartu Pelajar) Peserta 3', 'id_number_member3', array('class' => 'form-label'));
                    echo form_error('id_number_member3');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'id_number_member3',
                        'value'         => empty($user_id_number_member3) ? set_value('id_number_member3') : $user_id_number_member3
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal 3
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa) Peserta 3', 'identity_member3_link', array('class' => 'form-label'));
                    if (!empty($user_identity_member3_link)) echo '<img src="'.base_url().$user_identity_member3_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_member3_link',
                    )); 
                    echo '<br/>';

                    // Pasfoto 3
                    echo form_label('Upload Pas Foto 3x4 Peserta 3', 'passphoto_link3', array('class' => 'form-label'));
                    if (!empty($user_passphoto_link3)) echo '<img src="'.base_url().$user_passphoto_link3.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link3',
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

                    // Lodging Days
                    echo form_label('Berapa hari anda butuh penginapan? (Kosongkan jika tidak perlu)', 'institution_name', array('class' => 'form-label'));
                    echo form_error('lodging_days');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'lodging_days',
                        'value'         => empty($user_lodging_days) ? set_value('lodging_days') : $user_lodging_days
                    )); 
                    echo '<br/>';

                    // Need transport
                    echo form_label('Apakah anda membutuhkan transportasi dari penginapan anda?', 'need_transport', array('class' => 'form-label'));
                    echo form_error('need_transport');
                    if ($user_need_transport == true) echo form_checkbox(array('name' => 'need_transport', 'checked' => 'checked'), array('class' => 'form-control'));
                    else echo form_checkbox('need_transport', 'true', set_checkbox('need_transport', 'true'), array('class' => 'form-control'));
                    echo '<br/>';


                    // Teachers
                    echo form_label('Nama guru pendamping anda (Kosongkan jika tidak ada atau anda adalah Mahasiswa)', 'institution_name', array('class' => 'form-label', 'id' => 'teacher'));
                    echo form_error('teacher_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'teacher_name',
                        'value'         => empty($user_teacher_name) ? set_value('teacher_name') : $user_teacher_name
                    )); 
                    echo '<br/>';

                    // Teachers
                    echo form_label('No. Handphone guru pendamping anda (Kosongkan jika tidak ada guru pendamping atau anda adalah Mahasiswa)', 'institution_name', array('class' => 'form-label', 'id' => 'teacher'));
                    echo form_error('teacher_phone');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'teacher_phone',
                        'value'         => empty($user_teacher_phone) ? set_value('teacher_phone') : $user_teacher_phone
                    )); 
                    echo '<br/>';

                    // Teachers
                    echo form_label('Alamat email guru pendamping anda (Kosongkan jika tidak ada guru pendamping atau anda adalah Mahasiswa)', 'institution_name', array('class' => 'form-label', 'id' => 'teacher'));
                    echo form_error('teacher_email');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'teacher_email',
                        'value'         => empty($user_teacher_email) ? set_value('teacher_email') : $user_teacher_email
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