<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function dateReverse ($date)
            {
                $dateArray = explode('-',$date);
                $reversed = $dateArray['2'] . "-" . $reversed = $dateArray['1'] . "-" . $reversed = $dateArray['0'];
                return $reversed;
            }
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
            <div class="row">
                <div class="col-md-4">
                    <h1>Dashboard Berita</h1>
                </div>
                <br>
            </div>
            
            <?php if($this->session->flashdata('delete')): ?>
                <br>
                <div class="alert alert-danger">
                     <?php echo $this->session->flashdata('delete'); ?>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('news')): ?>
                <br>
                <div class="alert alert-success">
                     <?php echo $this->session->flashdata('news'); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <br>
                    <a href="<?php echo base_url(); ?>admin/news/new"><button type="button" class="btn btn-success"><h4>Buat Berita Baru</h4></button></a>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <?php foreach ($news as $article): ?>
                        <div class="article">
                            <h3><?php echo $article->title; ?></h3>
                            <p><?php echo dateReverse($article->created); ?></p>
                            <p align="justify"><?php echo $article->content; ?></p>
                            <a href="<?php echo base_url('admin/news/delete/' . $article->id); ?>">Delete</a>
                            <a href="<?php echo base_url('admin/news/edit/' . $article->id); ?>">Edit</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
 </section>