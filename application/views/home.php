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
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/timeline.css"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/js/jquery.slides.min.js"></script>
<section id="contentAll">
	<div id="home">
		<div class="container">
			<div id="slider">
            	<div id="slides">
			      <img src="<?php echo base_url() ?>images/slider/Slide-1.JPG">
			      <img src="<?php echo base_url() ?>images/slider/Slide-2.JPG">
			      <img src="<?php echo base_url() ?>images/slider/Slide-3.JPG">
			      <img src="<?php echo base_url() ?>images/slider/Slide-4.JPG">
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
                        <section class = "timeline" id="timeline">
                            <ul>
                                <li>
                                    <div>
                                    <time><span class ="tanggal">1-18</span><br><span class ="bulan">AGUSTUS - SEPTEMBER</span><BR><span class ="tahun">2016</span></time>
                                    <span class = "timelinedesc">Pendaftaran dan pengiriman Abstrak</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                    <time><span class ="tanggal">26</span><br><span class ="bulan">SEPTEMBER</span><BR><span class ="tahun">2016</span></time>
                                    <span class = "timelinedesc">Pengumuman lolos Abstrak</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                    <time><span class ="tanggal">27-17</span><br><span class ="bulan">OKTOBER</span><BR><span class ="tahun">2016</span></time>
                                    <span class = "timelinedesc">Pembayaran biaya registrasi ulang dan pengiriman makalah</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                    <time><span class ="tanggal">24</span><br><span class ="bulan">OKTOBER</span><BR><span class ="tahun">2016</span></time>
                                    <span class = "timelinedesc">Pengumuman lolos makalah (8 terbaik tingkat SMA/sederajat dan 8 terbaik tingkat Perguruan Tinggi)</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                    <time><span class ="tanggal">12</span><br><span class ="bulan">NOVEMBER</span><BR><span class ="tahun">2016</span></time>
                                    <span class = "timelinedesc">Presentasi final</span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                    <time><span class ="tanggal">13</span><br><span class ="bulan">NOVEMBER</span><BR><span class ="tahun">2016</span></time>
                                    <span class = "timelinedesc">Pameran poster dan prototype</span>
                                    </div>
                                </li>
                            </ul>
                        </section>
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

    function isElementInViewport(el) {
      var rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    }


    var items = document.querySelectorAll(".timeline li");
     
    // code for the isElementInViewport function
     
    function callbackFunc() {
      for (var i = 0; i < items.length; i++) {
        if (isElementInViewport(items[i])) {
          items[i].classList.add("in-view");
        }

      }
    }
     
    window.addEventListener("load", callbackFunc);
    window.addEventListener("scroll", callbackFunc);
</script>