<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- The dashboard profile container -->
    <div class="dashboard-content-container col-md-9">
        <?php if ($user_is_participant == true) : ?>
            <h1>Dashboard Peserta Chemistry Innovation Project</h1>
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

                    <?php echo form_open_multipart('akun/dashboard/cip/upload'); ?>

                    <?php if ($user_details_complete == FALSE) : ?>
                        <p>Status : <span style="color:red">Data gambar anda belum lengkap!</span></p>
                        <p>Mohon melengkapi dan mengupload semua gambar-gambar yang dibutuhkan di bawah ini.</p>
                    <?php elseif ($user_submitted_abstract == NULL) : ?>
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
                    <?php elseif ($user_submitted_payment_proof == NULL) : ?>
                        <p>Status : <span style="color:red">Menunggu Upload Bukti Pembayaran</span></p>
                        <p>Selamat! Anda telah lolos dalam tahap seleksi abstrak. Untuk melanjutkan ke tahap berikutnya, mohon
                         membayar biaya pendaftaran dengan invoice yang bisa anda download di link dibawah ini.</p>
                        <p>WIP Link downlod pdf JO HALP</p>
                        <p>Setelah membayar, mohon screenshot atau foto bukti pembayaran anda dan menguploadnya di tempat di bawah ini : </p>
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
                    <?php else : ?>
                        <p>Status : <span style="color:green">Pembayaran Terkonfirmasi</span></p>
                        <p>Selamat! Pembayaran anda telah kami konfirmasikan dan tim anda sudah menjadi peserta dalam lomba Chemistry Innovation Project!
                         Semoga sukses!</p>
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
                    <p><div><strong>Gambar Scan Identitas Ketua Tim</strong></div><?php echo empty($user_identity_member1_link) ? '<span style="color:red">KOSONG</span>' : '<a href="'.$user_identity_member1_link.'">Link</a>' ?></p>
                    <p><div><strong>Gambar Pasfoto Ketua Tim</strong></div><?php echo empty($user_passphoto_link1) ? '<span style="color:red"><span style="color:red">KOSONG</span></span>' :  '<a href="'.$user_passphoto_link1.'">Link</a>' ?></p>
                    <p><div><strong>Nama Anggota 2</strong></div><?php echo $user_fullname_member2 ?></p>
                    <p><div><strong>Nomor Identitas Anggota 2</strong></div><?php echo $user_id_number_member2 ?></p>
                    <p><div><strong>Gambar Scan Identitas Anggota 2</strong></div><?php echo empty($user_identity_member2_link) ? '<span style="color:red">KOSONG</span>' :  '<a href="'.$user_identity_member2_link.'">Link</a>' ?></p>
                    <p><div><strong>Gambar Pasfoto Anggota 2</strong></div><?php echo empty($user_passphoto_link2) ? '<span style="color:red">KOSONG</span>' :  '<a href="'.$user_passphoto_link2.'">Link</a>' ?></p>
                    <p><div><strong>Nama Anggota 3</strong></div><?php echo $user_fullname_member3 ?></p>
                    <p><div><strong>Nomor Identitas Anggota 3</strong></div><?php echo $user_id_number_member3 ?></p>
                    <p><div><strong>Gambar Scan Identitas Anggota 3</strong></div><?php echo empty($user_identity_member3_link) ? '<span style="color:red">KOSONG</span>' :  '<a href="'.$user_identity_member3_link.'">Link</a>' ?></p>
                    <p><div><strong>Gambar Pasfoto Anggota 3</strong></div><?php echo empty($user_passphoto_link3) ? '<span style="color:red">KOSONG</span>' :  '<a href="'.$user_passphoto_link3.'">Link</a>' ?></p>
                    <p><div><strong>Asal Provinsi</strong></div><?php echo titlecase($this->db->get_where('misc_provinces', array('id' => $user_province_id), 1)->row()->name) ?></p>
                    <p><div><strong>Region</strong></div><?php echo $this->db->get_where('misc_region_provinces', array('region_id' => $user_province_id), 1)->row()->regionset_id ?></p>
                    <p><div><strong>Kebutuhan Hari Penginapan</strong></div><?php echo empty($user_lodging_days) ? 'Tidak ada' : $user_lodging_days ?></p>
                    <p><div><strong>Kebutuhan Transportasi di Penginapan</strong></div><?php echo empty($user_need_transport) ? 'Tidak' : 'Ya' ?></p>
                    <p><div><strong>Nama Guru Pendamping</strong></div><?php echo empty($user_teacher_name) ? 'Tidak ada' : $user_teacher_name ?></p>
                    <p><div><strong>No. Handphone Guru Pendamping</strong></div><?php echo empty($user_teacher_phone) ? 'Tidak ada' : $user_teacher_phone ?></p>
                    <p><div><strong>Email Guru Pendamping</strong></div><?php echo empty($user_teacher_email) ? 'Tidak ada' : $user_teacher_email ?></p>
                    <a href="<?php echo site_url() ?>akun/dashboard/cip_edit">Ubah</a>
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
                        <a href="<?php echo site_url() . 'akun/dashboard/cip_register'; ?>" class="btn btn-primary btn-lg" role="button">Registrasi Online</a>
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

