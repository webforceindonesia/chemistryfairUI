<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function dateReverse ($date)
            {
                $dateArray = explode('-',$date);
                $reversed = $dateArray['2'] . "-" . $reversed = $dateArray['1'] . "-" . $reversed = $dateArray['0'];
                return $reversed;
            }
?>

<style>
    .image
    {
        width:100%;
        margin-top: -50px;
    }

    .image img
    {
        max-height: 400px;
    }

    .news
    {
        padding:2em;
    }
</style>

<section id="contentAll">
	<div id="aboutUs">
			<div class="col-md-12 brita">
                <div class="image">
                    <?php if($image): ?>
                        <p align="center"><img src="<?php echo base_url() . $image; ?>"></p> 
                    <?php endif; ?>
                </div>
                <div class="news">
                    <h1><?php echo $news_title; ?></h1>
                    <h5><?php echo dateReverse($news_created); ?></h5>
                    <p align="justify">
                    	<?php echo $news_content; ?>
                   	</p>	
                </div>   	
            </div>
        </div>
 </section>