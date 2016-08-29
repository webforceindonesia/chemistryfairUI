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
                        <p>Tolong isi form di bawah ini mengenai penginapan saat lomba nanti, selanjutnya anda akan dihubungkan dengan panitia langsung</p>
                        <p>

                        <?php echo form_open_multipart('akun/dashboard/cc/email_penginapan'); ?>
                            <table class="table table-bordered">
                            </table>
                        </form></p>
                    <?php elseif ($user_passed == 2) : ?>
                        <p>Status : <span style="color:red">Maaf anda gagal dalam seleksi.</span></p>
                        <p>Tim kami akan memeriksa link youtube anda. Mohon menunggu akan konfirmasi
                         dari pihak kami. Terima kasih.</p>
                        <p>Anda bisa mengupdate link youtube Anda jika perlu : </p>
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

