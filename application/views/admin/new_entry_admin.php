<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
	<div id="aboutUs">
		<div class="container">
            <div class="form">
 				<?php echo form_open ('admin/new_admin') ?>
                <div class="row">
                    <div class="col-md-1">
                    	<h1>Username</h1>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <input type="text" name="username" class="form-control">
                    </div>
                </div>
                <br><br>
                 <div class="row">
                    <div class="col-md-1">
                        <h1>Password</h1>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <input type="text" name="password" class="form-control">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-1">
                        <h1>Email</h1>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <input type="text" name="email" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="submit" class="form-control">
                </div>
                </form>
            </div> 
        </div>
    </div>
 </section>