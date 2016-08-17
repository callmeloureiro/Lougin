<?php 
	
	class Actions_Personaliza {
		
		function __construct() {
		
			// Desativar JQUERY
			if ( !is_admin() ) wp_deregister_script('jquery');

			//CSS Thumbnail
			add_action('admin_head', array(__CLASS__,'my_custom_fonts'));
			//fim CSS Thumbnail
			
			// THUMBNAIL
			add_action('manage_posts_custom_column', array(__CLASS__,'tcb_display_post_thumbnail_column'), 5, 2);
			add_action('manage_pages_custom_column', array(__CLASS__,'tcb_display_post_thumbnail_column'), 5, 2);
			//Fim Thumbnail
			
			//Ocultar Ajuda
			add_action('admin_head', array(__CLASS__,'hide_help'));
			//FIM Ocultar Ajuda
			
			//Campo Exerpt na Page
			add_action('init', array( __CLASS__, 'add_page_excerpts'));

			//Remove Post Format
			add_action('after_setup_theme', array( __CLASS__, 'wpse65653_remove_formats'), 100);
			
			//Thumbnail
			add_theme_support('post-thumbnails');
			
			//Menu
			add_theme_support('menus');
			
			// Removendo os box desnecessarios na edicao
			add_action('admin_menu',array( __CLASS__,'remove_default_page_screen_metaboxes'));
			
			// Limpando o Dashboard
			add_action('wp_dashboard_setup', array( __CLASS__,'remove_dashboard_widgets'));
			
			//Limpar Cookie da sessão com Senha
			add_action( 'init', array($this,clear_post_cookie) );
		}

		function wpse65653_remove_formats()
		{
		   remove_theme_support('post-formats');
		}
		
		//Limpar Cookie da sessão com Senha
		function clear_post_cookie()
		{
		//setcookie( 'wp-postpass_' . COOKIEHASH, $_COOKIE[ 'wp-postpass_' . COOKIEHASH ], time(), COOKIEPATH );
		}
		
		
			// Limpando o Dashboard
		function remove_dashboard_widgets() {
			global $wp_meta_boxes;
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
			}

			// Removendo os box desnecessarios na edicao
		function remove_default_page_screen_metaboxes() {
	
			//page

			remove_meta_box('commentstatusdiv','page','normal'); // Comment Status
		   // remove_meta_box('postexcerpt','page','normal');  // Excerpt
			remove_meta_box('authordiv','page','normal'); // Author
			remove_meta_box('commentsdiv','page','normal'); // Comments
			remove_meta_box('trackbacksdiv','page','normal'); // Trackbacks
		   // remove_meta_box('postcustom','page','normal'); // Custom Fields
			remove_meta_box('slugdiv','page','normal'); // Slug
			remove_meta_box('revisionsdiv','page','normal'); // Revisions
		   // remove_meta_box('postimagediv','page','side'); // Featured Image
		   // remove_meta_box('pageparentdiv','page','side');  Page Parent etc.
	
			//post
	
			remove_meta_box('commentstatusdiv','post','normal'); // Comment Status
			// remove_meta_box('postexcerpt','post','normal'); // Excerpt
			remove_meta_box('authordiv','post','normal'); // Author
			remove_meta_box('commentsdiv','post','normal'); // Comments
			remove_meta_box('trackbacksdiv','post','normal'); // Trackbacks
			//remove_meta_box('postcustom','post','normal'); // Custom Fields
			remove_meta_box('slugdiv','post','normal'); // Slug
			remove_meta_box('revisionsdiv','post','normal'); // Revisions
			//remove_meta_box('postimagediv','post','side'); // Featured Image
			//remove_meta_box('categorydiv','post','side'); // Categories
		  //  remove_meta_box('tagsdiv-post_tag','post','side'); // Tags
		}
 
		// MOSTRAR THUMBNAIL NOS POSTS
		public function tcb_display_post_thumbnail_column($col, $id){
		  switch($col){
			case 'tcb_post_thumb':
			  if( function_exists('the_post_thumbnail') )
				echo the_post_thumbnail( 'admin-list-thumb' );
			  else
				echo 'Not supported in theme';
			  break;
		  }
		}
		
		public function my_custom_fonts() {
		  echo '<style>
			.tcb_post_thumb img {
				width:150px;
				height:auto;
				}
			} 
		  </style>';
		}
		// FIM MOSTRAR THUMBNAIL NOS POSTS
		
		//Ocultar Ajuda
		function hide_help() {
			echo '<style type="text/css">
					#contextual-help-link-wrap { display: none !important; }
				  </style>';
		}
		//Fim Ocultar Ajuda
		
		// Adicionar o Campo Excerpt na Page
		function add_page_excerpts() 
		{        
			add_post_type_support( 'page', 'excerpt' );
		}

	}
	
	new Actions_Personaliza();
	
?>