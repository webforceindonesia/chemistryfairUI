<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- The dashboard profile container -->
    <div class="dashboard-content-container col-md-9">
        <?php if ($user_is_participant == true) : ?>
            <h1>Dashboard Peserta Chemistry Innovation Project</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Status Peserta</h3>
                </div>
                <div class="panel-body">
                    <h5>Tim peserta atas nama email <strong><?php echo $user_email ?></strong></h5>

                    <?php
                        if($this->session->flashdata('upload_failed')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('upload_failed'); ?>
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

                    <?php echo form_open_multipart('akun/dashboard/cip/upload'); ?>

                    <?php if ($user_details_complete == FALSE) : ?>
                        <p>Status : <span style="color:red">Data Tim Anda Belum Lengkap!</span></p>
                        <p>Mohon melengkapi data-data tim peserta anda dibawah halaman ini.</p>
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
                        <p>Status : <span style="color:yellow">Menunggu Hasil Lolos Abstrak</span></p>
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
                        <p>Status : <span style="color:yellow">Menunggu Hasil Konfirmasi Pembayaran</span></p>
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
                    <p><div><strong>Nama Lengkap</strong></div><?php echo $user_fullname ?></p>
                    <p><div><strong>Nomor Telepon</strong></div><?php echo $user_phone_number ?></p>
                    <p><div><strong>Email Cadangan</strong></div><?php echo $user_email_recovery ?></p>
                    <a href="<?php echo site_url() ?>akun/dashboard/edit_account">Ubah</a>
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
                        <a href="<?php echo site_url() . 'register'; ?>" class="btn btn-primary btn-lg" role="button">Registrasi Online</a>
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

