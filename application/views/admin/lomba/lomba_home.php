<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
<div class="container">
        <div class="row">
        	<div class="col-md-12">
        	<?php if($this->session->flashdata('success'))
        	{?>
        		<div class="alert alert-success">
					<?php echo $this->session->flashdata('success') ?>
				</div>
        	<?php } ?>
        		<h1 class='content-title-container'>Daftar Pendaftar Chemistry Fair 2016</h1>
		        <div class="content-subdirectory-container col-md-12">
		            <a href="<?php echo site_url('admin/lomba/cc'); ?>"  class="content-title-container col-md-12">
		                <div class="hexagon col-md-1">
		                    <span>
		                    Nov <p>12</p>
		                    </span>
		                </div>
		                <h1 class="content-title col-md-8">Chemistry Competition</h1>
		            </a>
		        </div>
		        <div class="content-subdirectory-container col-md-12">
		            <a href="<?php echo site_url('admin/lomba/cfk'); ?>"  class="content-title-container col-md-12">
		                <div class="hexagon col-md-1">
		                    <span>
		                    Nov <p>19</p>
		                    </span>
		                </div>
		                <h1 class="content-title col-md-8">Chemistry Fair Kids</h1>
		            </a>
		        </div>
		        <div class="content-subdirectory-container col-md-12">
		            <a href="<?php echo site_url('admin/lomba/cip'); ?>"  class="content-title-container col-md-12">
		                <div class="hexagon col-md-1">
		                    <span>
		                    Nov <p>12</p>
		                    </span>
		                </div>
		                <h1 class="content-title col-md-8">Chemistry Innovation Project</h1>
		            </a>
		        </div>
		        <div class="content-subdirectory-container col-md-12">
		            <a href="<?php echo site_url('admin/lomba/cp'); ?>"  class="content-title-container col-md-12">
		                <div class="hexagon col-md-1">
		                    <span>
		                    Nov <p>12</p>
		                    </span>
		                </div>
		                <h1 class="content-title col-md-8">Chemistry Photograph Competition</h1>
		            </a>
		        </div>
		        <div class="content-subdirectory-container col-md-12">
		            <a href="<?php echo site_url('admin/lomba/cmp'); ?>"  class="content-title-container col-md-12">
		                <div class="hexagon col-md-1">
		                    <span>
		                    Nov <p>12</p>
		                    </span>
		                </div>
		                <h1 class="content-title col-md-8">Chemistry Movie Project</h1>
		            </a>
		        </div>
        	</div>
        </div>
  </div>
</section>