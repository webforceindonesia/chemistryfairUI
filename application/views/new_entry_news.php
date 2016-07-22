<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url() ?>tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '#wysiwyg'
  });
</script>
<section id="contentAll">
	<div id="aboutUs">
		<div class="container">
            <div class="form">
 				<?php echo form_open ('admin/new_news') ?>
                <div class="row">
                    <div class="col-md-1">
                    	<h1>Title</h1>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="content" id="wysiwyg"></textarea>
                    </div>
                </div>
                <br><br>
                <div class="col-md-4">
                    <input type="submit" class="form-control">
                </div>
                </form>
            </div> 
        </div>
    </div>
 </section>