<?php 

class ET_Theme_Post_Types {

	public $domain = 'xstore-core';

	public function init() {
		add_action( 'init', array($this, 'register_post_types'), 1);
		add_filter( 'post_type_link', array( $this, 'portfolio_post_type_link' ), 10, 2 );
		add_action( 'admin_init', array( $this, 'custom_type_settings' ) );
		add_action( 'load-options-permalink.php', array( $this,'seatings_for_permalink') );
		add_filter( 'manage_staticblocks_posts_columns', array($this, 'et_staticblocks_columns') );
		add_action( 'manage_staticblocks_posts_custom_column', array( $this, 'et_staticblocks_columns_val'), 10, 2);

		add_action( 'admin_enqueue_scripts', array( $this, 'brand_admin_scripts' ) );
		add_action( 'brand_add_form_fields', array( $this, 'brand_fileds') );
		add_action( 'brand_edit_form_fields', array( $this, 'edit_brand_fields' ), 10, 2 );
		add_action( 'created_term', array( $this, 'brands_fields_save' ), 10,3 );
		add_action( 'edit_term', array( $this, 'brands_fields_save' ), 10,3 );
	}

	public function register_post_types() {

		// **********************************************************************// 
		// ! Static Blocks Post Type
		// **********************************************************************// 

        $static_blocks_labels = array(
            'name' => _x( 'Static Blocks', 'post type general name', $this->domain ),
            'singular_name' => _x( 'Block', 'post type singular name', $this->domain ),
            'add_new' => _x( 'Add New', 'static block', $this->domain ),
            'add_new_item' => sprintf( __( 'Add New %s', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'edit_item' => sprintf( __( 'Edit %s', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'new_item' => sprintf( __( 'New %s', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'all_items' => sprintf( __( 'All %s', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'view_item' => sprintf( __( 'View %s', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'search_items' => sprintf( __( 'Search %a', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'not_found' =>  sprintf( __( 'No %s Found', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'not_found_in_trash' => sprintf( __( 'No %s Found In Trash', $this->domain ), __( 'Static Blocks', $this->domain ) ),
            'parent_item_colon' => '',
            'menu_name' => __( 'Static Blocks', $this->domain )

        );

        $static_blocks_args = array(
            'labels' => $static_blocks_labels,
            'public' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'staticblocks' ),
            'capability_type' => 'post',
            'has_archive' => 'staticblocks',
            'hierarchical' => false,
            'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'menu_icon' => 'dashicons-welcome-widgets-menus',
            'menu_position' => 8
        );

        if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'static_blocks' ) )
			register_post_type( 'staticblocks', $static_blocks_args );

		
		// **********************************************************************// 
		// ! Portfolio Post Type
		// **********************************************************************// 

		$portfolio_labels = array(
			'name' => _x('Projects', 'post type general name', $this->domain),
			'singular_name' => _x('Project', 'post type singular name', $this->domain),
			'add_new' => _x('Add New', 'project', $this->domain),
			'add_new_item' => __('Add New Project', $this->domain),
			'edit_item' => __('Edit Project', $this->domain),
			'new_item' => __('New Project', $this->domain),
			'view_item' => __('View Project', $this->domain),
			'search_items' => __('Search Projects', $this->domain),
			'not_found' =>  __('No projects found', $this->domain),
			'not_found_in_trash' => __('No projects found in Trash', $this->domain),
			'parent_item_colon' => '',
			'menu_name' => 'Portfolio'
		
		);

		$slug = get_option( 'portfolio_base' ) ? get_option( 'portfolio_base' ) : 'project';
		$slug .= get_option( 'portfolio_custom_base' );
		
		$portfolio_args = array(
			'labels' => $portfolio_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
			'menu_icon' => 'dashicons-images-alt2',
			'rewrite' => array( 'slug' => $slug )
		);
		
        if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'portfolio_projects' ) )
			register_post_type('etheme_portfolio',$portfolio_args);

		
		$tags_labels = array(
			'name' => _x( 'Tags', 'taxonomy general name', $this->domain ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name', $this->domain ),
			'search_items' =>  __( 'Search Types', $this->domain ),
			'all_items' => __( 'All Tags', $this->domain ),
			'parent_item' => __( 'Parent Tag', $this->domain ),
			'parent_item_colon' => __( 'Parent Tag:', $this->domain ),
			'edit_item' => __( 'Edit Tags', $this->domain ),
			'update_item' => __( 'Update Tag', $this->domain ),
			'add_new_item' => __( 'Add New Tag', $this->domain ),
			'new_item_name' => __( 'New Tag Name', $this->domain ),
		);
		
		$categ_labels = array(
			'name' => _x( 'Portfolio categories', 'taxonomy general name', $this->domain ),
			'singular_name' => _x( 'Portfolio category', 'taxonomy singular name', $this->domain ),
			'search_items' =>  __( 'Search types', $this->domain ),
			'all_items' => __( 'All categories', $this->domain ),
			'parent_item' => __( 'Parent category', $this->domain ),
			'parent_item_colon' => __( 'Parent category:', $this->domain ),
			'edit_item' => __( 'Edit categories', $this->domain ),
			'update_item' => __( 'Update category', $this->domain ),
			'add_new_item' => __( 'Add new category', $this->domain ),
			'new_item_name' => __( 'New category name', $this->domain ),
		);
		
		
        if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'portfolio_projects' ) )
			register_taxonomy('portfolio_category',array('etheme_portfolio'), array(
				'hierarchical' => true,
				'labels' => $categ_labels,
				'show_ui' => true, 
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => ( get_option( 'portfolio_cat_base' ) ) ? get_option( 'portfolio_cat_base' ) : 'portfolio-category' ),
			));
		
		// **********************************************************************// 
		// ! Testimonials Post Type
		// **********************************************************************// 

		$testimonials_labels = array(
			'name' => _x( 'Testimonials', 'post type general name', $this->domain ),
			'singular_name' => _x( 'Testimonial', 'post type singular name', $this->domain ),
			'add_new' => _x( 'Add New', 'testimonial', $this->domain ),
			'add_new_item' => sprintf( __( 'Add New %s', $this->domain ), __( 'Testimonial', $this->domain ) ),
			'edit_item' => sprintf( __( 'Edit %s', $this->domain ), __( 'Testimonial', $this->domain ) ),
			'new_item' => sprintf( __( 'New %s', $this->domain ), __( 'Testimonial', $this->domain ) ),
			'all_items' => sprintf( __( 'All %s', $this->domain ), __( 'Testimonials', $this->domain ) ),
			'view_item' => sprintf( __( 'View %s', $this->domain ), __( 'Testimonial', $this->domain ) ),
			'search_items' => sprintf( __( 'Search %a', $this->domain ), __( 'Testimonials', $this->domain ) ),
			'not_found' =>  sprintf( __( 'No %s Found', $this->domain ), __( 'Testimonials', $this->domain ) ),
			'not_found_in_trash' => sprintf( __( 'No %s Found In Trash', $this->domain ), __( 'Testimonials', $this->domain ) ),
			'parent_item_colon' => '',
			'menu_name' => __( 'Testimonials', $this->domain )

		);

		$testimonials_args = array(
			'labels' => $testimonials_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'testimonial' ),
			'capability_type' => 'post',
			'has_archive' => 'testimonials',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'menu_position' => 5,
			'menu_icon' => 'dashicons-format-status'
		);

        if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'testimonials_type' ) )
			register_post_type( 'testimonials', $testimonials_args );

		$testimonials_cats_labels = array(
			'name'                => sprintf( _x( '%s', 'taxonomy general name', $this->domain ), 'Categories' ),
			'singular_name'       => sprintf( _x( '%s', 'taxonomy singular name', $this->domain ), 'Category' ),
			'search_items'        => sprintf( __( 'Search %s', $this->domain ), 'Categories' ),
			'all_items'           => sprintf( __( 'All %s', $this->domain ), 'Categories' ),
			'parent_item'         => sprintf( __( 'Parent %s', $this->domain ), 'Category' ),
			'parent_item_colon'   => sprintf( __( 'Parent %s:', $this->domain ), 'Category' ),
			'edit_item'           => sprintf( __( 'Edit %s', $this->domain ), 'Category' ),
			'update_item'         => sprintf( __( 'Update %s', $this->domain ), 'Category' ),
			'add_new_item'        => sprintf( __( 'Add New %s', $this->domain ), 'Category'),
			'new_item_name'       => sprintf( __( 'New %s Name', $this->domain ), 'Category' ),
			'menu_name'           => sprintf( __( '%s', $this->domain ), 'Categories' )
		);
		
		$testimonials_cats_args = array( 
			'labels' => $testimonials_cats_labels, 
			'public' => true, 
			'hierarchical' => true, 
			'show_ui' => true, 
			'show_admin_column' => true,
			'query_var' => true, 
			'show_in_nav_menus' => false, 
			'show_tagcloud' => false 
		);

        if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'testimonials_type' ) )
			register_taxonomy( 'testimonial-category', 'testimonials', $testimonials_cats_args );

		

		$brand_slug = get_option( 'brand_custom_base' ) ? ( get_option( 'brand_custom_base' ) . '/' ): '';

		$brand_slug .= get_option( 'brand_base' ) ? get_option( 'brand_base' ) : 'brand';

		$labels = array(
			'name'              => esc_html__( 'Brands', $this->domain ),
			'singular_name'     => esc_html__( 'Brand', $this->domain ),
			'search_items'      => esc_html__( 'Search Brands', $this->domain ),
			'all_items'         => esc_html__( 'All Brands', $this->domain ),
			'parent_item'       => esc_html__( 'Parent Brand', $this->domain ),
			'parent_item_colon' => esc_html__( 'Parent Brand:', $this->domain ),
			'edit_item'         => esc_html__( 'Edit Brand', $this->domain ),
			'update_item'       => esc_html__( 'Update Brand', $this->domain ),
			'add_new_item'      => esc_html__( 'Add New Brand', $this->domain ),
			'new_item_name'     => esc_html__( 'New Brand Name', $this->domain ),
			'menu_name'         => esc_html__( 'Brands', $this->domain ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
            'capabilities'			=> array(
            	'manage_terms' 		=> 'manage_product_terms',
				'edit_terms' 		=> 'edit_product_terms',
				'delete_terms' 		=> 'delete_product_terms',
				'assign_terms' 		=> 'assign_product_terms',
            ),
			'rewrite'           => array( 'slug' => $brand_slug ),
		);

        if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'enable_brands' ) )
			register_taxonomy( 'brand', array( 'product' ), $args );

	}

	public function portfolio_post_type_link( $permalink, $post ) {
		/**
		 *
		 * Add support for portfolio link custom structure.
		 *
		 */

		if ( $post->post_type != 'etheme_portfolio' ) {
			return $permalink;
		}


		if ( false === strpos( $permalink, '%' ) ) {
			return $permalink;
		}

		// Get the custom taxonomy terms of this post.
		$terms = get_the_terms( $post->ID, 'portfolio_category' );

		if ( ! empty( $terms ) ) {
			$terms = wp_list_sort( $terms, 'ID' );  // order by ID

			$category_object = apply_filters( 'portfolio_post_type_link_portfolio_cat', $terms[0], $terms, $post );
			$category_object = get_term( $category_object, 'portfolio_category' );
			$portfolio_category     = $category_object->slug;

			if ( $category_object->parent ) {
				$ancestors = get_ancestors( $category_object->term_id, 'portfolio_category' );
				foreach ( $ancestors as $ancestor ) {
					$ancestor_object = get_term( $ancestor, 'portfolio_category' );
					$portfolio_category     = $ancestor_object->slug . '/' . $portfolio_category;
				}
			}
		} else {
			$portfolio_category = __( 'uncategorized', 'slug', 'etheme' );
		}

		if ( strpos( $permalink, '%author%' ) != false ) {
			$authordata = get_userdata( $post->post_author );
			$author = $authordata->user_nicename;
		} else {
			$author = '';
		}

		$find = array(
			'%year%',
			'%monthnum%',
			'%day%',
			'%hour%',
			'%minute%',
			'%second%',
			'%post_id%',
			'%author%',
			'%category%',
			'%portfolio_category%'
		);

		$replace = array(
			date_i18n( 'Y', strtotime( $post->post_date ) ),
			date_i18n( 'm', strtotime( $post->post_date ) ),
			date_i18n( 'd', strtotime( $post->post_date ) ),
			date_i18n( 'H', strtotime( $post->post_date ) ),
			date_i18n( 'i', strtotime( $post->post_date ) ),
			date_i18n( 's', strtotime( $post->post_date ) ),
			$post->ID,
			$author,
			$portfolio_category,
			$portfolio_category
		);

		$permalink = str_replace( $find, $replace, $permalink );

		return $permalink;
	}

	public function et_staticblocks_columns($defaults) {
	    return array(
	    	'cb' => '<input type="checkbox" />',
	        'title' => __('Title', $this->domain),
	        'shortcode_column'=> __('Shortcode', $this->domain),
	        'date' => __('Date', $this->domain),
	    );
	}
	 
	public function et_staticblocks_columns_val($column_name, $post_ID) {
	   if ($column_name == 'shortcode_column') {
	   		echo '[block id="'.$post_ID.'"]';
	   }
	}

	public function custom_type_settings() {

		/**
		 *
		 * Add Etheme section block to permalink setting page.
		 *
		 */
		if( function_exists( 'etheme_get_option' ) && ( etheme_get_option( 'portfolio_projects' ) || etheme_get_option( 'enable_brands' ) ) ){
			add_settings_section(
				'et_section',
				__( '8theme permalink settings' , $this->domain ),
				array( $this, 'section_callback' ),
				'permalink'
			);
		}

		/**
		 *
		 * Add "Brand base" setting field to Etheme section block.
		 *
		 */
		if ( class_exists('Woocommerce') && function_exists( 'etheme_get_option' ) && etheme_get_option( 'enable_brands' ) ) {
			add_settings_field(
				'brand_base',
				__( 'Brand base' , $this->domain ),
				array( $this, 'brand_callback' ),
				'permalink',
				'optional'
			);
		}

		if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'portfolio_projects' ) ){
			/**
			 *
			 * Add "Portfolio base" setting field to Etheme section block.
			 *
			 */
			add_settings_field(
				'portfolio_base',
				__( 'Portfolio base' , $this->domain ),
				array( $this, 'portfolio_callback' ),
				'permalink',
				'optional'
			);

			/**
			 *
			 * Add "Portfolio category base" setting field to Etheme section block.
			 *
			 */
			add_settings_field(
				'portfolio_cat_base',
				__( 'Portfolio category base' , $this->domain ),
				array( $this, 'portfolio_cat_callback' ),
				'permalink',
				'optional'
			);
		}
	}


	public function section_callback() {
		/**
		 *
		 * Callback function for Etheme section block.
		 *
		 */

		$checked['portfolio_def'] = ( get_option( 'et_permalink' ) == 'portfolio_def' || ! get_option( 'et_permalink' ) ) ? 'checked' : '';
		$checked['portfolio_cat_base'] = ( get_option( 'et_permalink' ) == 'portfolio_cat_base' ) ? 'checked' : '';
		$checked['portfolio_custom_base'] = ( get_option( 'et_permalink' ) == 'portfolio_custom_base' ) ? 'checked' : '';

		if ( class_exists('Woocommerce') &&  function_exists( 'etheme_get_option' ) && etheme_get_option( 'enable_brands' ) ) {
			$shop_url = get_permalink( wc_get_page_id( 'shop' ) ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url() . '/shop/';
			$checked['brand_def'] = ( get_option( 'et_brand_permalink' ) == 'brand_def' || ! get_option( 'et_brand_permalink' ) ) ? 'checked' : '';
			$checked['brand_shop_base'] = ( get_option( 'et_brand_permalink' ) == 'brand_shop_base' || ! get_option( 'et_brand_permalink' ) ) ? 'checked' : '';
			$checked['brand_custom_base'] = ( get_option( 'et_brand_permalink' ) == 'brand_custom_base' ) ? 'checked' : '';

			echo '
				<p>' . __( '8theme brand permalink settings.' , $this->domain ) . '</p>
				</tbody></tr></th>
				<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label><input class="et-inp-brand" type="radio" name="et_brand_permalink" value="brand_def" ' . $checked['brand_def'] . ' >' . __( 'Default' , $this->domain ) . '</label></th>
								<td><code>' . esc_html( home_url() ) . '/brand-base/brand-archive/</code></td>
							</tr>
							<tr>
								<th scope="row"><label><input class="et-inp-brand" type="radio" name="et_brand_permalink" value="brand_shop_base" ' . $checked['brand_shop_base'] . '>' . __( 'Shop page base' , $this->domain ) . '</label></th>
								<td><code>' . $shop_url . 'brand-base/brand-archive/</code></td>
								<input type="hidden" id="brand-custom-base" name="brand_custom_base" value="' . get_option( 'brand_custom_base' ) . '">
							</tr>
							
						</tbody>
				</table> 
			';
		}

		if( function_exists( 'etheme_get_option' ) && etheme_get_option( 'portfolio_projects' ) ){
			echo '
				<p>' . __( '8theme portfolio permalink settings.' , $this->domain ) . '</p>
				</tbody></tr></th>
				<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label><input class="et-inp" type="radio" name="et_permalink" value="portfolio_def" ' . $checked['portfolio_def'] . ' >' . __( 'Default' , $this->domain ) . '</label></th>
								<td><code>' . esc_html( home_url() ) . '/portfolio-base/sample-project/</code></td>
							</tr>
							<tr>
								<th scope="row"><label><input class="et-inp" type="radio" name="et_permalink" value="portfolio_cat_base" ' . $checked['portfolio_cat_base'] . '>' . __( 'Portfolio category base' , $this->domain ) . '</label></th>
								<td><code>' . esc_html( home_url() ) . '/portfolio-base/portfolio-category/sample-project/</code></td>
							</tr>
							<tr>
								<th scope="row"><label><input id="portfolio-custom-base-select" type="radio" name="et_permalink" value="portfolio_custom_base" ' . $checked['portfolio_custom_base'] . '>' . __( 'Portfolio custom Base' , $this->domain ) . '</label></th>
								<td><code>' . esc_html( home_url() ) . '/portfolio-base</code><input id="portfolio-custom-base" name="portfolio_custom_base" type="text" value="' . get_option( 'portfolio_custom_base' ) . '" class="regular-text code" /></td>
							</tr>
						</tbody>
				</table>

				<script type="text/javascript">
					jQuery( function() {
						jQuery("input.et-inp, input.et-inp-brand").change(function() {
							
							var link = "";

							if ( jQuery( this ).val() == "portfolio_cat_base" ) {
								link = "/%portfolio_category%";
							} else if ( jQuery( this ).val() == "brand_shop_base" ) {
								link = "' . basename( $shop_url ) . '";
							} else {
								link = "";
							}
							
							if ( jQuery( this ).is( ".et-inp-brand" ) ){
								jQuery("#brand-custom-base").val( link );
							} else {
								jQuery("#portfolio-custom-base").val( link );
							}
						});

						jQuery("input:checked").change();
						jQuery("#portfolio-custom-base").focus( function(){
							jQuery("#portfolio-custom-base-select").click();
						} );
					} );
				</script>

				'
			;
		}
	}


	public function portfolio_callback() {
		/**
		 *
		 * Callback function for "portfolio base" setting field.
		 *
		 */

		echo '<input 
			name="portfolio_base"  
			type="text" 
			value="' . get_option( 'portfolio_base' ) . '" 
			class="regular-text code"
			placeholder="project"
		 />';
	}

	public function brand_callback() {
		/**
		 *
		 * Callback function for "brand base" setting field.
		 *
		 */

		echo '<input 
			name="brand_base"  
			type="text" 
			value="' . get_option( 'brand_base' ) . '" 
			class="regular-text code"
			placeholder="brand"
		 />';
	}

	public function portfolio_cat_callback() {
		/**
		 *
		 * Callback function for "portfolio catogory base" setting field.
		 *
		 */

		echo '<input 
			name="portfolio_cat_base"  
			type="text" 
			value="' . get_option( 'portfolio_cat_base' ) . '" 
			class="regular-text code"
			placeholder="portfolio-category"
		 />';
	}


	public function seatings_for_permalink() {
		/**
		 *
		 * Make it work on permalink page.
		 *
		 */

		if ( ! is_admin() ) {
			return;
		}

		if( isset( $_POST['brand_base'] ) ) {
			update_option( 'brand_base', sanitize_title_with_dashes( $_POST['brand_base'] ) );
		}

		if( isset( $_POST['portfolio_base'] ) ) {
			update_option( 'portfolio_base', sanitize_title_with_dashes( $_POST['portfolio_base'] ) );
		}

		if( isset( $_POST['portfolio_cat_base'] ) ) {
			update_option( 'portfolio_cat_base', sanitize_title_with_dashes( $_POST['portfolio_cat_base'] ) );
		}

		if( isset( $_POST['et_permalink'] ) ) {
			update_option( 'et_permalink', sanitize_title_with_dashes( $_POST['et_permalink'] ) );
		}

		if( isset( $_POST['portfolio_custom_base'] ) ) {
			update_option( 'portfolio_custom_base', $_POST['portfolio_custom_base'] );
		}

		if( isset( $_POST['et_brand_permalink'] ) ) {
			update_option( 'et_brand_permalink', sanitize_title_with_dashes( $_POST['et_brand_permalink'] ) );
		}

		if( isset( $_POST['brand_custom_base'] ) ) {
			update_option( 'brand_custom_base', sanitize_title_with_dashes( $_POST['brand_custom_base'] ) );
		}
	}


	// **********************************************************************// 
	// ! Product brands image filed
	// **********************************************************************//
	public function brand_fileds(){
		global $woocommerce;

		echo '
			<div class="form-field">
				<label>' . esc_html__( 'Thumbnail', 'xstore' ) . '</label>
					<div id="brand_thumbnail" style="float:left;margin-right:10px;">
						<img src="' . wc_placeholder_img_src() . '" width="60px" height="60px" />
					</div>
					<div style="line-height:60px;">
						<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" />
						<button type="submit" class="upload_image_button button">' . esc_html__( 'Upload/Add image', $this->domain ) . '</button>
						<button type="submit" class="remove_image_button button">' . esc_html__( 'Remove image', $this->domain ) . '</button>
					</div>
					<script type="text/javascript">
				            jQuery(function($){
				                $(document).ready(function () {
				    				 // Only show the "remove image" button when needed
				    				 if ( ! $("#brand_thumbnail_id").val() )
				                         $(".remove_image_button").hide();

				    				// Uploading files
				    				var file_frame;

				                    $(document).on( "click", ".upload_image_button", function( event ){

				    					event.preventDefault();

				    					// If the media frame already exists, reopen it.
				    					if ( file_frame ) {
				    						file_frame.open();
				    						return;
				    					}

				    					// Create the media frame.
				    					file_frame = wp.media.frames.downloadable_file = wp.media({
				    						title: "' . esc_html__( 'Choose an image', $this->domain ) . '",
				    						button: {
				    							text: "' . esc_html__( 'Use image', $this->domain ) . '",
				    						},
				    						multiple: false
				    					});

				    					// When an image is selected, run a callback.
				    					file_frame.on( "select", function() {
				    						attachment = file_frame.state().get("selection").first().toJSON();

				                            $("#brand_thumbnail_id").val( attachment.id );
				                            $("#brand_thumbnail img").attr("src", attachment.url );
				                            $(".remove_image_button").show();
				    					});

				    					// Finally, open the modal.
				    					file_frame.open();
				    				});

				                    $(document).on( "click", ".remove_image_button", function( event ){
				                        $("#brand_thumbnail img").attr("src", "' . wc_placeholder_img_src() . '");
				                        $("#brand_thumbnail_id").val("");
				                        $(".remove_image_button").hide();
				    					return false;
				    				});
				                });
				            });
					</script>
				<div class="clear"></div>
			</div>
		';
	}

	// **********************************************************************// 
	// ! Product brands edit single tax image filed
	// **********************************************************************//
	public function edit_brand_fields($term, $taxonomy ) {
    	$thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
    	
    	$image = ( $thumbnail_id ) ? wp_get_attachment_thumb_url( $thumbnail_id ) : wc_placeholder_img_src();

    	
    	echo '
	    	<tr class="form-field">
	    		<th scope="row" valign="top"><label>' . esc_html__( 'Thumbnail', $this->domain ) . '</label></th>
	    		<td>
	    			<div id="brand_thumbnail" style="float:left;margin-right:10px;">
	    				<img src="' . $image . '" width="60px" height="60px" />
	    			</div>
	    			<div style="line-height:60px;">
	    				<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
	    				<button type="submit" class="upload_image_button button">' . esc_html__( 'Upload/Add image', $this->domain ) . '</button>
	    				<button type="submit" class="remove_image_button button">' . esc_html__( 'Remove image', $this->domain ) . '</button>
	    			</div>
	    			<script type="text/javascript">
		                jQuery(function($){
		                    $(document).ready(function ($) {

		                        // Uploading files
		                        var file_frame;

		                        $(document).on("click", ".upload_image_button", function (event) {

		                            event.preventDefault();

		                            // If the media frame already exists, reopen it.
		                            if (file_frame) {
		                                file_frame.open();
		                                return;
		                            }

		                            // Create the media frame.
		                            file_frame = wp.media.frames.downloadable_file = wp.media({
		                                title: "' . esc_html__( 'Choose an image', $this->domain ) . '",
		                                button: {
		                                    text: "' . esc_html__( 'Use image', $this->domain ) . '",
		                                },
		                                multiple: false
		                            });

		                            // When an image is selected, run a callback.
		                            file_frame.on("select", function () {
		                                attachment = file_frame.state().get("selection").first().toJSON();

		                                $("#brand_thumbnail_id").val(attachment.id);
		                                $("#brand_thumbnail img").attr("src", attachment.url);
		                                $(".remove_image_button").show();
		                            });

		                            // Finally, open the modal.
		                            file_frame.open();
		                        });

		                        $(document).on("click", ".remove_image_button", function (event) {
		                            $("#brand_thumbnail img").attr("src", "' . wc_placeholder_img_src() . '");
		                            $("#brand_thumbnail_id").val("");
		                            $(".remove_image_button").hide();
		                            return false;
		                        });
		                    });
		                });
	    			</script>
	    			<div class="clear"></div>
	    		</td>
	    	</tr>
    	';
    }

	// **********************************************************************// 
	// ! Product brands enqueue media for image selector
	// **********************************************************************//
	public function brand_admin_scripts() {
        $screen = get_current_screen();
        if ( in_array( $screen->id, array('edit-brand') ) ){
			wp_enqueue_media();
        }
    }

	// **********************************************************************// 
	// ! Product brands Save image fields
	// **********************************************************************//
    public function brands_fields_save($term_id, $tt_id, $taxonomy ) {
    	if ( isset( $_POST['brand_thumbnail_id'] ) ){
    		update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['brand_thumbnail_id'] ) );
    	}

    	delete_transient( 'wc_term_counts' );
    }
}

$et_post_types = new ET_Theme_Post_Types();
$et_post_types->init();