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
            <h1 class="content-title col-md-6">Chemistry Art Competition</h1>
        </div>

        <div class="content-description-container col-md-9">
            <img src="<?php echo base_url() . 'images/supri/lukis.png'; ?>">

            <p>
                Chemistry Art Competition  merupakan sebuah ajang kesenian dalam acara di dalam Chemistry Fair 2016.  Acara ini bertemakan “Collaborating Art and Chemistry to Solve Energy Crisis” yang bertujuan untuk mengembangkan kreativitas dalam mengkolaborasikan kimia dan seni untuk menyelesaikan masalah krisis energi. Acara ini sendiri terdiri dari 2 (dua) lomba yaitu, lomba Chemistry Movie Project & Chemistry Photograph. Sehingga, CAC 2016 ini mendorong kreativitas dan pengembangan jiwa seni dari tiap peserta tentang bagaimana mengaplikasikan kimia terhadap seni itu sendiri.
            </p>
        </div>

        <div class="content-contact-container col-md-3">
            <b>Contact Person</b><br/>
            0857 7052 9291 Manda<br/>
            0813 8057 7214 Dena<br/>
            0856 9736 6602 Putri<br/>
        </div>

        <div class="content-info-container col-md-6">
            <h2>Syarat Peserta</h2>
            <p>Pelajar Indonesia jenjang pendidikan SMA/se-derajat</p>
        </div>

        <div class="content-info-container col-md-6">
            <h2>Biaya Pendaftaran</h2>
            
            <b>Chemistry Movie Project</b><br/>
            <p>Rp.&nbsp;75.000,-/karya</p>

            <b>Chemistry Photograph</b><br/>
            <p>Rp.&nbsp;50.000,-/karya</p>
            </div>

        <div class="content-info-container col-md-6">
            <h2>Waktu Pendaftaran Online</h2>
            <i>1 September – 29 Oktober 2016</i><br/>

            <h3>Pengumuman Pemenang</h2>
            <i>6 November 2016</i><br/>

            <h3>Exhibition Day</h2>
            <i>13 November 2016 (Voting juara terfavorit)</i><br/>
        </div>

        <div class="content-info-container col-md-6">
            <h2>Waktu & Tempat Pelaksanaan</h2>

            <h3>Chemistry Movie Project</h3>
            <b>Upload Online</b><br/>
            <i>1 September – 29 Oktober 2016</i><br/>
            <i>Online di Akun Youtube Chemistry Fair</i><br/><br/>

            <b>Display</b><br/>
            <i>Minggu, 13 November 2016</i><br/>
            <i>Gedung B FMIPA UI</i><br/><br/>

            <h3>Chemistry Photograph</h3>
            <b>Upload Online</b><br/>
            <i>1 September – 29 Oktober 2016</i><br/>
            <i>Online di Akun Youtube Chemistry Fair</i><br/><br/>

            <b>Display</b><br/>
            <i>Minggu, 13 November 2016</i><br/>
            <i>Gedung B FMIPA UI</i><br/><br/>
        </div>

        <div class="content-info-container col-md-12">
            <h2>Hadiah</h2>

            <div class="col-md-6">
                <h3>Chemistry Movie Project</h3>
                <b>Juara 1</b><br/>
                <p>Rp&nbsp;2.200.000,-&nbsp;+&nbsp;Piala dan Sertifikat.</p>
                <b>Juara 2</b><br/>
                <p>Rp&nbsp;1.800.000,-&nbsp;+&nbsp;Piala dan Sertifikat.</p>
                <b>Juara 3</b><br/>
                <p>Rp&nbsp;1.500.000,-&nbsp;+&nbsp;Piala dan Sertifikat.</p>
                <b>Juara Favorit</b><br/>
                <p>Rp&nbsp;800.000,-&nbsp;+&nbsp;Sertifikat.</p>
            </div>

            <div class="col-md-6">
                <h3>Chemistry Photograph</h3>
                <b>Juara 1</b><br/>
                <p>Rp&nbsp;1.800.000,-&nbsp;+&nbsp;Piala dan Sertifikat.</p>
                <b>Juara 2</b><br/>
                <p>Rp&nbsp;1.500.000,-&nbsp;+&nbsp;Piala dan Sertifikat.</p>
                <b>Juara 3</b><br/>
                <p>Rp&nbsp;1.300.000,-&nbsp;+&nbsp;Piala dan Sertifikat.</p>
                <b>Juara Favorit</b><br/>
                <p>Rp&nbsp;700.000,-&nbsp;+&nbsp;Sertifikat.</p>
            </div>
            
            <i>*E-sertifikat akan diberikan kepada seluruh peserta yang mengikuti seleksi karya.</i>
        </div>

        <!-- Check if it's already in time for open registration -->
        <?php if (new DateTime() > new DateTime(CF_CAC_OPEN_REGISTRATION)) : ?>
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
                $time_left = (new DateTime())->diff(new DateTime(CF_CAC_OPEN_REGISTRATION));
                echo 'Registrasi online Chemistry Art Competition akan dibuka <strong>' . $time_left->days . ' Hari</strong> lagi pada tanggal <strong>'
                    . DateTime::createFromFormat('Y-m-d H:i:s', CF_CAC_OPEN_REGISTRATION)->format('j F Y') . '</strong>.'; 
            ?>
            </div>
        <?php endif; ?>
    </div>
</section>