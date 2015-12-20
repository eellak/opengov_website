	<div class="footspace">
		<div class="container"> 
			<?php /*
			<div class="col-md-4">
				<?php dynamic_sidebar( 'footer-left' ); ?>
			</div>
			<div class="col-md-4">
				<?php dynamic_sidebar( 'footer-center' ); ?>
			</div>
			<div class="col-md-4">
				<?php dynamic_sidebar( 'footer-right' ); ?>
			</div>
			*/ ?>
			<div class="col-md-12 text-center credits">
				<?php dynamic_sidebar( 'footer-credits' ); ?>
			</div>
		</div>
	</div>
	
	</section>
	
	<footer>
		<div class="container">
			<div class="col-md-4">
				<?php echo NAME; ?><br />
				<a href="<?php echo URL; ?>" title="<?php echo DESCRIPTION; ?>"><?php echo DESCRIPTION; ?></a>
			</div>
			<div class="col-md-4 text-center">
				<a href="<?php echo get_permalink(95); ?>">Όροι Χρήσης</a><br />
				<a href="<?php echo get_permalink(95); ?>">Πολιτική Προστασίας Προσωπικών Δεδομένων</a>
			</div>
			<div class="col-md-4 text-right">
				Mε χρήση του <a href="http://mathe.ellak.gr" target="_blank" title="ΕΛ/ΛΑΚ">ΕΛ/ΛΑΚ</a> 
				<a href="http://wordpress.org" target="_blank" title="Wordpress.org">Wordpress</a>.<br />
				Άδεια <a href="http://creativecommons.org/licenses/by/3.0/gr/" target="_blank" title="Creative Commons Licence">Creative Commons</a>.
				<a href="http://creativecommons.org/licenses/by/3.0/gr/" target="_blank" title="Creative Commons Licence">
					<img src="<?php echo IMG; ?>/cc.png" title="Creative Commons Licence" alt="Creative Commons Licence" />
				</a>
			</div>
		</div>
	</footer>
	<div class="ribbon-wrapper"><div class="ribbon">BETA</div></div>
	<?php wp_footer(); ?>
</body>
</html>
