<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
	<div id="aboutUs">
		<div class="container">
			<div class="col-md-5">
            <div class="form">
 				<?php echo form_open ('fairui/form_input') ?>
                	Title : <input type="text" name="title"><br>
                    Content : <textarea name="content"></textarea><br>
                    <input type="submit">
                </form>
            </div>   	
            </div>
        </div>
    </div>
 </section>