<?php 
	
	class Constantes {
		
		function __construct() {
			$this -> constantes();
		}
		
		public function constantes() {

			$urlsite = get_bloginfo('url') . '/';
			// Constantes
			define('THEMENAME', get_stylesheet());   // Pasta do tema
			define('WP_NAME', get_bloginfo('name')); // nome do site
			define('SITEURL', $urlsite);	
			define('TEMPLATEURL', SITEURL . 'wp-content/themes/' . THEMENAME); 				  // template url
			define('ASSETSURL' , TEMPLATEURL . '/assets'); 		  // style do template
			//Desativa Revisão
			define('WP_POST_REVISIONS', false );

			
		}
		
	}
	
	new Constantes();
	
?>