<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function dateReverse ($date)
            {
                $dateArray = explode('-',$date);
                $reversed = $dateArray['2'] . "-" . $reversed = $dateArray['1'] . "-" . $reversed = $dateArray['0'];
                return $reversed;
            }
?>
<section id="contentAll">
	<div id="aboutUs">
		<div class="container">
			<div class="col-md-5">
                <div class="news">
                    <h1><?php echo $news_title; ?></h1>
                    <h5><?php echo dateReverse($news_created); ?></h5>
                    <p align="justify">
                    	<?php echo $news_content; ?>
                   	</p>	
                </div>   	
            </div>
        </div>
    </div>
 </section>