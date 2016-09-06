<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- The dashboard profile container -->
    <div class="dashboard-content-container col-md-9">
        <?php if ($user_is_participant == true) : ?>
            <h1>Dashboard Peserta Chemistry Photograph</h1>
                <?php
                    if($this->session->flashdata('upload_failed')): ?>
                        <pre>
                            <?php print_r($this->session->flashdata('upload_failed')) ?>
                        </pre>
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
                        <p>Peserta diharap membayar biaya administrasi Rp.50,000.00 ke Nomor Rekening BRI 0951-01-043292-532 a/n Fiona Angellinnov</p>
                        <p>Setelah membayar, mohon screenshot atau foto bukti pembayaran anda dan menguploadnya di tempat di bawah ini : </p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cp/upload'); ?>
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
                        <p>Status : <span style="color:blue">Menunggu Hasil Konfirmasi Pembayaran Atau Pembayaran Tidak Tervalidasi</span></p>
                        <p>Tim kami akan memeriksa bukti pembayaran yang sudah Anda upload. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Anda bisa mengupdate bukti pembayaran Anda jika perlu : </p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cp/upload'); ?>
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
                        <p>Status : <span style="color:red">Pembayaran Anda Ditolak, Tolong Upload bukti pembayaran baru!</span></p>
                        <p>Tim kami akan memeriksa bukti pembayaran yang sudah Anda upload. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Anda bisa mengupdate bukti pembayaran Anda jika perlu : </p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cp/upload'); ?>
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
                    <?php elseif ($user_instagram_link == NULL) : ?>
                        <p>Status : <span style="color:blue">Menunggu Upload Foto Hasil Karya</span></p>
                        <p>Tim kami akan memeriksa foto hasil karya anda. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cp/insta'); ?>
                        <?php

                        // Upload Bukti Trf
                        echo form_label('File Foto Hasil Karya', 'insta', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('insta');
                        echo form_upload(array(
                            'class'         => 'btn btn-primary form-control', 
                            'name'          => 'insta_file',
                            'placeholder'   => 'Upload File.',
                        )); 

                        echo '<br>';

                        // Upload Bukti Trf
                        echo form_label('Deskripsi Foto', 'des', array('class' => 'form-label'));
                        echo '<br>';
                        echo form_error('des');
                        echo form_upload(array(
                            'class'         => 'button button-success form-control', 
                            'name'          => 'des',
                            'placeholder'   => 'Deskripsi Foto.',
                        )); 

                        echo '<br>';

                        echo form_submit(array('class' => 'form-submit btn btn-primary', 'name' => 'submit', 'value' => 'Submit'));

                        ?></form></p>
                    <?php elseif ($user_payment_verified == 1) : ?>
                        <p>Status : <span style="color:green">Menunggu Pengumuman Pemenang</span></p>
                        <p>Selamat! Pembayaran anda telah kami konfirmasikan dan Hasil Karya anda telah kami terima!
                         Semoga sukses!</p>
                    <?php elseif ($user_payment_verified == 3) : ?>
                        <p>Status : <span style="color:red">Anda Telah Gugur Dalam Seleksi</span></p>
                        <p>
                            Mohon maaf, karya Tim Anda belum menjadi juara Chemistry Photograph.
                            Tetap semangat berkarya dan berkompetisi demi kemajuan bangsa.
                            Kegagalan merupakan kemenangan yang tertunda.
                            Kami tunggu kehadiran Tim Anda di Chemistry Art Competition tahun depan
                        </p>
                    <?php elseif ($user_payment_verified == 4) : ?>
                        <p>Status : <span style="color:green">Selamat! Anda Menang!</span></p>
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
                    <p><div><strong>Nama Institusi</strong></div><?php echo $user_institution_name ?></p>
                    <p><div><strong>Nama Panjang</strong></div><?php echo $user_fullname ?></p>
                    <p><div><strong>Nomor Identitas</strong></div><?php echo $user_id_number ?></p>
                    <p><div><strong>Foto Kartu identitas</strong></div><?php echo empty($user_identity_link) ? '<span style="color:red">KOSONG</span>' :  '<img src="'.base_url().$user_identity_link.'" height= "100">' ?></p>
                    <p><div><strong>Alamat</strong></div><?php echo $address ?></p>
                    <p><div><strong>Nomor Telpon</strong></div><?php echo $phone ?></p>
                    <p><div><strong>Email</strong></div><?php echo $email ?></p>
                    <a href="<?php echo site_url() ?>daftar/cp/edit">Ubah</a>
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
                        <a href="<?php echo site_url() . 'daftar/cp'; ?>" class="btn btn-primary btn-lg" role="button">Registrasi Online</a>
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

