<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
   <div class="container">
        	<?php if($this->session->flashdata('success'))
        	{?>

        		<div class="alert alert-success">
					<?php echo $this->session->flashdata('success') ?>
				</div>

        	<?php }else if($this->session->flashdata('errors'))
        	{ ?>

        		<div class="alert alert-danger">
					<?php echo $this->session->flashdata('errors') ?>
				</div>

        	<?php } ?>
   </div>
</section>