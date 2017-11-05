<?php

if(!function_exists('atos_get_cat')){
 function atos_get_cat($post_id, $taxonomy = 'categoria', $second_tax = 'categoria'){
	 
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
 }

if(!function_exists('translated_id')){
	function translated_id($id, $post_type = 'any' ){
	  if(function_exists('icl_object_id')) {
		return icl_object_id($id, $post_type , true, ICL_LANGUAGE_CODE);
	  } else {
		return $id;
	  }
	}
	
	function lang_object_ids($ids_array, $type) {
	 if(function_exists('icl_object_id')) {
	  $res = array();
	  foreach ($ids_array as $id) {
	   $xlat = icl_object_id($id,$type,false);
	   if(!is_null($xlat)) $res[] = $xlat;
	  }
	  return $res;
	 } else {
	  return $ids_array;
	 }
	}
}


function atos_product_breadcrumbs ($post_id){
	
	$atos_categoria = atos_get_cat($post_id);
	$atos_linea = atos_get_cat($post_id, 'linea');
	$atos_modello = atos_get_cat($post_id, 'modello');
	$atos_versione = atos_get_cat($post_id, 'versione');
	?>
<div class="breadcrumbs-cat"><p>	
  <?php 
        echo $atos_categoria['name'] . ' / ' ;
        echo $atos_linea['name'] ;
		if ($atos_categoria['id'] == translated_id(36, 'categoria')){
        echo  ' / '. $atos_modello['name'] . ' / ';
        echo '<b><span class="label label-warning">' . $atos_versione['name'] . '</span></b>';
		}elseif ($atos_categoria['id'] == translated_id(37, 'categoria')){
		echo  ' / '. '<b><span class="label label-warning">' . $atos_versione['name'] . '</span></b>';	
			}
	?></p>
</div>
<?php
	
	if($atos_categoria['id'] == translated_id(36, 'categoria') && $atos_versione['id'] == translated_id(41, 'versione') && $atos_linea['id'] !== translated_id(31, 'linea')){
		
		?>
<div class="breadcrumbs-label">
  <div id="label-automatica"> <a rel="popover" data-toggle="collapse" data-target="<?php echo '#collapse' . translated_id(205, 'caratteristiche'); ?>" href="<?php echo '#collapse' . translated_id(205, 'caratteristiche'); ?>" data-container="body" data-html='true' data-trigger="hover" data-title="<?php _e('Automatic version available' , 'at-os') ?>" data-content="<p><?php _e('The operator can open and close the door by pushing the foot pedal or activating the optical sensor on the touch screen panel. Available for automatic version.' , 'at-os') ?></p>"><?php _e('Discover the automatic version', 'at-os') ?></a> </div>
</div>
<?php
		}
		
		if($atos_categoria['id'] == translated_id(37, 'categoria')){
		
		?>
<div class="breadcrumbs-label">
  <div id="label-speedcycle"> <a rel="popover" data-toggle="collapse" data-target="<?php echo '#collapse' . translated_id(271, 'caratteristiche'); ?>" href="<?php echo '#collapse' . translated_id(271, 'caratteristiche'); ?>" data-container="body" data-html='true' data-trigger="hover" data-title="<?php _e('Speed Cycle version available' , 'at-os') ?>" data-content="<p><?php _e('Additional tanks allow the pre-heating of warm and demineralized water in order to speed the washing and disinfection steps. The total time of the cycle is reduced by up to 50%.' , 'at-os') ?></p>"><?php _e('Discover the speed-cycle version', 'at-os') ?></a> </div>
</div>
<?php
		}
}


 function atos_get_tutti_i_dati ($post_id) {
	 
	 $atos_linea = atos_get_cat(get_the_ID(), 'linea');	 
	 $atos_categoria = atos_get_cat(get_the_ID(), 'categoria');  
	 $atos_modello = atos_get_cat(get_the_ID(), 'modello');
	 
	 
	$axl_atos_peso 					= get_post_meta( $post_id, 'axl_atos_peso', 			true );
	$axl_atos_larghezza 			= get_post_meta( $post_id, 'axl_atos_larghezza', 		true );
	$axl_atos_profondità 			= get_post_meta( $post_id, 'axl_atos_profondità', 		true );
	$axl_atos_altezza 				= get_post_meta( $post_id, 'axl_atos_altezza', 			true );
	$axl_atos_pressioneH20			= get_post_meta( $post_id, 'axl_atos_pressioneH20', 	true );
	$axl_atos_temperaturaH20 		= get_post_meta( $post_id, 'axl_atos_temperaturaH20', 	true );
	$axl_atos_allacciamentiH20		= get_post_meta( $post_id, 'axl_atos_allacciamentiH20', true );
	$axl_atos_sifone 				= get_post_meta( $post_id, 'axl_atos_sifone', 			true );
	$axl_atos_ConsumoH20 			= get_post_meta( $post_id, 'axl_atos_ConsumoH20', 		true );
	$axl_atos_rumorosità 			= get_post_meta( $post_id, 'axl_atos_rumorosità_lavap', 		true );
	$axl_atos_umidità 				= get_post_meta( $post_id, 'axl_atos_umidità', 			true );
	$axl_atos_temperatura_lavoro	= get_post_meta( $post_id, 'axl_atos_temperatura_lavoro', true );
	$axl_atos_normeEN 				= get_post_meta( $post_id, 'axl_atos_normeEN', 			true );
	$axl_atos_acessori				= get_post_meta( $post_id, 'axl_atos_pages', 			false );
	$axl_atos_related 				= get_post_meta( $post_id, 'axl_atos_related', 			false );
	$axl_atos_caratteristiche 		= get_post_meta( $post_id, 'axl_atos_caratteristiche_connesse', false );
	
	$axl_atos_altezza_carico 					= get_post_meta( $post_id, 'axl_atos_altezza_carico', 					true );
	$axl_atos_alimentazioneH2O 					= get_post_meta( $post_id, 'axl_atos_alimentazioneH2O', 				true );
	$axl_atos_portata_pompa_lavaggio 			= get_post_meta( $post_id, 'axl_atos_portata_pompa_lavaggio', 			true );
	$axl_atos_allacciamentoH2Ofredda 			= get_post_meta( $post_id, 'axl_atos_allacciamentoH2Ofredda', 			true );
	$axl_atos_allacciamentoH2Ocalda 			= get_post_meta( $post_id, 'axl_atos_allacciamentoH2Ocalda', 			true );
	$axl_atos_allacciamentoH2Odemineralizzata 	= get_post_meta( $post_id, 'axl_atos_allacciamentoH2Odemineralizzata', 	true );
	$axl_atos_allacciamento_vapore 				= get_post_meta( $post_id, 'axl_atos_allacciamento_vapore', 					true );
	$axl_atos_consumoH2Ofredda 					= get_post_meta( $post_id, 'axl_atos_consumoH2Ofredda', 				true );
	$axl_atos_consumoH2Ocalda 					= get_post_meta( $post_id, 'axl_atos_consumoH2Ocalda', 					true );
	$axl_atos_consumoH2Odemineralizzata 		= get_post_meta( $post_id, 'axl_atos_consumoH2Odemineralizzata', 		true );
	$axl_atos_sifone_scarico 					= get_post_meta( $post_id, 'axl_atos_sifone_scarico', 					true );
	$axl_atos_connessione_sfiato_camera 		= get_post_meta( $post_id, 'axl_atos_connessione_sfiato_camera', 		true );
	$axl_atos_portata_sfiato_camera 			= get_post_meta( $post_id, 'axl_atos_portata_sfiato_camera', 			true );
	$axl_atos_dispersione_termica	 			= get_post_meta( $post_id, 'axl_atos_dispersione_termica', 				true );
	$axl_atos_rumorosita_lp 					= get_post_meta( $post_id, 'axl_atos_rumorosita_lp', 					true );
	
	$axl_atos_rumorosita_armadi 				= get_post_meta( $post_id, 'axl_atos_rumorosita_armadi', 				true );
	$axl_atos_portata_aria_armadi 				= get_post_meta( $post_id, 'axl_atos_portata_aria_armadi', 				true );
	$axl_atos_portata_armadi 					= get_post_meta( $post_id, 'axl_atos_portata_armadi', 					true );
	$axl_atos_aspirazione_armadi 				= get_post_meta( $post_id, 'axl_atos_aspirazione_armadi', 				true );
 
 	 ?>
 	<section id="tutti_i_dati">
 		 <h2> <?php echo __('Full features', 'at-os'); ?> </h2>
             
						 <table class="product-info table">
                           
                                <tr>
                                <th scope="row"><?php echo __('Weight', 'at-os'); ?></th>
                                <td>kg</td>
                                 <td><?php  echo $axl_atos_peso; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Width', 'at-os'); ?></th>
                                <td>mm</td>
                                <td><?php  echo $axl_atos_larghezza; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Dept', 'at-os'); ?></th>
                                <td>mm</td>
                                <td><?php  echo $axl_atos_profondità; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Height', 'at-os'); ?></th>
                                <td>mm</td>
                                <td><?php  echo $axl_atos_altezza; ?></td>
                                </tr>
                                <tr>
                        
                        <?php if ( in_array ( $atos_categoria['id'], array( '36', '59')  ) ): //lavapadelle ?>
                        
                           
                                <th scope="row"><?php echo __('H<sub>2</sub>O alimentation pressure', 'at-os'); ?></th>
                                <td>kPa</td>
                                <td><?php  echo $axl_atos_pressioneH20; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Water Temperature', 'at-os'); ?></th>
                                <td>°C</td>
                                <td><?php  echo $axl_atos_temperaturaH20; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Water connection', 'at-os'); ?></th>
                                <td>DN</td>
                                <td><?php  echo $axl_atos_allacciamentiH20; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Drain siphon', 'at-os'); ?></th>
                                <td>DN</td>
                                <td><?php  echo $axl_atos_sifone; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Water consumption', 'at-os'); ?></th>
                                <td>l</td>
                                <td><?php  echo $axl_atos_ConsumoH20; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Noisiness', 'at-os'); ?></th>
                                <td>dB(A)</td>
                                <td><?php  echo $axl_atos_rumorosità; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Relative humidity', 'at-os'); ?></th>
                                <td>%</td>
                                <td><?php  echo $axl_atos_umidità; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Work temperature', 'at-os'); ?></th>
                                <td>°c</td>
                                <td><?php  echo $axl_atos_temperatura_lavoro; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('EN Norms', 'at-os'); ?></th>
                                <td>&nbsp;</td>
                                <td><?php  echo $axl_atos_normeEN; ?></td>
                                </tr>
                        </table>
                        
						<?php elseif ( in_array ( $atos_categoria['id'], array( '44', '60') ) ): //armadi ?>
                        
                      
    
                        	<tr>
                                <th scope="row"><?php echo __('Noise', 'at-os'); ?></th>
                                <td>dBA</td>
                                <td><?php  echo $axl_atos_rumorosita_armadi; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Air flow introduced in the cabinet', 'at-os'); ?></th>
                                <td>m<sup>3</sup>/h</td>
                                <td><?php  echo $axl_atos_portata_aria_armadi ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Pressure', 'at-os'); ?></th>
                                <td>Pa</td>
                                <td><?php  echo $axl_atos_portata_armadi; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('aspiration filter', 'at-os'); ?></th>
                                <td>mm</td>
                                <td><?php  echo $axl_atos_aspirazione_armadi; ?></td>
                                </tr>
                        
                        <?php elseif ( in_array ( $atos_categoria['id'], array( '37', '58') ) ): ?>
                        
                        <?php // $atos_categoria['slug'] ?>
                          
                                <tr>
                                <th scope="row"><?php echo __('Load height (5 level trolley 10 DIN)', 'at-os'); ?></th>
                                <td>mm</td>
                                <td><?php  echo $axl_atos_altezza_carico; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Main water pressure', 'at-os'); ?></th>
                                <td>bar / lt-Min</td>
                                <td><?php  echo $axl_atos_alimentazioneH2O; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Capacity washing pum', 'at-os'); ?></th>
                                <td>lt-Min</td>
                                <td><?php  echo $axl_atos_portata_pompa_lavaggio; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Cold water connection', 'at-os'); ?></th>
                                <td>DN</td>
                                <td><?php  echo $axl_atos_allacciamentoH2Ofredda; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Hot water connection', 'at-os'); ?></th>
                                <td>DN</td>
                                <td><?php  echo $axl_atos_allacciamentoH2Ocalda; ?></td>
                                </tr>
                                
                                <tr>
                                <th scope="row"><?php echo __('Purified water connection', 'at-os'); ?></th>
                                <td>DN</td>
                                <td><?php  echo $axl_atos_allacciamentoH2Odemineralizzata; ?></td>
                                </tr>
                                
                                
                                <tr>
                                <th scope="row"><?php echo __('Facility stream connection', 'at-os'); ?></th>
                                <td>DN °C / bar</td>
                                <td><?php  echo $axl_atos_allacciamento_vapore; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Cold water consumption for standard cycle', 'at-os'); ?></th>
                                <td>l</td>
                                <td><?php  echo $axl_atos_consumoH2Ofredda; ?></td>
                                </tr>
                                <tr>
                                <th scope="row"><?php echo __('Hot water consumption for standard cycle', 'at-os'); ?></th>
                                <td>l</td>
                                <td><?php  echo $axl_atos_consumoH2Ocalda; ?></td>
                                </tr>
                                
                                <tr>
                                <th scope="row"><?php echo __('Demineralized water consumption for standard cycle', 'at-os'); ?></th>
                                <td>l</td>
                                <td><?php  echo $axl_atos_consumoH2Odemineralizzata; ?></td>
                                </tr>
                                 
                                <tr>
                                <th scope="row"><?php echo __('Drain trap (Corrosion-proof and 93°C resistant pipe)', 'at-os'); ?></th>
                                <td>DN (ø)</td>
                                <td><?php  echo $axl_atos_sifone_scarico; ?></td>
                                </tr>
                                 
                                <tr>
                                <th scope="row"><?php echo __('Chamber breather pipe connection', 'at-os'); ?></th>
                                <td>ø</td>
                                <td><?php  echo $axl_atos_connessione_sfiato_camera; ?></td>
                                </tr>
                                
                                <tr>
                                <th scope="row"><?php echo __('Chamber breather pipe flow rate', 'at-os'); ?></th>
                                <td>m<sup>3</sup>/h</td>
                                <td><?php  echo $axl_atos_portata_sfiato_camera; ?></td>
                                </tr>
                                
                                 <tr>
                                <th scope="row"><?php echo __('Heat loss', 'at-os'); ?></th>
                                <td>kcal/h - W</td>
                                <td><?php  echo $axl_atos_dispersione_termica; ?></td>
                                </tr>
                                
                                 <tr>
                                <th scope="row"><?php echo __('noise', 'at-os'); ?></th>
                                <td>dB(A)</td>
                                <td><?php  echo $axl_atos_rumorosita_lp; ?></td>
                                </tr>
                                
                      
                        
                        <?php endif; ?>
                        
                          </table>
                    
                    <p><small><?php edit_post_link( 'Modifica Dati', '', '', $post_id ); ?></small> </p>
 	</section>
 	<?php
 	
 }

function atos_get_download ($post_id) {
	 

 
  	?>
 <!--	<section id="download" class="clearfix">
    <?php if ( ! is_user_logged_in() ) { // Display WordPress login form:
				?>
    	<h5> <?php _e( 'Reserved area', 'at-os' ) ?></h5>
         <?php
    $args = array(
        'redirect' => admin_url(), 
        'form_id' => 'loginform-custom',
        'label_username' => __( 'Nome utente' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Ricorda l\'accesso' ),
        'label_log_in' => __( 'Accedi' ),
        'remember' => true
    );
    wp_login_form( $args );
}else { // If logged in:
    wp_loginout( home_url() ); // Display "Log Out" link.
    
} ?>

    </section> -->
    <?php
}


 
 function axl_atos_get_image_url($post_id, $altezza = null, $larghezza = null){
	 
	$atos_categoria = atos_get_cat($post_id, 'categoria'); 
	$atos_linea 	= atos_get_cat($post_id, 'linea'); 
	 
	 if(!isset($altezza)){
		$axl_atos_altezza 	= get_post_meta( $post_id, 'axl_atos_altezza', 	true );
		
	 }else{
		$altezza = $axl_atos_altezza;
		$axl_atos_altezza 	= intval ($axl_atos_altezza) ;
	}
	 if(!isset($larghezza)){
		$axl_atos_larghezza = get_post_meta( $post_id, 'axl_atos_larghezza', true );
		
		
		$larghezza = $axl_atos_larghezza;
	 }else{
	
		$axl_atos_larghezza = intval ($axl_atos_larghezza) ;
	
	
	}
	  

	$large_image_url 	= wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full'); 
	$image 				= matthewruddy_image_resize( $large_image_url[0], $axl_atos_larghezza, $axl_atos_altezza , false);
	
	return $image['url'];
}

function atos_get_caratterisitche ($post_id) {
	 

 
  	?>
 	<section id="caratteristiche">
 		
            <?php 
					$categories = get_the_terms($post_id, 'linea');
					//echo '<pre>';
					//print_r($categories);
					//echo '</pre>';
					$i= 0;
					foreach ($categories as $category) {
						
						$cat[$i]['name'] = $category->name;
						$cat[$i]['slug'] = $category->slug;
						$cat[$i]['description'] = $category->description;
						$cat[$i]['id'] = $category->id;
						$i++;
					}
					
			?>
            
			<h5> <?php echo __('Specifications', 'at-os'); ?>  <?php echo $cat[0]['name'] ?> :</h5>
            		
					
					<?php
					
					echo '<p>'. $cat[0]['description']. '</p>';
					?>
                    
                    
			<?php 
			//echo $post_id, $current_id ;
			$axl_atos_caratteristiche 		= get_post_meta($post_id, 'axl_atos_caratteristiche_connesse', false );
			$atos_linea = atos_get_cat($post_id, 'linea');	
				
				
				$args = array(
						'post_type' => 'caratteristiche',
					
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'tax_query' => array(
														array(
															'taxonomy' => 'linea',
															'field' => 'slug',
															'terms' =>  $atos_linea['slug'],
														)
													)
						
					);
					
				$caratteristiche = new WP_Query($args);
				$num_caratteristiche = $caratteristiche->post_count;
				
				if ( $caratteristiche->have_posts() ) {
						
				?>
                <h3> <?php echo __('High Tech Features', 'at-os') . ' '. $cat[0]['name'] . ' ' . __('(Where available)', 'at-os'); ?> : </h3>
                <div class="panel-group" id="accordion"> 
                <?php		
						
					while ( $caratteristiche->have_posts() ) {
						$caratteristiche->the_post();
						?>
                        
                         <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                            
                            
                             
                             
                             
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo translated_id( get_the_ID(), 'caratteristiche');?>">
                                   <?php the_title() ?>
                                </a>
                              </h4>
                            </div>
                            <div id="collapse<?php echo get_the_ID();?>" class="panel-collapse collapse">
                              <div class="panel-body">
                               <?php $ico = rwmb_meta( 'axl_atos_icona_caratteristiche',  'type=image');
                            
								foreach ( $ico as $image )
								{
								echo "<img class='icon-features' src='{$image['url']}' alt='{$image['alt']}' />";
								}						    
							?>
                                <?php the_content() ?>
                               
                                <div class="tip-img"> <?php echo get_the_post_thumbnail($caratteristiche->ID, 'full') ; ?></div>
                            
                               <?php edit_post_link( 'modifica', '', '', $caratteristiche->ID ); ?>
                                
                                    </div>
                            </div>
                          </div>
                      
                        <?php
						
					
						
				}
				
				wp_reset_postdata();
				?>
                </div>
                <?php
				}
				
			 ?>
 	</section>
 	<?php
 
 }

if(!function_exists('immagine_carosello')){
	
	function immagine_carosello ($post_id, $size = 'macchine-thumb'){


		//return '$post_id da immagine carosello'. $post_id;


		if(has_post_thumbnail($post_id)){

		return	get_the_post_thumbnail($post_id, $size);

		}else{

		return	wp_get_attachment_image( 382, $size);
		}

	}
}