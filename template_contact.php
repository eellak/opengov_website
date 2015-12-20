<?php 
	/*
	Template Name: Contact
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
	
	<div class="container main contacter">
		<div class="col-md-6 white content archive">
			<h5 class="text-right">Τελευταίες Ανακοινώσεις</h5>
			<?php 
				query_posts(array('posts_per_page' => 4, 'post_type' => 'post'));
				if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="arch-item">
					<h4><?php the_title(); ?></h4>
					
					<div class="arch-content">
						<?php the_content(''); ?>
					</div>
					
					<div class="arch-meta">
						Δημοσιεύθηκε: <?php the_date() ?>
					</div>
					<a class="more" href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">Διαβάστε περισσότερα &raquo;</a>
				</div>
			<?php endwhile; endif; wp_reset_query(); ?>
		</div>
		<div class="col-md-1 hidden-sm"></div>
		<div class="col-md-5 formland">
			<?php $content = explode('<!--more-->', $post->post_content); ?>
			<div class="white content">
				<?php echo apply_filters('the_content', $content[1]); ?>
			</div>
			<div class="white content">
				<?php echo apply_filters('the_content', $content[0]); ?>
			</div>
		</div>
	</div>
	
<?php endwhile; else: include('lib/error.php'); endif; ?>	
<?php get_footer(); ?>