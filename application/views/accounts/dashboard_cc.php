<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- The dashboard profile container -->
    <div class="dashboard-content-container col-md-9">
        <?php if ($user_is_participant == true) : ?>
            <h1>Dashboard Peserta Chemistry Competition</h1>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Status Peserta</h3>
                </div>
                <div class="panel-body">
                    <h5>Tim peserta atas nama email <strong><?php echo $user_email ?></strong></h5>

                    <?php if ($user_details_complete == FALSE) : ?>
                        <p>Status : <span style="color:red">Data gambar anda belum lengkap!</span></p>
                        <p>Mohon melengkapi dan mengupload semua gambar-gambar yang dibutuhkan di bawah ini.</p>
                    <?php elseif ($user_submitted_payment_proof == NULL) : ?>
                        <p>Status : <span style="color:red">Menunggu Upload Bukti Pembayaran</span></p>
                        <p>Peserta diharap membayar biaya administrasi <p style="color:blue">Rp.150,000.00</p> ke Nomor Rekening BRI 0951-01-043292-532 a/n Fiona Angellinnov</p>
                        <p>Setelah membayar, mohon screenshot atau foto bukti pembayaran anda dan menguploadnya di tempat di bawah ini : </p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cc/upload'); ?>
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

                        <?php echo form_open_multipart('akun/dashboard/cc/upload'); ?>
                        <?php

                        // Upload Bukti Trf
                        echo form_label('File Bukti Transfer', 'bukti', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('bukti');
                        echo form_upload(array(
                            'class'         => 'button button-success', 
                            'name'          => 'file_bukti',
                            'placeholder'   => 'Upload File',
                        )); 

                        echo '<br>';

                        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Upload'));

                        ?></form></p>
                    <?php elseif ($user_payment_verified == 2) : ?>
                        <p>Status : <span style="color:red">Pembayaran Anda Ditolak, Tolong Upload bukti pembayaran baru!</span></p>
                        <p>Tim kami akan memeriksa bukti pembayaran yang sudah Anda upload. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Anda bisa mengupdate bukti pembayaran Anda jika perlu : </p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cmm,/upload'); ?>
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
                    <?php elseif ($user_passed == 1) : ?>
                        <p>Status : <span style="color:green">Anda Lolos seleksi</span></p>
                        <p>Tolong isi form di bawah ini mengenai penginapan saat lomba nanti, selanjutnya anda akan dihubungkan dengan panitia</p>
                        <br>
                        <p>
                        <?php echo form_open_multipart('akun/dashboard/cc/email_penginapan'); ?>
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
                                    <td><input type="text" class="form-control" name="gender_ketua" required></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin Anggota</td>
                                    <td><input type="text" class="form-control" name="gender_anggota" required></td>
                                </tr>
                                <tr>
                                    <td>Apakah guru pendamping juga memerlukan penginapan?</td>
                                    <td>
                                        <span><input type="radio" name="guru-penginapan" value="Ya" class="form-control">Ya</span>
                                        <span><input type="radio" name="guru-penginapan" value="Tidak" class="form-control">Tidak</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kapankah tanggal kedatangan Anda?</td>
                                    <td><input type="date" class="form-control" name="tanggal-kedatangan" required></td>
                                </tr>
                                <tr>
                                    <td>Transportasi apakah yang Anda gunakan? (Pesawat/Kereta/Bus/kendaraan pribadi)</td>
                                    <td><input type="text" class="form-control" name="kendaraaan" required></td>
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
                    <?php elseif ($user_passed == 2) : ?>
                        <p>Status : <span style="color:red">Maaf anda gagal dalam seleksi.</span></p>
                        <p>Tim kami akan memeriksa link youtube anda. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Anda bisa mengupdate link youtube Anda jika perlu : </p>
                    <?php elseif ($user_payment_verified == 1) : ?>
                        <p>Status : <span style="color:blue">Menunggu Pengumuman Hasil Seleksi</span></p>
                        <p>Tim kami akan mengumumkan hasil seleksi. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Jika anda memiliki pertanyaan, silahkan menhubungi :</p>
                        <p>
                        seleksi online akan dilaksanakan di www.scele.ui.ac.id pada tanggal 29 Oktober 2016.<br><br>
                        Dibawahnya terdapat pernyataan bahwa akun scele.ui.ac.id akan segera dikirimkan ke email ketua tim, maksimal 1 hari setelah panitia mengkonfirmasi bukti pembayaran.<br><br>
                        Try Out Seleksi Online Chemistry Competition dilaksanakan di scele.ui.ac.id pada tanggal 24, dan 25 Oktober 2016<br>
                        Hasil seleksi online akan diumumkan pada tanggal 2 November 2016<br><br>
                        Tanggal Penting Waktu dan Tempat Seleksi Online:<br>
                        Try Out Online Chemistry Competition: 24 & 25 Oktober 2016 di website scele.ui.ac.id<br>
                        Seleksi Online Chemistry Competition: 29 Oktober 2016 di website scele.ui.ac.id<br>
                        Pengumuman Hasil Seleksi Online Chemistry Competition: 2 November 2016 di Website CF 2016<br>
                        </p>
                        <strong><!-- Cp Goes Here --></strong>
                    <?php elseif ($user_payment_verified == 3) : ?>
                        <p>Status : <span style="color:red">Anda Telah Gugur Dalam Seleksi</span></p>
                        <p>
                            Mohon maaf, karya Tim Anda belum menjadi juara Chemistry Photograph.
                            Tetap semangat berkarya dan berkompetisi demi kemajuan bangsa.
                            Kegagalan merupakan kemenangan yang tertunda.
                            Kami tunggu kehadiran Tim Anda di Chemistry Art Competition tahun depan
                        </p>
                    <?php elseif ($user_payment_verified == 4) : ?>
                        <p>Status : <span style="color:green">Anda Telah Menang!</span></p>
                        <p>
                            Untuk konfirmasi kemenangan dan untuk kontak selanjutnya harap hubungi <br><br>Manda (086770529281)<br>Putri (085697366602)<br><br>
                            Kami tunggu kehadiran Tim Anda di Chemistry Art Competition tahun depan!
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Tim Peserta</h3>
                </div>
                <div class="panel-body">
                    <p><div><strong>Nama Institusi</strong></div><?php echo $institution_name ?></p>
                    <p><div><strong>Nama Ketua</strong></div><?php echo $user_fullname_ketua ?></p>
                    <p><div><strong>Nama Anggota</strong></div><?php echo $user_fullname_anggota ?></p>
                    <p><div><strong>Address</strong></div><?php echo $address ?></p>
                    <p><div><strong>Email</strong></div><?php echo $email ?></p>
                    <p><div><strong>Phone</strong></div><?php echo $phone ?></p>
                    <p><div><strong>Foto Kartu identitas Ketua</strong></div><?php echo empty($user1_identity_link) ? '<span style="color:red">KOSONG</span>' :  '<img src="'.base_url().$user1_identity_link.'" height= "100">' ?></p>
                    <p><div><strong>Foto Kartu identitas Anggota</strong></div><?php echo empty($user2_identity_link) ? '<span style="color:red">KOSONG</span>' :  '<img src="'.base_url().$user2_identity_link.'" height= "100">' ?></p>
                    <p><div><strong>Alamat</strong></div><?php echo $address ?></p>
                    <p><div><strong>Nomor Telpon</strong></div><?php echo $phone ?></p>
                    <p><div><strong>Email</strong></div><?php echo $email ?></p>
                    <p><div><strong>Nama Guru Pendamping</strong></div><?php echo $teacher_name ?></p>
                    <p><div><strong>Telepon Guru Pendamping</strong></div><?php echo $teacher_phone ?></p>
                    <p><div><strong>Email Guru Pendamping</strong></div><?php echo $teacher_email ?></p>
                    <a href="<?php echo site_url() ?>daftar/cc/edit">Ubah</a>
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
                        <a href="<?php echo site_url() . 'daftar/cmp'; ?>" class="btn btn-primary btn-lg" role="button">Registrasi Online</a>
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

