<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contentAll">
	<div id="home">
		<div class="container">
			<div id="slider">
            	
            </div>
            <div class="row">
            	<div class="col-md-6">
                	<h1>Berita</h1>
                    <div id="berita">
                    <?php
					$i=0;
					foreach ($news_title as $count)
					{
						?>
                    	<div class="oneBerita">
                        	<h2><?php echo $news_title[$i] ?></h2>
                            <p><?php echo $news_created[$i] ?></p>
                        	<p>
                            	<?php echo $news_content[$i] ?>
                            </p>
                        </div>
                    <?php 
					$i++;
					}
					?>
                    </div>
                </div>
            	<div class="col-md-6">
                	<h1>Timeline</h1>
                </div>
            </div>
        </div>
    </div>
 </section>