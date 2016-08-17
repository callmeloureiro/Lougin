<?php

	class Filters_Personaliza {
	  		
	  	function __construct() {
	  	
	  		// Modificar Footer
			add_filter( 'admin_footer_text', array( __CLASS__, 'remove_footer_admin' ) );
			add_filter( 'login_headerurl', array( __CLASS__, 'my_login_logo_url') );
			add_filter( 'login_headertitle', array( __CLASS__, 'my_login_logo_url_title') );

			// Thumbnail Filter
			add_filter('manage_posts_columns', array( __CLASS__, 'tcb_add_post_thumbnail_column'), 5);
			add_filter('manage_posts_columns', array( __CLASS__, 'tcb_add_post_thumbnail_column'), 5);
			
			// Altera informações da página protegida por senha
			add_filter('the_title',array( __CLASS__,'alterar_titulo'));
			
			// Remover 'Favorite Actions' do Admin Header
			add_filter('favorite_actions', array(__CLASS__,'remove_admin_fav_actions'));
			
			//Corrigir Listagem de tags
			add_filter('request', array(__CLASS__,'post_type_tags_fix'));
			
			// Desativar o WP Frontend Admin Bar
			add_filter( 'show_admin_bar','__return_false' );
			
			// Remover instruções desnecessárias no wp_head
			add_filter('the_generator', array( __CLASS__,'remove_generator'));
			remove_action('wp_head', 'rsd_link');
			remove_action('wp_head', 'wlwmanifest_link');
			//  remove_action('wp_head', 'wp_generator');
		  //  remove_action('wp_head', 'start_post_rel_link');
			//  remove_action('wp_head', 'index_rel_link');
			//  remove_action('wp_head', 'adjacent_posts_rel_link');
			
	  	}
		
		function remove_generator() {
			$author  = '<meta name="author" content="Matheus Loureiro">';
			$author .= '<meta name="code" content="Matheus Loureiro [85 9-8111.2421]">';
			return $author;
		}
	
		function my_login_logo_url() {
    	return 'http://www.websitefortaleza.com.br';
		}
		

		function my_login_logo_url_title() {
    	return 'Website Fortaleza';
		}
		
	  	
	  //Corrigir Listagem de tags
	  function post_type_tags_fix($request) {
			if ( isset($request['tag']) && !isset($request['post_type']) )
				$request['post_type'] = 'any';
				return $request;
		}
	  	
	  	// Remover 'Favorite Actions' do Admin Header
		function remove_admin_fav_actions(){
			return array();
		}

		public function remove_footer_admin () {
		  echo 'Desenvolvido por ';
		  echo "<a href='http://www.matheusloureiro.com.br' target='_blank'>Matheus Loureiro";
		  echo "</a>";
		}

		// Add the column
		function tcb_add_post_thumbnail_column($cols){
		  $cols['tcb_post_thumb'] = __('Imagem Destacada');
		  return $cols;
		}
		
		// Alterar informações da página protegida por senha
		function alterar_titulo($titulo) {
			$titulo = attribute_escape($titulo);
			$keywords = array(
			'#Protegido:#',
			'#Privado:#'
			);
			$substituir = array(
			'O Seu Registro: ', // podes definir se queres branco ou outra palavra, imagem, etc
			'' // O mesmo para quando aparece o texto Private
			);
			$titulo = preg_replace($keywords, $substituir, $titulo);
			return $titulo;
		}
	
	}
	
	new Filters_Personaliza();
	
?>