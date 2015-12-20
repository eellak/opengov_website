<?php 
	/*
	Template Name: Submit Idea
	*/
	
	$success = false;
	$cp_message = '';
	
	if(isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
		
		$title = sanitize_text_field($_POST['title']);
		$description = $_POST['description']; 	
		
		$idea = array(
			'post_title'	=> $title,
			'post_content'	=> $description,		
			'post_status'	=> 'draft', 
			'post_type'		=> 'idea', 	
		);
		
		$idea_id = wp_insert_post($idea);
		
		if($idea_id){
		
			wp_set_object_terms($idea_id,	array(intval($_POST['idea_cat'])),	'idea_cat');
		
			update_post_meta( $idea_id, 'user_name', 		sanitize_text_field( $_POST['uname'] ) );
			update_post_meta( $idea_id, 'user_surname', 	sanitize_text_field( $_POST['usurname'] ) );
			update_post_meta( $idea_id, 'user_tel', 		sanitize_text_field( $_POST['utel'] ) );
			update_post_meta( $idea_id, 'user_email', 		sanitize_text_field( $_POST['uemail'] ) );
		
			$cp_message = '<div class="alert alert-success" role="alert"><p>H καταχώρησή σας ήταν επιτυχής. Σύντομα η ιδέα σας θα δημοσιευθεί απο έναν διαχειριστή!</p></div';
			$success = true;
			
		} else {
			$cp_message = '<div class="alert alert-danger" role="alert"><p>Παρουσιάστηκε πρόβλημα και η καταχώρησή Δεν ήταν επιτυχής.</p></div';
		}
	} 
	
	get_header(); 
?>
	
<?php if(have_posts()): while(have_posts()): the_post(); ?>

	<div class="container title toptitle ideatitle">
		<div class="col-md-12">
			<h1>
				<span><a href="<?php echo get_permalink(46); ?>">Ιδέες</a></span>
				<?php the_title(); ?>
			</h1>
			<a class="submit-idea" href="<?php echo get_permalink(46); ?>">
				Δείτε όλες τις Ιδέες!
			</a>
		</div>
	</div>
	
	<div class="container main">
		<div class="col-md-12 white content glossary">
			<?php the_content(); ?>
			<?php if($cp_message!='') echo $cp_message; ?>
			<?php /*if($success){ ?>
			
			<?php } else { */ ?>
				<form action="<?php the_permalink(); ?>" method="post">
					
					<div class="col-md-6">
					
						<div class="form-group">
							<label for="title">Τίτλος</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Τίτλος της Ιδέας">
						</div>
						
						<div class="form-group">
							<label for="ideacat">Κατηγορία Ιδέας</label>
							<?php 
								$thema = wp_dropdown_categories( 'show_option_none=&tab_index=4&taxonomy=idea_cat&hide_empty=0&echo=0' ); 
								$thema = str_replace('cat','idea_cat', $thema );
								$thema = str_replace('postform','form-control', $thema );
								echo $thema;
							?>
						</div>
						
						<div class="form-group">
							<label for="uname">Όνομα</label>
							<input type="text" class="form-control" id="uname" name="uname" placeholder="Το Όνομά σας">
						</div>
						
						<div class="form-group">
							<label for="usurname">Επίθετο</label>
							<input type="text" class="form-control" id="usurname" name="usurname" placeholder="Το Επίθετό σας">
						</div>
						
						<div class="form-group">
							<label for="uemail">Διεύθυνση eMail</label>
							<input type="email" class="form-control" id="uemail" name="uemail" placeholder="Η διεύθυνση ηλ ταχυδρομείου σας!">
						</div>
						<?php /*
						<div class="form-group">
							<label for="utel">Τηλέφωνο</label>
							<input type="text" class="form-control" id="utel" name="utel" placeholder="Το Τηλέφωνό σας">
						</div>
						*/ ?>

					</div>
					
					<div class="col-md-6">
						
						<div class="form-group">
							<label for="description">Σύντομη Περιγραφή της Ιδέας</label>
							<textarea class="form-control" id="description" name="description" rows="13"></textarea>
						</div>
						
						<div class="form-group text-center">
							<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
							<button type="submit"  id="go_submit" class="btn btn-primary">Υποβάλλετε την Ιδέα σας</button>
						</div>
						
					</div>
					
				</form>
			<?php /* } */ ?>
		</div>
	</div>
	<?php wp_reset_query(); ?>
	
<?php endwhile; else: include('lib/error.php'); endif; ?>	
<?php get_footer(); ?>