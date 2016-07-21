<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
    <div class="container">
        <div class="content-title-container col-md-12">
            <div class="hexagon col-md-3">
                <span>
                Nov <p>19</p>
                </span>
            </div>
            <h1 class="content-title col-md-9">Chemistry Fair Kids</h1>
        </div>

        <div class="content-description-container col-md-9">
            <img src="<?php echo base_url() . 'images/supri/bocah.png'; ?>">
            <p>
                Chemistry Fair Kids merupakan salah satu bentuk dari perwujudan Tri Dharma Perguruan Tinggi yaitu dalam pengabdian masyarakat. Chemistry Fair Kids pada Chemistry Fair 2016 ini bertemakan “Pre Education on Energy”. Tema ini memiliki tujuan memberikan pendidikan sejak dini bagi para generasi muda akan pentingnya energi dalam kehidupan kita. Rangkaian kegiatan Chemistry Fair Kids ini berupa lomba mewarnai yang terbagi ke dalam 2 kategori. Kategori pertama akan diikuti oleh anak-anak pada jenjang pendidikan TK dan kategori kedua akan diikuti anak-anak dengan jenjang pendidikan kelas 1 SD hingga kelas 3 SD. Selain itu juga terdapat lomba menghias kue bersama keluarga.
            </p>
            <p>
                Acara ini juga disertai demonstrasi percobaan kimia sederhana, sehingga Chemistry Fair Kids Chemistry Fair 2016 ini sangat menjelaskan tentang bagaimana peranan kimia itu sendiri terhadap generasi muda, bahkan kepada anak-anak.
            </p>
            <h2>Syarat Peserta</h2>
            <b>Lomba Mewarnai TK</b><br/>
            <p>Anak-anak pada jenjang pendidikan TK se-derajat</p>
            <b>Lomba Mewarnai SD</b><br/>
            <p>Siswa/siswi pada jenjang pendidikan Sekolah Dasar se-derajat dari kelas&nbsp;1 hingga kelas&nbsp;3</p>
            <b>Lomba Menghias Kue</b><br/>
            <p>Anak-anak pada jenjang pendidikan TK se-derajat</p>

            <h2>Biaya Pendaftaran</h2>
            <b>Lomba Mewarnai TK</b><br/>
            <p>Rp.&nbsp;20.000,-</p>
            <b>Lomba Mewarnai SD</b><br/>
            <p>Rp.&nbsp;20.000,-</p>
            <b>Lomba Menghias Kue</b><br/>
            <p>Rp.&nbsp;40.000,-</p>
            <b>Jika mendaftar kedua lomba</b><br/>
            <p>Rp.&nbsp;30.000,-</p>

            <h2>Waktu & Tempat</h2>
            <i>Sabtu, 19 November 2016</i><br/>
            <i>Gedung Annex Balairung, Universitas Indonesia</i><br/>

            <h2>Hadiah</h2>
            <b>Lomba Mewarnai TK</b><br/>
            <p>Tiga karya terbaik mendapatkan uang sebesar Rp&nbsp;100.000,-</p>
            <b>Lomba Mewarnai SD</b><br/>
            <p>Tiga karya terbaik mendapatkan uang sebesar Rp&nbsp;100.000,-</p>
            <b>Lomba Menghias Kue</b><br/>
            <p>
                Juara 1: Rp 300.000,-<br/>
                Juara 2: Rp 250.000,-<br/>
                Juara 3: Rp 200.000,-<br/>
            </p>
        </div>
        <div class="content-contact-container col-md-3">
            <b>Contact Person</b><br/>
            0857 1054 1545 Ika<br/>
            0857 7114 2307 Nur Aisyah<br/>
        </div>

        <!-- Check if it's already in time for open registration -->
        <?php if (new DateTime() > new DateTime(CF_CFK_OPEN_REGISTRATION)) : ?>
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
                $time_left = (new DateTime())->diff(new DateTime(CF_CFK_OPEN_REGISTRATION));
                echo 'Registrasi online seminar akan dibuka <strong>' . $time_left->days . ' Hari</strong> lagi pada tanggal <strong>'
                    . DateTime::createFromFormat('Y-m-d H:i:s', CF_CFK_OPEN_REGISTRATION)->format('j F Y') . '</strong>.'; 
            ?>
            </div>
        <?php endif; ?>
    </div>
</section>