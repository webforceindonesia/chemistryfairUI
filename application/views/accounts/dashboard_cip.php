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
                    <h5>Tim peserta atas nama email <?php echo $user_email ?></h5>

                    <?php if ($user_details_complete == FALSE) : ?>
                        <p>Status : <span style="color:red">Data Tim Anda Belum Lengkap!</span></p>
                        <p>Mohon melengkapi data-data tim peserta anda dibawah halaman ini.</p>
                    <?php elseif ($user_submitted_abstract == FALSE) : ?>
                        <p>Status : <span style="color:red">Menunggu Upload Abstrak</span></p>
                        <p>Mohon mengupload karya abstrak anda di tempat di bawah ini. Anda hanya bisa mengupload abstrak satu kali saja, jadi mohon
                           upload hanya revisi terakhir dari abstrak anda.</p>
                        <p>WIP Area upload abstrak pake JO HALP</p>
                    <?php elseif ($user_passed_abstract == FALSE) : ?>
                        <p>Status : <span style="color:yellow">Menunggu Hasil Lolos Abstrak</span></p>
                        <p>Tim kami akan memeriksa dan menilai abstrak anda, mohon menunggu hingga hasil penilaian
                         abstrak anda keluar. Terima kasih.</p>
                    <?php elseif ($user_submitted_payment_proof == FALSE) : ?>
                        <p>Status : <span style="color:red">Menunggu Upload Bukti Pembayaran</span></p>
                        <p>Selamat! Anda telah lolos dalam tahap seleksi abstrak. Untuk melanjutkan ke tahap berikutnya, mohon
                         membayar biaya pendaftaran dengan invoice yang bisa anda download di link dibawah ini.</p>
                        <p>WIP Link downlod pdf JO HALP</p>
                        <p>Setelah membayar, mohon screenshot atau foto bukti pembayaran anda dan menguploadnya di tempat di bawah ini : </p>
                        <p>WIP Area upload bukti pembayaran JO HALP</p>
                    <?php elseif ($user_payment_verified == FALSE) : ?>
                        <p>Status : <span style="color:yellow">Menunggu Hasil Konfirmasi Pembayaran</span></p>
                        <p>Tim kami akan memeriksa bukti pembayaran yang sudah Anda upload. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Anda bisa mengupdate bukti pembayaran Anda jika perlu : </p>
                        <p>WIP Area upload bukti pembayaran JO HALP</p>
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
        <?php endif; ?>
        
    </div>
</div>


