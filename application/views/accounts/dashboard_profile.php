<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- The dashboard profile container -->
    <div class="dashboard-content-container col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Status Akun</h3>
            </div>
            <div class="panel-body">
                <h3><?php echo $user_fullname ?></h3>
                <h5><?php echo $user_email ?></h5>

                <?php if ($user_verified == TRUE) : ?>
                    <p>Status : <span style="color:green">Terverifikasi</span></p>
                <?php else : ?>
                    <p>Status : <span style="color:red">Belum Terverifikasi</span></p>
                    <p>Akun Chemistry Fair 2016 anda belum terverifikasi, mohon cek email anda akan email dari kami. (Cek juga dalam kategori spam)</p>
                    <p>Jika anda ingin mengirim ulang email verifikasi akun, mohon lakukan captcha dibawah ini 
                    lalu klik tombol <strong>Kirim Ulang Email Verifikasi</strong>!</p>
                    <?php 
                        echo form_open('accounts/dashboard');
                        echo form_label('Verifikasi bahwa anda adalah manusia.', '', array('class' => 'form-label'));
                        if ($show_captcha_error) echo '<div class="form-error">Verifikasi Captcha anda gagal, mohon dicoba lagi.</div>';
                        echo '<div class="g-recaptcha" data-sitekey="6Lcr_SUTAAAAAJ-HOnPhgHwkC3Rb4BsvnqZw8KSX"></div>';
                        echo '<br/>';
                        echo form_submit(array('class' => 'form-submit', 'name' => 'submit', 'value' => 'Kirim Ulang Email Verifikasi'));
                        echo form_close();
                    ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Detail Akun</h3>
            </div>
            <div class="panel-body">
                <p><div><strong>Nama Lengkap</strong></div><?php echo $user_fullname ?></p>
                <p><div><strong>Nomor Telepon</strong></div><?php echo $user_phone_number ?></p>
                <p><div><strong>Email Cadangan</strong></div><?php echo $user_email_recovery ?></p>
                <a href="<?php echo site_url() ?>akun/dashboard/edit_account">Ubah</a>
            </div>
        </div>
    </div>
</div>


