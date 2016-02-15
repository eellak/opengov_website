<?php
ini_set('display_errors',1); 
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/opengov_error_log.txt');
error_reporting(E_ALL^E_NOTICE^E_STRICT);

// Names and stuff
define('URL',get_bloginfo('url'));
define('NAME',get_bloginfo('name'));
define('DESCRIPTION',get_bloginfo('description'));

// Define folder constants
define('ROOT', get_bloginfo('template_url'));
define('JS', ROOT . '/js');
define('IMG', ROOT . '/img');
define('CSS', ROOT . '/css');

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) ); 
add_post_type_support('page', 'excerpt');
remove_action('wp_head', 'wp_generator'); 
add_filter( 'show_admin_bar', '__return_false' );

add_action( 'after_setup_theme', 'opengov_setup' );
function opengov_setup() {
	register_nav_menu('top-menu', __( 'Top Menu', 'opengov'));
	register_nav_menu('main-menu', __( 'Main Menu', 'opengov'));
	register_nav_menu('footer-menu', __( 'Footer Menu', 'opengov'));
}

add_action( 'wp_enqueue_scripts', 'opengov_scripts' );
function opengov_scripts(){
	
	if( !is_admin()){
		wp_enqueue_script("jquery");

		wp_enqueue_style( 'opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700&subset=latin,greek' );
		wp_enqueue_style( 'bootstrap', CSS.'/bootstrap.min.css' );
		wp_enqueue_style( 'opengov', ROOT.'/style.css' );
		
		wp_enqueue_script( 'bootstrap-js', JS . '/bootstrap.min.js', array( 'jquery' ) , '1.2.0' , true );
		wp_enqueue_script( 'viewport-ie', JS . '/ie10-viewport-bug-workaround.js', array( 'jquery' ) , '1.2.0' , true );
		wp_enqueue_script( 'placeholder', JS . '/jquery.placeholder.min.js', array( 'jquery' ) , '1.2.0' , true );
		wp_enqueue_script( 'custom', JS . '/custom.js', array( 'jquery' ) , '1.2.0' , true );
		
		if(is_page_template('template_submit_idea.php')){
			wp_enqueue_script( 'validator-js', JS . '/validation/jquery.validate.min.js', array( 'jquery' ) , '1.2.0' , true );
			wp_enqueue_script( 'validator-methods-js', JS . '/validation/additional-methods.min.js', array( 'jquery' ) , '1.2.0' , true );
			wp_enqueue_script( 'submit-validator-js', JS . '/idea.validate.js', array( 'jquery' ) , '1.2.0' , true );
		}
		
	}
}

add_action( 'init', 'opengov_post_types' );
function opengov_post_types() {

  $args = array(
		'labels'             => array(
								'name' => __('Ideas', 'opengov'),
								'singular_name' => __('Idea', 'opengov'),
							  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'idea', 'with_front' => false,  ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments'  )
	);

	register_post_type( 'idea', $args );
	register_taxonomy( 'idea_cat', 'idea', array( 'hierarchical' => true, 'label' => __('Category', 'opengov'), 'query_var' => true, 'rewrite' => true ));
	
	$args = array(
		'labels'             => array(
								'name' => __('Glossary', 'opengov'),
								'singular_name' => __('Glossary', 'opengov'),
							  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'glossary', 'with_front' => false,  ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' )
	);

	register_post_type( 'glossary', $args );
	register_taxonomy( 'glossary_cat', 'glossary', array( 'hierarchical' => true, 'label' => __('Category', 'opengov'), 'query_var' => true, 'rewrite' => false ));
}

add_filter( 'manage_edit-post_columns', 'opengov_columns_filter',10, 1 );
function opengov_columns_filter( $columns ) {
   unset($columns['ratings']);
   return $columns;
}

add_action( 'widgets_init', 'opengov_widgets_init' );
function opengov_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Top Sidebar', 'opengov' ),
        'id' => 'sidebar-top',
        'description' => __( 'Widgets in this area will be shown on all posts and pages on the top area of sidebar.', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Bottom Sidebar', 'opengov' ),
        'id' => 'sidebar-bottom',
        'description' => __( 'Widgets in this area will be shown on all posts and pages on the bottom area of sidebar.', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Dataset Sidebar', 'opengov' ),
        'id' => 'sidebar-dataset',
        'description' => __( 'Widgets in this area will be shown on datasets.', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Page Sidebar', 'opengov' ),
        'id' => 'sidebar-page',
        'description' => __( 'Widgets in this area will be shown on single pages only.', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Single Sidebar', 'opengov' ),
        'id' => 'sidebar-single',
        'description' => __( 'Widgets in this area will be shown on single posts only.', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Ideas Sidebar', 'opengov' ),
        'id' => 'sidebar-ideas',
        'description' => __( 'Widgets in this area will be shown on single ideas only.', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Archives Sidebar', 'opengov' ),
        'id' => 'sidebar-archives',
        'description' => __( 'Widgets in this area will be shown on archived pagesonly.', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer Left Sidebar', 'opengov' ),
        'id' => 'footer-left',
        'description' => __( 'Footer Left area', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	register_sidebar( array(
        'name' => __( 'Footer Center Sidebar', 'opengov' ),
        'id' => 'footer-center',
        'description' => __( 'Footer Center area', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	register_sidebar( array(
        'name' => __( 'Footer Right Sidebar', 'opengov' ),
        'id' => 'footer-right',
        'description' => __( 'Footer Right area', 'opengov' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer Credits Text', 'opengov' ),
        'id' => 'footer-credits',
        'description' => __( 'Please use only a TEXT HTML widget!', 'opengov' ),
        'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
    ) );
		
}

require_once("lib/Tax-meta-class/Tax-meta-class.php");
if (is_admin()){
	
	//examples: https://github.com/bainternet/Tax-Meta-Class/blob/master/class-usage-demo.php
	
	$config = array(
		'id' => 'opengov_meta_box',         // meta box id, unique per meta box
		'title' => 'OpenGov Meta Box',      // meta box title
		'pages' => array('idea_cat'),       // taxonomy name, accept categories, post_tag and custom taxonomies
		'context' => 'normal',            	// where the meta box appear: normal (default), advanced, side; optional
		'fields' => array(),            	// list of meta fields (can be added by field arrays)
		'local_images' => true,          	// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true 			
	);
  
	$opengov_cat_meta =  new Tax_Meta_Class($config);
	
	$opengov_cat_meta->addCheckbox('opengov_is_active', array('name'=> __('Is Active Call','tax-meta')));
	$opengov_cat_meta->addDate('opengov_close_date', array('name'=> __('Open Until','tax-meta')));
	$opengov_cat_meta->addWysiwyg('opengov_short_descr',array('name'=> __('Short Description','tax-meta')));
	 
	$opengov_cat_meta->Finish();
}

function insert_attachment($file_handler, $post_id, $meta_name) {

  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
  
  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');
  
  $attach_id = media_handle_upload( $file_handler, $post_id );
  $attach_url = wp_get_attachment_url( $attach_id );
  
  update_post_meta($post_id, $meta_name, $attach_url);
  
}

require_once('lib/wp_bootstrap_navwalker.php');
require_once('lib/wp_bootstrap_comment.php');
?>