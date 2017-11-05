<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'AT_OS_Products' ) ) {

	class AT_OS_Products {
		
		public function __construct() {
			add_filter( 'template_include', array( $this, 'product_page_template' ), 99 );
			//add_action( 'product_header', array( $this, 'carosello' ) , 2, 20 );
			add_action( 'product_header', array( $this, 'product_info' ), 2, 21 );
		}
		
		
		
		public function product_info (){
			$post_id = translated_id ( get_the_id() );
			?>
			<footer class="product_info">
			
			
			<div class="breadcrumbs"><?php  atos_product_breadcrumbs($post_id); ?></div>
        	<?php get_template_part( 'parts/nav', 'prodotti' ); ?>
        
			</footer>
			
			<?php
		}
		public function product_page_template( $template ) {
			
			if ( is_singular( 'prodotto' )  ) {
				

				if(function_exists('atos_get_cat')){

					$atos_categoria 	=  atos_get_cat(get_the_id());
					$lavastrumenti_ID 	=  translated_id(37, 'categoria');
					$lavapadelle_ID 	=  translated_id(36, 'categoria');
					$arredo_ID 			=  translated_id(45, 'categoria');
					$armadi_ID 			=  translated_id(44, 'categoria');

					switch( $atos_categoria[ 'id' ]) {

						case $lavastrumenti_ID:
						$product_category = 'product';
						break;										
						case $lavapadelle_ID:
						$product_category = 'product';
						break;										
						case $arredo_ID:
						$product_category = 'arredo';
						break;					
						case $armadi_ID: 
						$product_category = 'product';
						break;

					}

					$new_template = locate_template( array( $product_category . '-page-template.php' ) );

					/*
					* se restituisce una stringa vuota
					*/
					
					if ( '' != $new_template ) {
							return $new_template ;
					}else{
						wp_die('errore');
					}
				}	
			}

			return $template;
		}
		
		
		public function atos_get_cat($post_id, $taxonomy = 'categoria', $second_tax = 'categoria'){
	 
			$post_id = translated_id( $post_id, $taxonomy);

			$terms = get_the_terms( $post_id, $taxonomy ); 
			if(!empty($terms )){
			  if(!is_wp_error( $terms )){

				foreach ( $terms as $term ) {
					$atos_cat['name'] = $term->name;
					$atos_cat['id'] = $term->term_id;
					$atos_cat['slug'] = $term->slug;

				}
				return $atos_cat;
			  }
			}else{
			$terms = get_the_terms( $post_id, $second_tax ); 

			}

		 }
		
		public function carosello($postype = 'prodotto', $taxonomy ='categoria', $tag_ID = 11){
			
			global $post;
		
			
			
			$atos_linea 	= 	$this->atos_get_cat( get_the_ID(), 'linea');	 
			$atos_categoria = 	$this->atos_get_cat( get_the_ID(), 'categoria' );  
			$atos_modello 	= 	$this->atos_get_cat( get_the_ID(), 'modello' );
			$terms 			= 	$this->atos_get_cat( get_the_ID(), $taxonomy ) ;

			$category_lang_ID_awd 	= translated_id(37, 'categoria');	
			$category_lang_ID_lavap = translated_id(36, 'categoria');
			
			
			if ($atos_categoria['id'] == $category_lang_ID_awd ){
				
			} elseif ($atos_categoria['id'] == $category_lang_ID_lavap) {
				
				
				$p_line_1 	= wp_get_attachment_image_src( 804, 'full'); 
				$p_line_2 	= wp_get_attachment_image_src( 805, 'full'); 
				$p_line_3 	= wp_get_attachment_image_src( 806, 'full'); 

				$c_line_1 	= wp_get_attachment_image_src( 801, 'full'); 
				$c_line_2 	= wp_get_attachment_image_src( 802, 'full'); 
				$c_line_3 	= wp_get_attachment_image_src( 803, 'full'); 

				$s_line_1 	= wp_get_attachment_image_src( 807, 'full'); 
				$s_line_2 	= wp_get_attachment_image_src( 808, 'full');

				$pline_ID = translated_id( 25 , 'linea' );
				$sline_ID = translated_id( 31 , 'linea');
				$cline_ID = translated_id( 26 , 'linea');

				$pline_term = get_term( $pline_ID, 'linea' );
				$sline_term = get_term( $sline_ID, 'linea' );
				$cline_term = get_term( $cline_ID, 'linea' );

				$colonna = translated_id( 38, 'modello');
				$banco = translated_id( 39, 'modello');
				$incassato = translated_id( 46, 'modello' );
				
				?>
				<header class='main_product_group'>
				<dl class="professional_line_group main_item_group modello_menu_group">
					<dt><a href='<?php echo get_permalink(translated_id(530)); ?>'><?php _e('AF2 Professional Line','at-os'); ?></a></dt>

					<dd>
						<a href='<?php echo get_permalink(translated_id(130)); ?>' alt='<?php _e( 'See all the counter-top models', 'at-os' ) ?>' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $banco ){ echo 'active'; } ?>'>
							<img src='<?php echo $p_line_1[0] ?>' alt='' />
						</a>
						<span><?php _e('Counter-top','at-os'); ?></span>
					</dd>
					<dd>
						<a href='<?php echo get_permalink(translated_id(124)); ?>' alt='<?php _e( 'See all the stand-alone models', 'at-os' ) ?>' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $colonna ){ echo 'active'; } ?>'>
							<img src='<?php echo $p_line_2[0] ?>' alt='' />
						</a>
						<span><?php _e('Stand-alone','at-os'); ?></span>
						
					</dd>
					
					<dd>
						<a href='<?php echo get_permalink(translated_id(121)); ?>' alt='<?php _e( 'See all the built-in models', 'at-os' ) ?>' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $incassato ){ echo 'active'; } ?>'>
							<img src='<?php echo $p_line_3[0] ?>' alt='' />
						</a>
						<span><?php _e('Built-in','at-os'); ?></span>
					</dd>
			
			</dl>
			
			<dl class="compact_line_group main_item_group modello_menu_group">
				<dt><a href=''><?php _e('AF2 Compact Line','at-os'); ?></a></dt>

				<dd>
					<a href='<?php echo get_permalink(translated_id(157)); ?>' alt='' ><img src='<?php echo $c_line_1[0] ?>' alt='' /></a>
					<span><?php _e('Counter-top','at-os'); ?></span>
				</dd>
				<dd>
					<a href='<?php echo get_permalink(translated_id(155)); ?>' alt='' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $banco ){ echo 'active'; } ?>'>
					<img src='<?php echo $c_line_2[0] ?>' alt='' /></a><span><?php _e('Stand-alone','at-os'); ?></span>
				</dd>
				<dd>
					<a href='<?php echo get_permalink(translated_id(151)); ?>' alt='' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $banco ){ echo 'active'; } ?>'>
					<img src='<?php echo $c_line_3[0] ?>' alt='' /></a><span><?php _e('Built-in','at-os'); ?></span>
				</dd>
			
			</dl>
			
			<dl class="simplex_line_group main_item_group modello_menu_group">
				<dt><a href='<?php echo get_permalink(translated_id(530)); ?>'><?php _e('AF2 Simplex Line','at-os'); ?></a></dt>

				<dd>
					<a href='<?php echo get_permalink(translated_id(163)); ?>' alt='' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $banco ){ echo 'active'; } ?>'>
					<img src='<?php echo $s_line_1[0] ?> ' alt='' /></a><span><?php _e('Counter-top','at-os'); ?></span>
				</dd>
				<dd>
					<a href='<?php echo get_permalink(translated_id(161)); ?>' alt='' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $banco ){ echo 'active'; } ?>'>
					<img src='<?php echo $s_line_2[0] ?>' alt='' /></a><span><?php _e('Stand-alone','at-os'); ?></span>
				</dd>
				<dd>
					<!--<a href='' alt='' class='<?php if( $atos_linea['id'] == $pline_ID && $atos_modello['id'] == $colonna ){ echo 'active'; } ?>'>
					<img src='' alt='' /></a><span><?php _e('Built-in','at-os'); ?></span>-->
				</dd>
			
			</dl>
			</header>
			<?php
			}
		}
	}
	
	

}

return new AT_OS_Products();	