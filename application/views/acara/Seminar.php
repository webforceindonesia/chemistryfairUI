<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
    <div class="container">
        <div class="content-title-container col-md-12">
            <div class="hexagon col-md-3">
                <span>
                Sept <p>26</p>
                </span>
            </div>
            <h1 class="content-title col-md-9">Seminar Nasional</h1>
        </div>

        <div class="content-description-container col-md-9">
            <img src="<?php echo base_url() . 'images/supri/seminar.png'; ?>">
            <p>
                Seminar Nasional merupakan seminar yang terbuka untuk siswa SMA, mahasiswa, pemenang lomba, kalangan akademisi dan profesional dalam bidang kimia dengan menghadirkan pembicara dari luar negeri yang menaungi lembaga berbasis penyelesaian bagi krisis energi nasional melalui pemanfaatan energi baru dan terbarukan. 
            </p>
            <p>
                Tema seminar kali ini yaitu <strong>“Role of Chemical Alternative Energy to Maintain the Sustainability”</strong>. Dengan tema ini, diharapkan peserta dapat memahami peranan energi alternatif kimia dalam menjaga ketahanan energi nasional di tengah isu krisis energi dewasa ini.
            </p>
            <h3>Biaya Pendaftaran</h3>
            <div class='content-left-label'>
                <b>Pelajar</b><br/>
                <b>Umum</b><br/>
        </div>
            <div class='content-left-value'>
                Rp. 80.000,-<br/>
                Rp. 100.000,-<br/>
            </div>

            <br/>
            <br/>
            <br/>

            <h3>Waktu & Tempat</h3>
                <i>Sabtu, 26 November 2016</i><br/>
                <i>Auditorium Gedung RIK, Universitas Indonesia</i><br/>
        </div>
        <div class="content-contact-container col-md-3">
            <b>Contact Person</b><br/>
            0838 9716 5711 Kenny<br/>
            0812 8193 9941 Aisyah<br/>
        </div>

        <!-- Check if it's already in time for open registration -->
        <?php if (new DateTime() > new DateTime(CF_SEMINAR_OPEN_REGISTRATION)) : ?>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <?php if (in_array('seminar', $_SESSION['user_participations'])) : ?>
                    <div class="alert alert-success col-md-12" role="alert">
                        <a href="<?php echo site_url() . 'profile'; ?>" class="btn btn-primary btn-lg" role="button">Halaman Peserta</a>
                    </div>
                    <span>Anda telah terdaftar dalam acara ini. Silahkan kunjungi halaman peserta anda untuk informasi lebih lanjut.</span>
                <?php else : ?>
                    <div class="alert alert-info col-md-12" role="alert">
                        <a href="<?php echo site_url() . 'register'; ?>" class="btn btn-primary btn-lg" role="button">Registrasi Online</a>
                    </div>
                    <span>Silahkan registrasi diri anda untuk acara ini.</span>
                <?php endif; ?>
            <?php else : ?>
                <div class="alert alert-warning col-md-12" role="alert">
                    <a href="<?php echo site_url() . 'register'; ?>" class="btn btn-primary btn-lg alert-btn" role="button">Register</a>
                    <a href="<?php echo site_url() . 'register'; ?>" class="btn btn-primary btn-lg alert-btn" role="button">Login</a>
                    <span>Sebelum anda bisa mendaftar untuk acara ini, anda harus memiliki akun Chemistry Fair 2016</span>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="alert alert-danger col-md-12" role="alert">
            <?php 
                $time_left = (new DateTime())->diff(new DateTime(CF_SEMINAR_OPEN_REGISTRATION));
                echo 'Registrasi online seminar akan dibuka <strong>' . $time_left->days . ' Hari</strong> lagi pada tanggal <strong>'
                    . DateTime::createFromFormat('Y-m-d H:i:s', CF_SEMINAR_OPEN_REGISTRATION)->format('j F Y') . '</strong>.'; 
            ?>
            </div>
        <?php endif; ?>
    </div>
</section>