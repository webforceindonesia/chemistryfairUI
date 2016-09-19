<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- The dashboard profile container -->
    <div class="dashboard-content-container col-md-9">
        <?php if ($user_is_participant == true) : ?>
            <h1>Dashboard Peserta Chemistry Innovation Project</h1>
                <?php if($this->session->flashdata('upload_failed')): ?>
                    <div class="alert alert-danger">
                        <?php print_r($this->session->flashdata('upload_failed')); ?>
                    </div>
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
            <?php 

                $flag = 0;
                
                if($user_submitted_abstract != NULL)
                {
                    $flag = 1;
                }

                if($user_passed_abstract == 1)
                {
                    $flag = 1;
                }
            
            ?>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Status Peserta</h3>
                </div>
                <div class="panel-body">
                    <h5>Tim peserta atas nama email <strong><?php echo $user_email ?></strong></h5>

                    <?php echo form_open_multipart('akun/dashboard/cip/upload'); ?>

                    <?php if ($user_details_complete == FALSE) : ?>
                        <p>Status : <span style="color:red">Data gambar anda belum lengkap!</span></p>
                        <p>Mohon melengkapi dan mengupload semua gambar-gambar yang dibutuhkan di bawah ini.</p>
                    <?php elseif ($flag == 0): ?>
                        <p>Status : <span style="color:red">Menunggu Upload Abstrak</span></p>
                        <p>Mohon mengupload karya abstrak anda di tempat di bawah ini. Anda hanya bisa mengupload abstrak satu kali saja, jadi mohon
                           upload hanya revisi terakhir dari abstrak anda. Mohon file yang di cantumkan berbentuk zip.</p>
                        <p><?php

                        // Upload Berkas
                        echo form_label('File Berkas', 'berkas', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('berkas');
                        echo form_upload(array(
                            'class'         => 'button button-success', 
                            'name'          => 'file_berkas',
                            'placeholder'   => 'Upload File.',
                        )); 

                        echo '<br>';

                        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Upload'));

                        ?></form></p>
                    <?php elseif ($user_passed_abstract == 0) : ?>
                        <p>Status : <span style="color:blue">Menunggu Hasil Lolos Abstrak</span></p>
                        <p>Tim kami akan memeriksa dan menilai abstrak anda, mohon menunggu hingga hasil penilaian
                         abstrak anda keluar. Terima kasih.</p>
                    <?php elseif ($user_passed_abstract == 2) : ?>
                        <p>Status : <span style="color:blue">Abstrak Anda Gagal</span></p>
                        <p>
                            Mohon maaf, abstrak Tim Anda tidak lolos seleksi abstrak.
                            Tetap semangat berkarya demi kemajuan bangsa.
                            Kegagalan merupakan kemenangan yang tertunda.
                            Kami tunggu karya Tim Anda di Chemistry Innovation Project tahun depan
                        </p>
                    <?php elseif ($user_submitted_payment_proof == NULL) : ?>
                        <p>Status : <span style="color:red">Menunggu Upload Bukti Pembayaran</span></p>
                        <p>Selamat! Anda telah lolos tahap seleksi abstrak. Untuk melanjutkan ke tahap berikutnya, mohon untuk melakukan pembayaran biaya registrasi sebesar Rp 120.000 untuk peserta CIP tingkat Siswa dan Rp 130.000 untuk peserta CIP tingkat Mahasiswa ke Nomor Rekening BRI 0951-01-043292-532 a/n Fiona Angellinnov</p>
                        <p>Setelah membayar, mohon screenshot atau foto bukti pembayaran anda dan menguploadnya di tempat di bawah ini:</p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cip/upload'); ?>
                        <?php

                        // Upload Bukti Trf
                        echo form_label('File Bukti Transfer', 'bukti', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('bukti');
                        echo form_upload(array(
                            'class'         => 'button button-success', 
                            'name'          => 'file_bukti',
                            'placeholder'   => 'Upload File.',
                        )); 

                        echo '<br>';

                        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Upload'));

                        ?></form></p>
                    <?php elseif ($user_payment_verified == 2) : ?>
                        <p>Status : <span style="color:red">Hasil Konfirmasi Pembayaran Ditolak</span></p>
                        <p>Tim kami sudah memeriksa bukti pembayaran yang sudah Anda upload. Foto bukti pembayaran tidak memenuhi standar (tidak jelas, blur, invalid), anda bisa mengupload bukti pendaftaran yang baru. Terima kasih.</p>
                        <p>Anda bisa mengupdate bukti pembayaran Anda jika perlu : </p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cip/upload'); ?>
                        <?php

                        // Upload Bukti Trf
                        echo form_label('File Bukti Transfer', 'bukti', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('bukti');
                        echo form_upload(array(
                            'class'         => 'button button-success', 
                            'name'          => 'file_bukti',
                            'placeholder'   => 'Upload File.',
                        )); 

                        echo '<br>';

                        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Upload'));

                        ?></form></p>
                    <?php elseif ($user_payment_verified == 0) : ?>
                        <p>Status : <span style="color:blue">Menunggu Hasil Konfirmasi Pembayaran</span></p>
                        <p>Tim kami akan memeriksa bukti pembayaran yang sudah Anda upload. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Anda bisa mengupdate bukti pembayaran Anda jika perlu : </p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cip/upload'); ?>
                        <?php

                        // Upload Bukti Trf
                        echo form_label('File Bukti Transfer', 'bukti', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('bukti');
                        echo form_upload(array(
                            'class'         => 'button button-success', 
                            'name'          => 'file_bukti',
                            'placeholder'   => 'Upload File.',
                        )); 

                        echo '<br>';

                        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Upload'));

                        ?></form></p>
                    <?php elseif ($user_submitted_makalah == NULL) : ?>  
                        </form>
                        <p>Status : <span style="color:red">Menunggu Upload Makalah</span></p>
                        <p>Mohon mengupload karya makalah anda di tempat di bawah ini. Anda hanya bisa mengupload makalah satu kali saja, jadi mohon
                           upload hanya revisi terakhir dari makalah anda. Mohon file yang di cantumkan berbentuk zip.</p>
                        <p>
                        <?php echo form_open_multipart('akun/dashboard/cip/makalah'); ?>
                        <?php

                        // Upload Berkas
                        echo form_label('File Berkas', 'berkas', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('berkas');
                        echo form_upload(array(
                            'class'         => 'button button-success', 
                            'name'          => 'file_berkas',
                            'placeholder'   => 'Upload File.',
                        )); 

                        echo '<br>';

                        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Upload'));

                        ?></form></p>
                    <?php elseif ($user_passed_makalah == 0) : ?>
                        <p>Status : <span style="color:blue">Menunggu Hasil Lolos Makalah</span></p>
                        <p>Tim kami akan memeriksa dan menilai makalah anda, mohon menunggu hingga hasil penilaian
                         makalah anda keluar. Terima kasih.</p>
                    <?php elseif ($user_passed_makalah == 2) : ?>
                        <p>Status : <span style="color:blue">Makalah Anda Gagal</span></p>
                        <p>
                            Mohon maaf, makalah Tim Anda tidak lolos seleksi makalah.
                            Tetap semangat berkarya demi kemajuan bangsa.
                            Kegagalan merupakan kemenangan yang tertunda.
                            Kami tunggu karya Tim Anda di Chemistry Innovation Project tahun depan
                        </p>
                    <?php elseif ($user_payment_verified == 5) : ?>
                        <p>Status : <span style="color:red">Anda Telah Gugur Dalam Seleksi</span></p>
                        <p>
                            Mohon maaf, karya Tim Anda belum menjadi juara Chemistry Competition.
                            Tetap semangat berkarya dan berkompetisi demi kemajuan bangsa.
                            Kegagalan merupakan kemenangan yang tertunda.
                            Kami tunggu kehadiran Tim Anda di Chemistry Competition tahun depan
                        </p>
                    <?php elseif ($user_payment_verified == 4) : ?>
                        <p>Status : <span style="color:green">Anda Telah Menang!</span></p>
                        <p>
                            Untuk konfirmasi kemenangan dan untuk kontak selanjutnya harap hubungi <br><br>Manda (086770529281)<br>Putri (085697366602)<br><br>
                            Kami tunggu kehadiran Tim Anda di Chemistry Competition tahun depan!
                        </p>
                    <?php elseif ($user_passed_abstract == 3) : ?>
                        <p>Status : <span style="color:blue">Menunggu Pengumuman Hasil Seleksi</span></p>
                        <p>Tim kami akan mengumumkan hasil seleksi. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Jika anda memiliki pertanyaan, silahkan menhubungi :</p>
                    <?php else : ?>
                        <p>Status : <span style="color:green">Anda Lolos Seleksi Makalah</span></p>
                        <p>Tolong isi form di bawah ini mengenai penginapan saat lomba nanti, selanjutnya anda akan dihubungkan dengan panitia</p>
                        <br>
                        <p>
                        </form>
                        <?php echo form_open_multipart('akun/dashboard/cip/email_penginapan'); ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama ketua kelompok</td>
                                    <td><input type="text" class="form-control" name="nama-ketua" required></td>
                                </tr>
                                <tr>
                                    <td>Bersediakah Anda untuk datang ke Kampus UI, Depok? (Ya/Tidak)</td>
                                    <td>
                                        <span><input type="radio" name="datang" value="Ya" class="form-control">Ya</span>
                                        <span><input type="radio" name="datang" value="Tidak" class="form-control">Tidak</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Butuh penginapan selama rangkaian acara Chemistry Innovation Project? (Ya/Tidak)</td>
                                    <td>
                                        <span><input type="radio" name="penginapan" value="Ya" class="form-control">Ya</span>
                                        <span><input type="radio" name="penginapan" value="Tidak" class="form-control">Tidak</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jika Ya, berapakah anggota kelompok yang butuh penginapan?</td>
                                    <td><input type="number" class="form-control" name="anggota-penginapan"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin ketua</td>
                                    <td>
                                        <select name="gender_ketua" class="form-control">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin Member 2</td>
                                    <td>
                                        <select name="gender_anggota[]" class="form-control">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin Member 3</td>
                                    <td>
                                        <select name="gender_anggota[]" class="form-control">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah guru pendamping juga memerlukan penginapan?</td>
                                    <td>
                                        <span><input type="radio" name="guru-penginapan" value="Ya"> Ya&nbsp &nbsp
                                        <input type="radio" name="guru-penginapan" value="Tidak"> Tidak</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kapankah tanggal kedatangan Anda?</td>
                                    <td><input type="date" class="form-control" name="tanggal-kedatangan" required></td>
                                </tr>
                                <tr>
                                    <td>Transportasi apakah yang Anda gunakan? (Pesawat/Kereta/Bus/kendaraan pribadi)</td>
                                    <td>
                                        <select name="kendaraan" class="form-control">
                                            <option value="Pesawat">Pesawat</option>
                                            <option value="Kereta">Kereta</option>
                                            <option value="Bus">Bus</option>
                                            <option value="Kendaraan-Pribadi">Kendaraan Pribadi</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Jika Anda menggunakan Pesawat, panitia akan menjemput Anda di Bandara Soekarno-Hatta</td>
                                </tr>
                                <tr>
                                    <td>Maskapai apa yang Anda gunakan?</td>
                                    <td><input type="text" class="form-control" name="maskapai"></td>
                                </tr>
                                <tr>
                                    <td>Pada pukul berapa pesawat Anda dijadwalkan berangkat?</td>
                                    <td><input type="time" class="form-control" name="brangkat-pesawat"></td>
                                </tr>
                                <tr>
                                    <td>Pada pukul berapa pesawat Anda dijadwalkan tiba?</td>
                                    <td><input type="time" class="form-control" name="tiba-pesawat"></td>
                                </tr>
                                <tr>
                                    <td>Di terminal berapa Anda akan turun?</td>
                                    <td><input type="text" class="form-control" name="terminal-pesawat"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Jika Anda menggunakan kereta, panitia akan menjemput Anda di Stasiun Universitas Indonesia</td>
                                </tr>
                                <tr>
                                    <td>Dari stasiun manakah Anda berangkat?</td>
                                    <td><input type="text" class="form-control" name="stasiun-krl"></td>
                                </tr>
                                <tr>
                                    <td>Pada pukul berapakah kereta Anda dijadwalkan berangkat?</td>
                                    <td><input type="time" class="form-control" name="brangkat-krl"></td>
                                </tr>
                                <tr>
                                    <td>Pada pukul berapakah estimasi Anda untuk tiba di St. UI</td>
                                    <td><input type="time" class="form-control" name="tiba-krl"></td>
                                </tr>
                                <tr>
                                    <td>Apa stasiun tujuan Anda? (Apabila St. UI bukan tujuan Anda, Anda dapat menggunakan KRL Jabodetabek dan turun di St. UI)</td>
                                    <td><input type="text" class="form-control" name="tujuan-krl"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Jika Anda menggunakan Bus</td>
                                </tr>
                                <tr>
                                    <td>Dari terminal manakah Anda berangkat?</td>
                                    <td><input type="text" class="form-control" name="stasiun-bus"></td>
                                </tr>
                                <tr>
                                    <td>Pada pukul berapakah bus Anda dijadwalkan berangkat?</td>
                                    <td><input type="time" class="form-control" name="brangkat-bus"></td>
                                </tr>
                                <tr>
                                    <td>Pada pukul berapakah Anda akan tiba di Terminal Kampung Rambutan/ Terminal Depok?</td>
                                    <td><input type="time" class="form-control" name="tiba-bus"></td>
                                </tr>
                                <tr>
                                    <td>Kapankah tanggal kepulangan Anda? (Semua kepulangan wajib saat acara selesai yaitu tanggal 13 November)</td>
                                    <td><input type="date" class="form-control" name="pulang"></td>
                                </tr>
                                <tr>
                                    <td>Transportasi apa yang Anda gunakan? (Pesawat/Kereta/Bus/Kendaraan Pribadi)</td>
                                    <td><input type="text" class="form-control" name="kendaraan-pulang"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p style="color:blue">Jika Anda menggunakan Pesawat</p></td>
                                </tr>
                                <tr>
                                    <td>Maskapai apa yang Anda gunakan?</td>
                                    <td><input type="text" class="form-control" name="maskapai-pulang"></td>
                                </tr>
                                <tr>
                                    <td>Pada pukul berapa pesawat Anda dijadwalkan berangkat?</td>
                                    <td><input type="time" class="form-control" name="brangkat-pesawat-pulang"></td>
                                </tr>
                                 <tr>
                                    <td colspan="2"><p style="color:blue">Jika Anda menggunakan kereta, maka panitia akan mengantar sampai St. Universitas Indonesia</p></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p style="color:blue">Jika Anda menggunakan bus, maka panitia akan mengantar sampai Terminal Kp. Rambutan dan Terminal Depok</p></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p style="color:red">Semua keberangkatan dan kepulangan harus dikonfirmasikan terlebih dahullu ke panitia. CP: 087885901321 (Rio)</p></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="submit" class="btn btn-primary pull-right" value="SUBMIT"></td>
                                </tr>
                            </table>
                        </form></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Tim Peserta</h3>
                </div>
                <div class="panel-body">
                    <p><div><strong>Kategori</strong></div><?php echo titlecase($user_category) ?></p>
                    <p><div><strong>Nama Institusi</strong></div><?php echo $user_institution_name ?></p>
                    <p><div><strong>Nama Ketua Tim</strong></div><?php echo $user_fullname_member1 ?></p>
                    <p><div><strong>Nomor Identitas Ketua Tim</strong></div><?php echo $user_id_number_member1 ?></p>
                    <p><div><strong>Gambar Scan Identitas Ketua Tim</strong></div><?php echo empty($user_identity_member1_link) ? '<span style="color:red">KOSONG</span>' : '<img src="'.base_url().$user_identity_member1_link.'" height= "100">' ?></p>
                    <p><div><strong>Gambar Pasfoto Ketua Tim</strong></div><?php echo empty($user_passphoto_link1) ? '<span style="color:red"><span style="color:red">KOSONG</span></span>' :  '<img src="'.base_url().$user_passphoto_link1.'" height= "100">' ?></p>
                    <p><div><strong>Nama Anggota 2</strong></div><?php echo $user_fullname_member2 ?></p>
                    <p><div><strong>Nomor Identitas Anggota 2</strong></div><?php echo $user_id_number_member2 ?></p>
                    <p><div><strong>Gambar Scan Identitas Anggota 2</strong></div><?php echo empty($user_identity_member2_link) ? '<span style="color:red">KOSONG</span>' :  '<img src="'.base_url().$user_identity_member2_link.'" height= "100">' ?></p>
                    <p><div><strong>Gambar Pasfoto Anggota 2</strong></div><?php echo empty($user_passphoto_link2) ? '<span style="color:red">KOSONG</span>' :  '<img src="'.base_url().$user_passphoto_link2.'" height= "100">' ?></p>
                    <p><div><strong>Nama Anggota 3</strong></div><?php echo $user_fullname_member3 ?></p>
                    <p><div><strong>Nomor Identitas Anggota 3</strong></div><?php echo $user_id_number_member3 ?></p>
                    <p><div><strong>Gambar Scan Identitas Anggota 3</strong></div><?php echo empty($user_identity_member3_link) ? '<span style="color:red">KOSONG</span>' :  '<img src="'.base_url().$user_identity_member3_link.'" height= "100">' ?></p>
                    <p><div><strong>Gambar Pasfoto Anggota 3</strong></div><?php echo empty($user_passphoto_link3) ? '<span style="color:red">KOSONG</span>' :  '<img src="'.base_url().$user_passphoto_link3.'" height= "100">' ?></p>
                    <p><div><strong>Asal Provinsi</strong></div><?php echo titlecase($this->db->get_where('misc_provinces', array('id' => $user_province_id), 1)->row()->name) ?></p>
                    <p><div><strong>Region</strong></div><?php echo $this->db->get_where('misc_region_provinces', array('region_id' => $user_province_id), 1)->row()->regionset_id ?></p>
                    <p><div><strong>Kebutuhan Hari Penginapan</strong></div><?php echo empty($user_lodging_days) ? 'Tidak ada' : $user_lodging_days ?></p>
                    <p><div><strong>Kebutuhan Transportasi di Penginapan</strong></div><?php echo empty($user_need_transport) ? 'Tidak' : 'Ya' ?></p>
                    <p><div><strong>Nama Guru Pendamping</strong></div><?php echo empty($user_teacher_name) ? 'Tidak ada' : $user_teacher_name ?></p>
                    <p><div><strong>No. Handphone Guru Pendamping</strong></div><?php echo empty($user_teacher_phone) ? 'Tidak ada' : $user_teacher_phone ?></p>
                    <p><div><strong>Email Guru Pendamping</strong></div><?php echo empty($user_teacher_email) ? 'Tidak ada' : $user_teacher_email ?></p>
                    <a href="<?php echo site_url() ?>daftar/cip/edit">Ubah</a>
                </div>
            </div>

        <?php else: ?>

            <div class="alert alert-danger">
                Anda belum berpartisipasi dalam acara/lomba ini.
            </div>

            <!-- Check if it's already in time for open registration -->
            <?php if (new DateTime() > new DateTime(CF_CIP_OPEN_REGISTRATION)) : ?>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <div class="alert alert-info col-md-12" role="alert">
                        <a href="<?php echo site_url() . 'daftar/cip'; ?>" class="btn btn-primary btn-lg" role="button">Registrasi Online</a>
                        <span>Silahkan registrasi tim anda untuk acara ini.</span>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="alert alert-danger col-md-12" role="alert">
                <?php 
                    $time_left = (new DateTime())->diff(new DateTime(CF_CIP_OPEN_REGISTRATION));
                    echo 'Registrasi online Chemistry Innovatiion Project akan dibuka <strong>' . $time_left->days . ' Hari</strong> lagi pada tanggal <strong>'
                        . DateTime::createFromFormat('Y-m-d H:i:s', CF_CIP_OPEN_REGISTRATION)->format('j F Y') . '</strong>.'; 
                ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

