<?php 
	/*
	Template Name: Home V2
	*/
	
	get_header(); ?>
	
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	
	<div class="jumbotron">
      <div class="container"> 
		<div class="col-md-3"> </div>
		<div class="col-md-6 caller">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<a href="<?php echo get_field('main_call_to_action_link'); ?>" class="calltoaction">Δείτε το Στρατηγικό Σχέδιο</a>
			<a href="http://guest3.ellak.gr/cons/?p=19" class="calltodeliberation" target="_blank">
				ή συμμετέχετε στη διαβούλευση για τους Στόχους του στρατηγικού-επιχειρησιακού σχεδίου
			</a>
		</div>
		<div class="col-md-3"> </div>
      </div>
    </div>
	
	<div class="container main home">
		<div class="row row-spacer">
			<div class="col-md-12">
			
				<div class="home-intro home-intro-cons">
					<a href="http://guest3.ellak.gr/cons/">
						<div class="iconer"></div>
						<div class="contenter">
							<strong>Δημόσια διαβούλευση</strong><br />
							Έχετε άποψη; Πάρτε μέρος!
							<span class="home-intro-more"></span>
						</div>
					</a>
				</div>
				
				<div class="home-intro home-intro-ideas">
					<a href="<?php echo get_permalink(16); ?>">
						<div class="iconer"></div>
						<div class="contenter">
							<strong>Ιδέες βελτίωσης υπηρεσιών</strong><br />
							Μοιραστείτε μια καλή ιδέα!
							<span class="home-intro-more"></span>
						</div>
					</a>
				</div>
				
				<div class="home-intro home-intro-opendata">
					<a href="<?php echo get_permalink(10); ?>">
						<div class="iconer"></div>
						<div class="contenter">
							<strong>Ανοικτά δεδομένα</strong><br />
							Δείτε τα δημοσιευμένα
							<span class="home-intro-more"></span>
						</div>
					</a>
				</div>
				
				<div class="home-intro home-intro-glossary">
					<a href="<?php echo get_permalink(33); ?>">
						<div class="iconer"></div>
						<div class="contenter">
							<strong>Γλωσσάρι ανοικτής διακυβέρνησης</strong><br />
							Μάθετε τις βασικές έννοιες!
							<span class="home-intro-more"></span>
						</div>
					</a>
				</div>
				
				<div class="home-intro home-intro-contact">
					<a href="<?php echo get_permalink(42); ?>">
						<div class="iconer"></div>
						<div class="contenter">
							<strong>Newsletter</strong><br />
							Θέλετε ενημέρωση; Εγγραφείτε εδώ!
							<span class="home-intro-more"></span>
						</div>
					</a>
				</div>

			</div>
			
		</div>
	</div>

<?php endwhile; endif; ?>		

<?php  get_footer(); ?>