<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://vander-web.com/
 * @since      1.0.0
 *
 * @package    Vanderweb_Bs4_Accordion
 * @subpackage Vanderweb_Bs4_Accordion/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Vanderweb_Bs4_Accordion
 * @subpackage Vanderweb_Bs4_Accordion/public
 * @author     Ulrik Vander <ulrik@vanderweb.com>
 */
class Vanderweb_Bs4_Accordion_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vanderweb_Bs4_Accordion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vanderweb_Bs4_Accordion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$vanderweb_accordions_shortcodes_options = get_option( 'vanderweb_accordions_shortcodes_option_name' );
		$load_bootstrap_4_6_from_the_plugin_0 = $vanderweb_accordions_shortcodes_options['load_bootstrap_4_6_from_the_plugin_0'];
		$load_bootstrap_icons_1_2_from_the_plugin_1 = $vanderweb_accordions_shortcodes_options['load_bootstrap_icons_1_2_from_the_plugin_1'];

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vanderweb-bs4-accordion-public.css', array(), $this->version, 'all' );

		if($load_bootstrap_4_6_from_the_plugin_0 == 'true'):
			wp_enqueue_style('bootstrap4', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), '4.6', 'all' );		
		endif;
		if($load_bootstrap_icons_1_2_from_the_plugin_1 == 'true'):
			wp_enqueue_style('bootstrap-icons', plugin_dir_url( __FILE__ ) . 'css/bootstrap-icons/bootstrap-icons.css', array(), '1.3', 'all' );
		endif;
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/** 
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vanderweb_Bs4_Accordion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vanderweb_Bs4_Accordion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$vanderweb_accordions_shortcodes_options = get_option( 'vanderweb_accordions_shortcodes_option_name' );
		$load_bootstrap_4_6_from_the_plugin_0 = $vanderweb_accordions_shortcodes_options['load_bootstrap_4_6_from_the_plugin_0'];

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vanderweb-bs4-accordion-public.js', array( 'jquery' ), $this->version, false );
		
		if($load_bootstrap_4_6_from_the_plugin_0 == 'true'):
			wp_enqueue_script( 'Bootstrap4', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array( 'jquery' ), '4.6', false );
		endif;
	}
	
	function vanderweb_accordions_func( $atts ){
		$a = shortcode_atts( array(
		 'slug' => '',
		 'class' => '',
		 'count' => 50,
		 'order' => 'ASC', // ASC, DESC
		 'orderby' => 'menu_order', // none, ID, author, title, name, type, date, modified, parent, rand, menu_order,
		 'open' => 'first', // first, all, none
		 'icons' => 'right', // right, left, none
		   ), $atts );
		$slug = $a['slug'];
		$class = $a['class'];
		$count = $a['count'];
		$order = $a['order'];
		$orderby = $a['orderby'];
		$open = $a['open'];
		$icons = $a['icons'];
		
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'vanderweb_acc_section',
					'field' => 'slug',
					'terms' => array( $slug )
				),
			),
			'post_type' => 'vanderweb_accordions',
			'order' => $order,
			'orderby' => $orderby,
			'posts_per_page' => $count
		);
	 
		$accordion_loop = new WP_Query($args);
		$accordionhtml = '';
		$i= 0 ;
		$item_count = $accordion_loop->found_posts;
	 
		if ( $accordion_loop->have_posts() ):
			ob_start(); 
			?>
			<style>
				.vanderweb-bs4-accordions.icons-left .card-header span {
					padding-left: 6px;
				}
				.vanderweb-bs4-accordions.icons-none .card-header i {
					display: none !important;
				}
			</style>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					// Add minus icon for collapse element which is open by default
					jQuery(".collapse.show").each(function(){
						jQuery(this).prev(".card-header").find(".bi").addClass("bi-dash").removeClass("bi-plus");
					});
					
					// Toggle plus minus icon on show hide of collapse element
					jQuery(".collapse").on('show.bs.collapse', function(){
						jQuery(this).prev(".card-header").find(".bi").removeClass("bi-plus").addClass("bi-dash");
					}).on('hide.bs.collapse', function(){
						jQuery(this).prev(".card-header").find(".bi").removeClass("bi-dash").addClass("bi-plus");
					});
				});
			</script>
			<?php
			$accordionhtml .= ob_get_clean();
			$accordionhtml .= '<div id="vanderweb-bs4-accordions-'.$slug.'" class="accordion vanderweb-bs4-accordions icons-'.$icons.' '.$class.' item-total-'.$item_count.'">';
			while( $accordion_loop->have_posts() ){
				$accordion_loop->the_post();
				$title = get_the_title();
				$desc = get_the_content();
				if( $i == 0  ) {
					$collapsed = '';
				}else{
					$collapsed = 'collapsed';
				}
				if( $i == 0 && $open == 'first' ) {
					$showitem = 'show';	
				}elseif($open == 'all') {
					$showitem = 'show';
				}else{
					$showitem = '';
					
				}

				// Item - Start 
				$accordionhtml .= '<div class="card">';
					$accordionhtml .= '<div class="card-header px-1 py-3 '.$collapsed.'" id="heading-'.$slug.'-'.$i.'">';
						$accordionhtml .= '<h2 class="card-title m-0">';
							$accordionhtml .= '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-'.$slug.'-'.$i.'" aria-expanded="true" aria-controls="collapse-'.$slug.'-'.$i.'">';
								$accordionhtml .= '<i class="bi bi-plus float-'.$icons.'"></i>';
								$accordionhtml .= '<span>'.$title.'</span>';
							$accordionhtml .= '</button>';
						$accordionhtml .= '</h2>'; // .card-title
					$accordionhtml .= '</div>'; // .card-header
				
					$accordionhtml .= '<div id="collapse-'.$slug.'-'.$i.'" class="collapse '.$showitem.'" aria-labelledby="heading-'.$slug.'-'.$i.'" data-parent="#vanderweb-bs4-accordions-'.$slug.'">';
						$accordionhtml .= '<div class="card-body">';
							$accordionhtml .= $desc;
						$accordionhtml .= '</div>'; // .card-body
					$accordionhtml .= '</div>'; // .collapse
				$accordionhtml .= '</div>'; // .card
				// Item - End
				$i++;
			}
			wp_reset_query();
			wp_reset_postdata();
			$accordionhtml .= '</div>'; // .vanderweb-accordion-bs4-inner
			
		endif;
	 
		return $accordionhtml;
	}
	
	function vanderweb_tabs_func( $atts ){
		$a = shortcode_atts( array(
		 'slug' => '',
		 'class' => '',
		 'count' => 50,
		 'order' => 'ASC', // ASC, DESC
		 'orderby' => 'menu_order', // none, ID, author, title, name, type, date, modified, parent, rand, menu_order,
		   ), $atts );
		$slug = $a['slug'];
		$class = $a['class'];
		$count = $a['count'];
		$order = $a['order'];
		$orderby = $a['orderby'];
		
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'vanderweb_acc_section',
					'field' => 'slug',
					'terms' => array( $slug )
				),
			),
			'post_type' => 'vanderweb_accordions',
			'order' => $order,
			'orderby' => $orderby,
			'posts_per_page' => $count
		);
	 
		$tabs_loop = new WP_Query($args);
		$tabshtml = '';
		$tabsnav = '';
		$tabscontent = '';
		$i= 0 ;
		$item_count = $tabs_loop->found_posts;
	 
		if ( $tabs_loop->have_posts() ):
			$tabshtml .= '<div class="vanderweb-bs4-tabs '.$class.' item-total-'.$item_count.'">';
				while( $tabs_loop->have_posts() ){
					$tabs_loop->the_post();
					$title = get_the_title();
					$desc = get_the_content();
					if( $i == 0 ) {
						$activeitem = 'active';
						$activecontentitem = 'show active';
						$selecteditem = 'true';
					}else{
						$activeitem = '';
						$activecontentitem = '';
						$selecteditem = 'false';
					}
					// Item - Start
					$tabsnav .= '<li class="nav-item m-0 mr-1">';
						$tabsnav .= '<a class="nav-link '.$activeitem.'" id="tab-'.$slug.'-'.$i.'" data-toggle="tab" href="#content-'.$slug.'-'.$i.'" role="tab" aria-controls="content-'.$slug.'-'.$i.'" aria-selected="'.$selecteditem.'">';
							$tabsnav .= $title;
						$tabsnav .= '</a>'; // .nav-link
					$tabsnav .= '</li>'; // .nav-item
					
					$tabscontent .= '<div class="tab-pane pt-3 fade '.$activecontentitem.'" id="content-'.$slug.'-'.$i.'" role="tabpanel" aria-labelledby="tab-'.$slug.'-'.$i.'">';
						$tabscontent .= $desc;
					$tabscontent .= '</div>'; // .nav-item
					// Item - End
					$i++;
				}
				$tabshtml .= '<ul class="nav nav-tabs m-0" id="vanderweb-bs4-tabs-'.$slug.'" role="tablist">';
					$tabshtml .= $tabsnav;
				$tabshtml .= '</ul>'; // .nav-tabs
				$tabshtml .= '<div class="tab-content" id="vanderweb-bs4-content-'.$slug.'">';
					$tabshtml .= $tabscontent;
				$tabshtml .= '</div>'; // .tab-content
				wp_reset_query();
				wp_reset_postdata();
			$tabshtml .= '</div>'; // .vanderweb-bs4-tabs
		endif;
	 
		return $tabshtml;
	}
}
