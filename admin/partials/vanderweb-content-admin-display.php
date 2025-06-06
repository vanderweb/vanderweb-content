<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://vander-web.com/
 * @since      1.0.0
 *
 * @package    Vanderweb_Content
 * @subpackage Vanderweb_Content/admin/partials
 */
 
//get our global options
	global $developer_uri;
	$terms = get_terms( array( 
		'taxonomy' => 'vanderweb_acc_section',
	) );
	$accordions = '';
	$tabs = '';
	if( !empty( $terms ) && !is_wp_error( $terms )){
		foreach( $terms as $term ) {
			$accordions .= '[vanderweb_accordions slug="'.$term->slug.'"]<br />';
			$tabs .= '[vanderweb_tabs slug="'.$term->slug.'"]<br />';
		}
	}else{
		$accordions = '[vanderweb_accordions slug="your-section-slug"]';
		$tabs = '[vanderweb_tabs slug="your-section-slug"]';
	}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2><?php echo __( 'Accordions - Shortcodes', 'vanderweb-content' ); ?></h2>
	<p></p>
	<?php settings_errors(); ?>
	<hr />
	<h3><?php echo __( 'Accordions:', 'vanderweb-content' ); ?></h3>
	<p><?php echo $accordions; ?></p>
	<p><b><?php echo __( 'Shortcode attributes:', 'vanderweb-content' ); ?></b></p>
	<p>slug="<i>your-section-slug</i>"</p>
	<p>class=""</p>
	<p>count="50"</p>
	<p>order="ASC" <br />( ASC, DESC )</p>
	<p>orderby="menu_order" <br />( none, ID, author, title, name, type, date, modified, parent, rand, menu_order )</p>
	<p>open="first" <br />( first, all, none )</p>
	<p>icons="right" <br />( right, left, none )</p>
	<hr />
	<h3><?php echo __( 'Tabs:', 'vanderweb-content' ); ?></h3>
	<p><?php echo $tabs; ?></p>
	<p><b><?php echo __( 'Shortcode attributes:', 'vanderweb-content' ); ?></b></p>
	<p>slug="<i>your-section-slug</i>"</p>
	<p>class=""</p>
	<p>count="50"</p>
	<p>order="ASC" <br />( ASC, DESC )</p>
	<p>orderby="menu_order" <br />( none, ID, author, title, name, type, date, modified, parent, rand, menu_order )</p>
	<br /><hr />
	<form method="post" action="options.php">
		<?php
			settings_fields( 'vanderweb_content_shortcodes_option_group' );
			do_settings_sections( 'vanderweb-content-shortcodes-admin' );
			submit_button();
		?>
	</form>
</div>
