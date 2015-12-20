<?php 
	/*
	Template Name: Fullwidth
	*/
	
	get_header(); ?>
	
<?php if(have_posts()): while(have_posts()): the_post(); ?>

	<div class="container title toptitle postitle">
		<div class="col-md-12">
			<h1>
				<span><a href="<?php echo URL; ?>">Επιστροφή</a></span>
				<?php the_title(); ?>
			</h1>
		</div>
	</div>
	
	<div class="container main">
		<div class="col-md-12 white content glossary">
			<?php the_content(); ?>
		</div>
	</div>
	
<?php endwhile; else: include('lib/error.php'); endif; ?>	
<?php get_footer(); ?>