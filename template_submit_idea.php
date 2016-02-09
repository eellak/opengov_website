<?php 
	/*
	Template Name: Submit Idea
	*/
	
	$success = false;
	$cp_message = '';
	
	$call = 0;
	$call_name = '';
	if(isset($_GET['call']) and intval(trim($_GET['call'])) > 0){
		$call = intval(trim($_GET['call']));
		$current_call = get_term_by( 'id', $call , 'idea_cat' );
		if(empty($current_call)){ 
			$call = 0;
		}else{
			$call_name = $current_call->name;
			$close_date = get_tax_meta($current_call->term_id, 'opengov_close_date');
			$is_active = get_tax_meta($current_call->term_id, 'opengov_is_active'); 
				if(!$is_active ) $call = 0;
		}
	}
	
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
			
			if ($_FILES) {
				foreach ($_FILES as $file => $array) {
					if(!empty($file))
						insert_attachment($file, $idea_id, 'idea_file');
				}
			};
			
		
			update_post_meta( $idea_id, 'user_name', 		sanitize_text_field( $_POST['uname'] ) );
			update_post_meta( $idea_id, 'user_surname', 	sanitize_text_field( $_POST['usurname'] ) );
			//update_post_meta( $idea_id, 'user_tel', 		sanitize_text_field( $_POST['utel'] ) );
			update_post_meta( $idea_id, 'user_email', 		sanitize_text_field( $_POST['uemail'] ) );
		
			$cp_message = '<div class="alert alert-success" role="alert"><p>H καταχώρησή σας ήταν επιτυχής. Σύντομα η ιδέα σας θα δημοσιευθεί απο έναν διαχειριστή!</p></div>';
			$success = true;
			
		} else {
			$cp_message = '<div class="alert alert-danger" role="alert"><p>Παρουσιάστηκε πρόβλημα και η καταχώρησή Δεν ήταν επιτυχής.</p></div>';
		}
	} 
	
	get_header(); 
	
	$submit_link = get_the_permalink();
	if($call != 0){
		$submit_link .='/?call='.$call;
	}
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
			<?php
				if($call != 0){
					echo apply_filters('the_content', $current_call ->description );
					echo '<p style="margin:30px 0px; text-align:right;"><strong>Υποβολή Ιδεών έως: '.date('d/m/Y', strtotime($close_date)).'</strong></p>';
				}else{
					the_content();
				}
				
				if($success){ 
					echo $cp_message;
				} else { 
					if($cp_message!='') echo $cp_message;
			?>
				<form action="<?php echo $submit_link; ?>" id="submit-idea-form" enctype='multipart/form-data' method="post">
					
					<div class="col-md-6">
					
						<div class="form-group">
							<label for="title">Τίτλος</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Τίτλος της Ιδέας">
						</div>
						
						<div class="form-group">
							<label for="ideacat">Κύκλος Υποβολής</label>
							<?php 
								if($call != 0){
									echo '<input type="text" class="form-control" id="idea_cat" name="idea_cat_dummy" value="'.$call_name.'" disabled="disabled" />';
									echo '<input type="hidden" id="title" name="idea_cat" value="'.$call.'" />';
								}else{
									echo '<select name="idea_cat" id="idea_cat" class="form-control" tabindex="4"> ';
									$catz = get_terms( 'idea_cat', array( 'hide_empty' => false ) );
									foreach($catz as $cat){
										$is_active = get_tax_meta($cat->term_id, 'opengov_is_active');
										if($is_active){
											$selected = '';
											if($call != 0 and $cat->term_id == $call) $selected = 'selected="selected"';
											echo '<option class="level-0" value="'.$cat->term_id.'" '.$selected.'>'.$cat->name.'</option>';
										}
									}
									echo '</select>';
								}
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
						
						<div class="form-group">
							<label for="description">Συνοδευτικό Αρχείο (pdf, ppt, doc, pptx, docx, odt)</label>
							<input type="file" name="ideafile" size="40">
						</div>
						
						
						
						<div class="form-group text-center">
							<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
							<button type="submit"  id="go_submit" class="btn btn-primary">Υποβάλλετε την Ιδέα σας</button>
						</div>
						
					</div>
					
				</form>
			<?php   }  ?>
		</div>
	</div>
	<?php wp_reset_query(); ?>
	
<?php endwhile; else: include('lib/error.php'); endif; ?>	
<?php get_footer(); ?>