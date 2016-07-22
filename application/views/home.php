<?php
defined('BASEPATH') OR exit('No direct script access allowed');

		function custom_echo($x, $length)
			{
			  if(strlen($x)<=$length)
			  {
			    echo $x;
			  }
			  else
			  {
			    $y=substr($x,0,$length) . '...';
			    echo $y;
			  }
 			}
?>
<script type="text/javascript" src="<?php echo base_url() ?>/js/jquery.slides.min.js"></script>
<section id="contentAll">
	<div id="home">
		<div class="container">
			<div id="slider">
            	<div id="slides">
			      <img src="<?php echo base_url() ?>images/example-slide-1.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
			      <img src="<?php echo base_url() ?>images/example-slide-2.jpg" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
			      <img src="<?php echo base_url() ?>images/example-slide-3.jpg" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
			      <img src="<?php echo base_url() ?>images/example-slide-4.jpg" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
			    </div>
            </div>
            <div class="row" id="homePage">
            	<div class="col-md-6">
                	<h1><i>Berita</i></h1>
                    <div id="berita">
                    <?php
					$i=0;
					foreach ($news_title as $count)
					{
						?>
                    	<div class="oneBerita">
                        	<a href="<?php echo base_url("berita/view?id=$news_id[$i]"); ?>"><h2><?php echo $news_title[$i] ?></h2></a>
                            <p><?php echo $news_created[$i] ?></p>
                            <p><?php custom_echo($news_content[$i], 50) ?></p>
                        </div>
                    <?php 
						$i++;
					}
					?>
                    </div>
                </div>
            	<div class="col-md-6">
                	<h1><i>Timeline</i></h1>
                	<div id="timeline">


                	</div>
                </div>
            </div>
        </div>
    </div>
 </section>
 <script>
    $(function() {
      $('#slides').slidesjs({
        width: 940,
        height: 328,
        navigation: {
          active:false,
          effect: "fade"
        },
        pagination: {
          active:false,
          effect: "fade"
        }, 
        play: 	{
        	effect:"fade",
        	auto:true,
        	interval:5000
        },
        effect: {
          fade: {
            speed: 400
          }
        }
      });
    });
  </script>