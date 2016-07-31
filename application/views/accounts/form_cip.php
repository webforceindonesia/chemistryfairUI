    <div class="dashboard-content-container col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data Peserta Chemistry Innovation Project</h3>
            </div>
            <div class="panel-body">
                <!-- The form -->
                <div class="login-form">

                    <!-- Show the form for account registration -->
                    <?php echo form_open('accounts/dashboard/cip_details');

                    // Kategori Pendidikan
                    echo form_label('Kategori Pendidikan', 'type', array('class' => 'form-label'));
                    echo form_error('type');
                    echo form_radio(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'type',
                        'value'         => $participant_type
                    )); 
                    echo '<br/>';

                    // Nama Institusi
                    echo form_label('Nama Institusi Pendidikan', 'institution_name', array('class' => 'form-label'));
                    echo form_error('institution_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'institution_name',
                        'value'         => $user_institution_name
                    )); 
                    echo '<br/>';

                    // Fullname Member 1
                    echo form_label('Nama Lengkap Ketua Tim', 'fullname_member1', array('class' => 'form-label'));
                    echo form_error('fullname_member1');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_member1',
                        'value'         => $user_fullname_member1
                    )); 
                    echo '<br/>';

                    // Identitiy No. 1
                    echo form_label('Nomor Identitas Ketua Tim (KTP/Kartu Pelajar)', 'id_number_member1', array('class' => 'form-label'));
                    echo form_error('id_number_member1');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'id_number_member1',
                        'value'         => $user_id_number_member1
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal 1
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa)', 'identity_member1_link', array('class' => 'form-label'));
                    echo form_error('identity_member1_link');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_member1_link',
                        'value'         => $user_identity_member1_link
                    )); 
                    echo '<br/>';

                    // Pasfoto 1
                    echo form_label('Upload Pas Foto 3x4', 'passphoto_link1', array('class' => 'form-label'));
                    echo form_error('passphoto_link1');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link1',
                        'value'         => $user_passphoto_link1
                    )); 
                    echo '<br/>';

                    // Fullname Member 2
                    echo form_label('Nama Lengkap Ketua Tim', 'fullname_member2', array('class' => 'form-label'));
                    echo form_error('fullname_member2');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_member2',
                        'value'         => $user_fullname_member2
                    )); 
                    echo '<br/>';

                    // Identitiy No. 2
                    echo form_label('Nomor Identitas Ketua Tim (KTP/Kartu Pelajar)', 'id_number_member2', array('class' => 'form-label'));
                    echo form_error('id_number_member2');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'id_number_member2',
                        'value'         => $user_id_number_member2
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal 2
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa)', 'identity_member2_link', array('class' => 'form-label'));
                    echo form_error('identity_member2_link');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_member2_link',
                        'value'         => $user_identity_member2_link
                    )); 
                    echo '<br/>';

                    // Pasfoto 2
                    echo form_label('Upload Pas Foto 3x4', 'passphoto_link2', array('class' => 'form-label'));
                    echo form_error('passphoto_link2');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link2',
                        'value'         => $user_passphoto_link2
                    )); 
                    echo '<br/>';

                    // Fullname Member 3
                    echo form_label('Nama Lengkap Ketua Tim', 'fullname_member3', array('class' => 'form-label'));
                    echo form_error('fullname_member3');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'fullname_member3',
                        'value'         => $user_fullname_member3
                    )); 
                    echo '<br/>';

                    // Identitiy No. 3
                    echo form_label('Nomor Identitas Ketua Tim (KTP/Kartu Pelajar)', 'id_number_member3', array('class' => 'form-label'));
                    echo form_error('id_number_member3');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'id_number_member3',
                        'value'         => $user_id_number_member3
                    )); 
                    echo '<br/>';

                    // Upload Tanda Pengenal 3
                    echo form_label('Upload Bukti Siswa/Mahasiswa (Dapat berupa scan Kartu Tanda Mahasiswa)', 'identity_member3_link', array('class' => 'form-label'));
                    echo form_error('identity_member3_link');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'identity_member3_link',
                        'value'         => $user_identity_member3_link
                    )); 
                    echo '<br/>';

                    // Pasfoto 3
                    echo form_label('Upload Pas Foto 3x4', 'passphoto_link3', array('class' => 'form-label'));
                    echo form_error('passphoto_link3');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'passphoto_link3',
                        'value'         => $user_passphoto_link3
                    )); 
                    echo '<br/>';

                    // Nama institusi
                    echo form_label('Nama Sekolah atau Perguruan Tinggi', 'institution_name', array('class' => 'form-label'));
                    echo form_error('institution_name');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'institution_name',
                        'value'         => $user_institution_name
                    )); 
                    echo '<br/>';

                    // Asal provinsi
                    $options = array(
                        '1' => 'Small Shirt',
                        '2' => 'Small Shirt',
                    );
                    echo form_label('Asal Provinsi', 'province_id', array('class' => 'form-label'));
                    echo form_error('province_id');
                    echo form_input(array(
                        'class'         => 'form-input-generic', 
                        'name'          => 'province_id',
                        'value'         => $user_province_id
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