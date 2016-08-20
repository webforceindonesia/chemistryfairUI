<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
	<div id="aboutUs">
		<div class="container">
			<div class="col-md-5">
            	<div class="logo_about_us">
                    <br>
                <br><br>
                	<p align="center"><img src="<?php echo base_url() ?>images/supri/stand.png" style="max-width:200px; margin-top:-2em; margin-left:-2em;"></p>
                </div>
            </div>
            <div class="col-md-7">
            	<div class="paragraph">
                	<h1 align="center"><b>Hubungi Kami</b></h1>
                    <br>
                	<?php echo form_open('contact/submit') ?>
                        <table class="table table-hover">
                            <tr>
                                <div class="form-group">
                                    <td>
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td>
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control" required>
                                    </td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td>
                                        <label for="content">Pesan</label>
                                        <textarea name="content" class="form-control" required></textarea>
                                    </td>
                                </div>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="btn btn-primary" value="Kontak" style="width:100%">
                                </td>
                            </tr>
                        </table>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
 </section>