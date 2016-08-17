<?php

/**
 * Plugin Name: Lougin
 * Plugin URI: http://www.matheusloureiro.com.br
 * Description: Esse projeto é um conjunto de ferramentas para desenvolvedores WordPress. Ele contém as mais variadas funções para customização do projeto.
 * Version: 0.0.1
 * Author: Matheus Loureiro
 * Author URI: http://www.matheusloureiro.com.br
 */
 
 if(!class_exists('Loureiro')) :
 
 	if(!class_exists('LG')) :

		include_once dirname(__FILE__).'/lou/class/loureiro.class.php';

	endif;

	if(!class_exists('Filters_Personaliza')) :

		include_once dirname(__FILE__).'/lou/class/filters.class.php';

	endif;

	if(!class_exists('Constantes')) :

		include_once dirname(__FILE__).'/lou/class/constantes.class.php';

	endif;

	if(!class_exists('Actions_Personaliza')) :

		include_once dirname(__FILE__).'/lou/class/action.class.php';

	endif;
 
 	class Loureiro {
 	
 		var $config;

 		public function __construct() {
 			
 			$this->config = array (
 				'wp_mu' =>  WPMU_PLUGIN_DIR,
 				'wp_plu' => WP_PLUGIN_DIR
 			);
 			
 			//Logo
 			add_action( 'login_head', array($this,'logincssLoureiro') );
 			
 			// Customizar a Área de Administração do wordpress
			add_action('admin_head', array($this,'admin_theme'));
 			
 		}
 		
 		public function url_procura() {

 			$url1 = $this->config['wp_mu'] . '/loureiro.php';
 			$url2 = $this->config['wp_plu'] . '/lougin/loureiro.php';
 		
 			if (file_exists($url1)) {
 				$dir = WPMU_PLUGIN_URL . '/lou';
 			}
 			
 			if (file_exists($url2)) {
 				$dir = WP_PLUGIN_URL . '/lougin/lou';
 			}
 			
 			return $dir;

 		}
 		
		// public function logincssLoureiro() {
			
		// 	$url = $this->url_procura();
			
		// 	echo '<link media="all" type="text/css" href="'.$url.'/css/login.css" rel="stylesheet">';
		// }
		
		function admin_theme() { 
		echo '<style type="text/css">
			#header-logo { background:#000; }
			#wphead h1{font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif; color:#000 !important;}
			html{background-color: #fff;}
	 
		</style>';
		}

	}
	
	function Loureiro() {
	
		global $lou;
	
		if( !isset($lou) ) {
			$lou = new Loureiro();
		}
	
		return $lou;
	}
	
	Loureiro();

endif;
	