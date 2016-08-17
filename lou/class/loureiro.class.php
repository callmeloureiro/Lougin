<?php 

	class LG {
	
		public function chama_facebook($url,$width,$height) {
			echo '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F'.$url.'&amp;width='.$width.'&amp;height='.$height.'&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px;" allowTransparency="true"></iframe>';
		}
		
		// Chama Formulário de pesquisa
		
		public function chama_pesquisa() {
			get_search_form();
		}
		
		// Chama Menu
		
		public function chama_menu($nmenu) {
			
			$menu = wp_nav_menu( array('menu' => $nmenu));
			
			return $menu;
			
		}
		
		// Chama Link
		
		public function chama_link() {
			
			$link = the_permalink();
			return $link;
			
		}
		
		// Chama Author
		
		public function chama_autor($argumentos = null) {
			
			$autor = the_author($argumentos);
			
			return $autor;
			
		}
		
		// Chama Data
		
		public function chama_data($argumentos = null) {
			
			$data = the_time($argumentos);
			
			return $data;
			
		}
		
		// Chama Conteúdo
		
		public function chama_conteudo($max_char = 0, $more_link_text = '...',$notagp = false, $stripteaser = 0, $more_file = '') {
			$content = get_the_content($more_link_text, $stripteaser, $more_file);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			$content = strip_tags($content);
			
			if ($max_char == 0) {
				$max_char = the_content();
				$more_link_text = '';
			}
		   if (strlen($_GET['p']) > 0) {
			  if($notagp) {
			  echo substr($content,0,$max_char);
			  }
			  else {
			  echo substr($content,0,$max_char);
			  }
		   }
		   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
				$content = substr($content, 0, $espacio);
				$content = $content;
				if($notagp) {
				echo substr($content,0,$max_char);
				echo $more_link_text;
				}
				else {
				echo substr($content,0,$max_char);
				echo $more_link_text;
				}
		   }
		   else {
			  if($notagp) {
			  echo substr($content,0,$max_char);
			  }
			  else {
			  echo substr($content,0,$max_char);
			  }
		   }
		}
		
		// Chama Conteúdo descrição da categoria
		
		public function chama_conteudo_categoria() {
			echo category_description();
		} 
		
		// Chama Thumbnail
		
		public function chama_thumbnail($size = null) {
			
			if (!isset($size)) {
				$size = 'full';
			}
			$thumb = the_post_thumbnail($size);

			return $thumb;	
		}
		
		public function chama_thumbnail_url() {
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			return $url;
		}
		
		// Chama Título
		
		public function chama_titulo($maximo = 0) {
		
			$title = get_the_title();

			if ($maximo == 0) {
				echo $title;
			}

			if ( strlen($title) >= $maximo ) {
				$continua = '...';
				$title = mb_substr( $title, 0, $maximo, 'UTF-8' );
				echo $title.$continua;
			} else {
				echo $title;
			}
			
		}
		
		// Chama Título da Categoria
		
		public function chama_titulo_categoria() {
			single_cat_title();
		}
		
		//FUNCAO verifica se post é descendente de uma determinada categoria
		function post_is_in_descendant_category( $cats, $_post = null )
		{
			foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, ‘category’);
				if ( $descendants && in_category( $descendants, $_post ) )
					return true;
			}
				return false;
		}
		
		// Chama Título do site
		
		public function titulo_site() {
		
			if ( is_front_page() ) {
				echo WP_NAME;
				echo ' - '; //separador
				bloginfo('description');
				}
				else // nao eh pagina inicial
				{
				if (is_author() || is_404() || is_search() || is_page() || is_single()) {
				if (!is_category()) {
				echo get_the_title();
				}
				if (is_category()) {
				$category = get_the_category();
				echo $category[0]->cat_name;
				}
				$post_ancestors = get_post_ancestors($post->ID);
				$post_ancestors = array_reverse($post_ancestors);
				if ($post_ancestors[0]) {
				$titulo_novo0 = ' « '.get_the_title($post_ancestors[0]);
				}
				if ($post_ancestors[1]) {
				$titulo_novo1 = ' « '.get_the_title($post_ancestors[1]);
				}
				if ($post_ancestors[2]) {
				$titulo_novo2 = ' « '.get_the_title($post_ancestors[2]);
				}
				if ($post_ancestors[3]) {
				$titulo_novo3 = ' « '.get_the_title($post_ancestors[3]);
				}
				if ($post_ancestors[4]) {
				$titulo_novo4 = ' « '.get_the_title($post_ancestors[4]);
				}
				if ($titulo_novo4) {
				echo $titulo_novo4;
				} else {
					if ($titulo_novo3) {
						echo $titulo_novo3;
					} else {
						if ($titulo_novo2) {
							echo $titulo_novo2;
						} else {
							if ($titulo_novo1) {
								echo $titulo_novo1;
							} else {
								if ($titulo_novo0) {
									echo $titulo_novo0;
								}
							}
						}
					}
				}
				}
				if (is_archive()) {
				wp_title( '', true, 'left' );
				}
				if ( is_search() ) {
				_e('Resultado da pesquisa por ->', 'RB');  /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(' '); echo $key; _e(' - '); echo $count . ' ';
				_e('Páginas', 'RB'); wp_reset_query(); } 
				if ( is_404() ) {
				_e('Erro 404 - Página Não Encontrada', 'RB');
				}
				if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
				}
				echo ' | '.WP_NAME;
			}
		
		}
		
		//FUNCAO cactal_breadcrumb
		public function chama_bread() {

			$delimiter = '/';
			$before = '<span class="current">'; // tag before the current crumb
			$after = '</span>'; // tag after the current crumb

			if ( !is_home() && !is_front_page() || is_paged() ) {

				echo '<div class="breadcrumb">';

				global $post;
				_e('<a href="'.SITEURL.'" title="Início"></a> ', 'HPF');
				echo $delimiter.' ';

				if ( is_category() ) {
					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$thisCat = $cat_obj->term_id;
					$thisCat = get_category($thisCat);
					$parentCat = get_category($thisCat->parent);
					if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
					echo $before;
					echo single_cat_title('', false).$after;

				} elseif ( is_day() ) {
					echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
					echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
					echo $before . get_the_time('d') . $after;

				} elseif ( is_month() ) {
					echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
					echo $before . get_the_time('F') . $after;

				} elseif ( is_year() ) {
					echo $before . get_the_time('Y') . $after;

				} elseif ( is_single() && !is_attachment() ) {
					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
						echo $before . get_the_title() . $after;
					} else {
						$cat = get_the_category(); $cat = $cat[0];
						echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
						echo $before . get_the_title() . $after;
					}

				} elseif ( is_tag() ) {
					echo $before . 'Tópico "' . single_tag_title('', false) . '"' . $after;
			
				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					echo $before . $post_type->labels->singular_name . $after;

				} elseif ( is_attachment() ) {
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID); $cat = $cat[0];
					echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
					echo $before . get_the_title() . $after;

				} elseif ( is_page() && !$post->post_parent ) {
					echo $before . get_the_title() . $after;

				} elseif ( is_page() && $post->post_parent ) {
					$parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
					echo $before . get_the_title() . $after;

				} elseif ( is_search() ) {
					echo $before;
					_e ('Resultado da busca por ', 'HPF');
					echo get_search_query() . '"' . $after;

				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata($author);
					echo $before;
					_e ('Artigos postados por ', 'HPF');
					echo $userdata->display_name . $after;

				} elseif ( is_404() ) {
					echo $before . 'Error 404' . $after;
				}

				if ( get_query_var('paged') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
						echo __('Page') . ' ' . get_query_var('paged');
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
				}

				echo '</div>';

			}
			
		}
		
		// FUNÇÃO POSTS POPULARES //
		public function chama_post_popular($no_posts = 2, $before = '<li>', $after = '</li>', $show_pass_post = false, $duration='') {
			global $wpdb;
			$request = "SELECT ID, post_title, post_content, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
			$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
			if(!$show_pass_post) $request .= " AND post_password =''";
			if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
			}
			$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
			$posts = $wpdb->get_results($request);
			$output = '';
			if ($posts) {
			   foreach ($posts as $post) {
							   $post_title = stripslashes($post->post_title);
							   $post_content = strip_tags($post->post_content);
							   $post_content = (strlen($post_content) > 100) ? substr(strip_tags($post->post_content),0,70)." ..." : $post_content;
							   $comment_count = $post->comment_count;
							   $permalink = get_permalink($post->ID);
							   $output .= $before . '<a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . '</a><br />' . $post_content . $after;
			   }
			} else {
			   $output .= $before . "None found" . $after;
			}
			echo $output;
		}
		
		// FUNCAO QUE remove acentos e espacos de qualquer titulo
		function encodeUrlParam ( $string )
		{
		  $string = trim($string);

		  if ( ctype_digit($string) )
		  {
			return $string;
		  }
		  else
		  {     
			// replace accented chars
			$accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig|tilde|ordm);/';
			$string_encoded = htmlentities($string,ENT_NOQUOTES,'UTF-8');

			$string = preg_replace($accents,'$1',$string_encoded);
 
			// clean out the rest
			$replace = array('([\40])','([^a-zA-Z0-9-])','(-{2,})');
			$with = array('-','','-');
			$string = preg_replace($replace,$with,$string);
		  }

		  return strtolower($string);
		}
		
		// Mostrar Paginação

		function post_pagination($pages = '', $range = 4)
		{
			 $showitems = ($range * 2)+1;  

			 global $paged;
			 if(empty($paged)) $paged = 1;

			 if($pages == '')
			 {
				 global $wp_query;
				 $pages = $wp_query->max_num_pages;
				 if(!$pages)
				 {
					 $pages = 1;
				 }
			 }   

			 if(1 != $pages)
			 {
				 echo "<div class='paginacao'><span>P&aacute;ginas</span>";
				 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='current'>&laquo;</a>";
				 if($paged > 6 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>1</a> <span class='current'>...</span>";

				 for ($i=1; $i <= $pages; $i++)
				 {
					 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
					 {
						 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
					 }
				 }

				 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<span class='current'>...</span> <a href='".get_pagenum_link($pages)."'>$pages</a>";
				 if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' class='current'>&raquo;</a>";
				 echo "</div>\n";
			 }
			 
		}	
		
	}
	
?>