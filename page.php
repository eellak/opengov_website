<?php get_header(); ?>
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
		<div class="col-md-8">
			<div class="col-md-12 white content">
				<?php the_content(); ?>
			</div>
			<div class="col-md-12">
				<?php comments_template(); ?>
			</div>
		</div>
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>
	</div>
	
<?php endwhile; else: include('lib/error.php'); endif; ?>	
<?php get_footer(); ?>