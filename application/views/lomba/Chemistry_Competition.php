<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
    <div class="container">
        <div class="content-title-container col-md-12">
            <div class="hexagon col-md-3">
                <span>
                Nov <p>12</p>
                </span>
            </div>
            <h1 class="content-title col-md-9">Chemistry Competition</h1>
        </div>

        <div class="content-description-container col-md-9">
            <img src="<?php echo base_url() . 'images/supri/buku.png'; ?>">
            <p align="justify">
                Chemistry Competition ini merupakan salah satu bentuk perwujudan dari Tri Dharma Perguruan Tinggi yaitu pendidikan. Kegiatan kompetisi kimia ini diadakan untuk meningkatkan semangat berkompetisi para peserta yang meliputi siswa SMA/sederajat se-Indonesia yang akan dibagi menjadi 5 (lima) regional. Regional 1 terdiri dari Sumatera, dan sekitarnya. Regional 2 terdiri dari Banten, Jakarta, Bogor, Depok, Tangerang, Bekasi (Jabodetabek), Jawa Barat. Regional 3 terdiri dari Jawa Tengah, Jawa Timur, Bali. Regional 4 teridiri dari Kalimantan, Sulawesi, dan sekitarnya. Regional 5 terdiri dari Nusa Tenggara Barat, Nusa Tenggara Timur, Maluku, Papua.
            </p>
            <p align="justify">
                Lomba ini akan diawali dengan tahap seleksi, dimana seluruh peserta dari seluruh Indonesia yang telah mendaftar yang akan mengikuti seleksi tersebut secara tim yang secara . Seluruh 5 regional akan mengikuti tahap seleksi secara online. Kemudian seratus tim (13 tim/regional dan 35 tim secara paralel) yang lolos seleksi akan mengikuti tahap perempat final yang akan dilakukan secara tim. Kemudian, akan diambil 12 tim (1 tim/regional dan 7 paralel) untuk  tahap semifinal yang dilakukan secara individu (teori dan praktikum). Selanjutnya, akan diambil 3 peserta terbaik untuk mengikuti tahap final (cerdas cermat). Dari tahap-tahap tersebut akan diambil 3 peserta sebagai juara umum dan 1 perserta per regional sebagai juara regional.
            </p>
        </div>

        <div class="content-contact-container col-md-3">
            <b>Contact Person</b><br/>
            0896 7725 8455 Willy<br/>
            0858 9452 4679 Maryam<br/>
        </div>
        
        <div class="content-info-container col-md-6">
            <h2>Syarat Peserta</h2>
            <p>Pelajar Indonesia jenjang pendidikan SMA/se-derajat</p>
        </div>            

        <div class="content-info-container col-md-6">
            <h2>Biaya Pendaftaran</h2>
            <p>Rp.&nbsp;150.000,-/tim (1&nbsp;tim&nbsp;=&nbsp;2&nbsp;orang)</p>
        </div>

        <div class="content-info-container col-md-6">
            <h2>Waktu Pendaftaran Online</h2>
            <i>1 September 2016 – 22 Oktober 2016</i><br/>
        </div>

        <div class="content-info-container col-md-6">
            <h2>Waktu & Tempat Pelaksanaan</h2>
            <b>Seleksi Online</b><br/>
            <i>Sabtu, 29 Oktober 2016</i><br/>
            <i>Online di http://www.scele.ui.ac.id</i><br/><br/>
            <b>Perempat Final</b><br/>
            <i>Sabtu, 12 November 2016</i><br/>
            <i>Gedung B FMIPA UI</i><br/><br/>
            <b>Semifinal & Final</b><br/>
            <i>Minggu, 13 November 2016</i><br/>
            <i>Gedung G & B FMIPA UI</i><br/>
        </div>

        <div class="content-info-container col-md-6">
            <h2>Hadiah</h2>
            <b>Juara 1</b><br/>
            <p>Rp&nbsp;5.500.000,-&nbsp;+&nbsp;Medali, Sertifikat, dan Piala</p>
            <b>Juara 2</b><br/>
            <p>Rp&nbsp;4.500.000,-&nbsp;+&nbsp;Medali, Sertifikat, dan Piala</p>
            <b>Juara 3</b><br/>
            <p>Rp&nbsp;3.500.000,-&nbsp;+&nbsp;Medali, Sertifikat, dan Piala</p>
            
            <i>*Sertifikat peserta  babak Penyisihan dalam bentuk digital bagi seluruh peserta (dikirimkan melalui e-mail peserta).</i><br/>
            <i>*Peserta akan mendapatkan sertifikat sesuai dengan tahap terakhir dari seleksi yang peserta lalui.</i>
        </div>

        <!-- Downloads -->
        <div class="content-info-container col-md-12">
            <h2>Unduhan</h2>
            <a href="<?php echo base_url() . 'downloads/Guidebook CC CF 2016.pdf' ?>" download>Guidebook CC CF 2016</a><br>
        </div>

        <!-- Check if it's already in time for open registration -->
        <?php if (new DateTime() < new DateTime(CF_CC_OPEN_REGISTRATION)) : ?>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <?php if (array_key_exists('cc', $_SESSION['user_participations'])) : ?>
                    <div class="alert alert-success col-md-12" role="alert">
                        <a href="<?php echo site_url() . 'akun/dashboard/cc'; ?>" class="btn btn-primary btn-lg" role="button">Halaman Peserta</a>
                    </div>
                    <span>Anda telah terdaftar dalam acara ini. Silahkan kunjungi halaman peserta anda untuk informasi lebih lanjut.</span>
                <?php else : ?>
                    <div class="alert alert-info col-md-12" role="alert">
                        <a href="<?php echo site_url() . 'daftar/cc'; ?>" class="btn btn-primary btn-lg" role="button">Registrasi Online</a>
                    </div>
                    <span>Silahkan registrasi diri anda untuk acara ini.</span>
                <?php endif; ?>
            <?php else : ?>
                <div class="alert alert-warning col-md-12" role="alert">
                    <a href="<?php echo site_url() . 'akun/daftar'; ?>" class="btn btn-primary btn-lg alert-btn" role="button">Register</a>
                    <a href="<?php echo site_url() . 'akun/login'; ?>" class="btn btn-primary btn-lg alert-btn" role="button">Login</a>
                    <span>Sebelum anda bisa mendaftar untuk acara ini, anda harus memiliki akun Chemistry Fair 2016</span>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="alert alert-danger col-md-12" role="alert">
            <?php 
                $time_left = (new DateTime())->diff(new DateTime(CF_CC_OPEN_REGISTRATION));
                echo 'Registrasi online Chemistry Competition akan dibuka <strong>' . $time_left->days . ' Hari</strong> lagi pada tanggal <strong>'
                    . DateTime::createFromFormat('Y-m-d H:i:s', CF_CC_OPEN_REGISTRATION)->format('j F Y') . '</strong>.'; 
            ?>
            </div>
        <?php endif; ?>
    </div>
</section>