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
                    <?php echo form_open_multipart('daftar/cp/' . $mode);

                    // Nama Institusi
                    echo form_label('Nama Institusi Pendidikan', 'institution_name', array('class' => 'form-label'));
                    echo form_error('institution_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'institution_name',
                        'value'         => empty($user_institution_name) ? set_value('institution_name') : $user_institution_name
                    )); 
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

                    // Identitiy 
                    echo form_label('Nomor Identitas (KTP/Kartu Pelajar)', 'id_number', array('class' => 'form-label'));
                    echo form_error('id_number');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'id_number',
                        'value'         => empty($user_id_number) ? set_value('id_number') : $user_id_number
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa) Ketua Tim', 'identity_link', array('class' => 'form-label'));
                    if (!empty($user_identity_link)) echo '<img src="'.base_url().$user_identity_link.'" width= "100">(Sudah terupload, anda bisa menggantinya dengan mengupload ulang)';
                    echo form_error('identity_link');
                    echo form_upload(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_link',
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
                    echo form_dropdown('province_id', $options, empty($user_province_id) ? set_value('province_id') : $user_province_id);
                    echo '<br/>';

                    // Alamat
                    echo form_label('Alamat Lengkap', 'address', array('class' => 'form-label'));
                    echo form_error('address');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'address',
                        'value'         => empty($address) ? set_value('address') : $address
                    )); 
                    echo '<br/>';

                    // No Hp
                    echo form_label('Nomor Handphone', 'phone', array('class' => 'form-label'));
                    echo form_error('phone');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'phone',
                        'value'         => empty($phone) ? set_value('phone') : $phone
                    )); 
                    echo '<br/>';

                    // Email
                    echo form_label('E-mail', 'email', array('class' => 'form-label'));
                    echo form_error('email');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'email',
                        'value'         => empty($email) ? set_value('email') : $email
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