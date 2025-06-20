<?php
/**
 * 'hbupro_banner' Shortcode
 * 
 * @package Hero Banner Ultimate
 * @version 1.4.5
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function hbu_shortcode( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'id'	=> 0,
	), $atts));

	// If id is not there then return
	if ( empty($id) ) {
		return $content;
	}

	// Taking some variables
	$prefix = HBU_META_PREFIX; // Metabox prefix

	// Getting post data
	$unique		= hbu_get_unique();	
	$post_data	= get_post($id);

	ob_start();

	// If it is button post type and post is publish
	if ( isset($post_data->post_type) && $post_data->post_type == HBU_POST_TYPE && 'publish' == $post_data->post_status ) {

		// Getting button type
		$banner_type				= get_post_meta( $id, $prefix . 'banner_type', true );
		$banner_layout				= get_post_meta( $id, $prefix . 'banner_layout', true );
		$banner_bg_color			= get_post_meta( $id, $prefix . 'banner_bg_color', true );
		$banner_image_url			= get_post_meta( $id, $prefix . 'banner_image_url', true );
		$banner_bg_size				= get_post_meta( $id, $prefix . 'banner_bg_size', true );
		$banner_bg_attachemnt		= get_post_meta( $id, $prefix . 'banner_bg_attachemnt', true );
		$banner_bg_position			= get_post_meta( $id, $prefix . 'banner_bg_position', true );
		$banner_padding_top			= get_post_meta( $id, $prefix . 'banner_padding_top', true );
		$banner_padding_right		= get_post_meta( $id, $prefix . 'banner_padding_right', true );
		$banner_padding_bottom		= get_post_meta( $id, $prefix . 'banner_padding_bottom', true );
		$banner_padding_left		= get_post_meta( $id, $prefix . 'banner_padding_left', true );
		$banner_video_url			= get_post_meta( $id, $prefix . 'banner_video_url', true );
		$banner_vmvideo_url			= get_post_meta( $id, $prefix . 'banner_vmvideo_url', true );
		$banner_ovelay_color		= get_post_meta( $id, $prefix . 'banner_ovelay_color', true );
		$banner_ovelay_opacity		= get_post_meta( $id, $prefix . 'banner_ovelay_opacity', true );
		$banner_title_color			= get_post_meta( $id, $prefix . 'banner_title_color', true );
		$banner_content_color		= get_post_meta( $id, $prefix . 'banner_content_color', true );
		$banner_title_fontsize		= get_post_meta( $id, $prefix . 'banner_title_fontsize', true );
		$banner_subtitle_fontsize	= get_post_meta( $id, $prefix . 'banner_subtitle_fontsize', true );
		$banner_button_one_name		= get_post_meta( $id, $prefix . 'banner_button_one_name', true );
		$banner_button_one_link		= get_post_meta( $id, $prefix . 'banner_button_one_link', true );
		$banner_button_two_name		= get_post_meta( $id, $prefix . 'banner_button_two_name', true );
		$banner_button_two_link		= get_post_meta( $id, $prefix . 'banner_button_two_link', true );
		$banner_wrap_width			= get_post_meta( $id, $prefix . 'banner_wrap_width', true );
		$banner_button_one_class	= get_post_meta( $id, $prefix . 'banner_button_one_class', true );
		$banner_button_two_class	= get_post_meta( $id, $prefix . 'banner_button_two_class', true );

		$banner_type					= ! empty( $banner_type )					? $banner_type					: 'bgcolor';

		// SECURITY FIX: Whitelist allowed banner layouts to prevent LFI
		$allowed_layouts = array(
			'layout-1',
			'layout-2', 
			'layout-3',
			'layout-4'
		);

		// Validate banner layout against whitelist
		$banner_layout = ! empty( $banner_layout ) && in_array( $banner_layout, $allowed_layouts, true ) 
			? $banner_layout 
			: 'layout-1'; // Default to layout-1 if invalid

		$banner_image_url				= ! empty( $banner_image_url )				? $banner_image_url				: '';
		
		$banner_bg_color_set			= ! empty( $banner_bg_color )				? $banner_bg_color				: '';
		$banner_title_fontsize_set		= ! empty( $banner_title_fontsize )			? $banner_title_fontsize		: 40;
		$banner_subtitle_fontsize_set	= ! empty( $banner_subtitle_fontsize )		? $banner_subtitle_fontsize 	: 20;
		$banner_title_color_set			= ! empty( $banner_title_color )			? $banner_title_color			: '#fff';
		$banner_content_color_set		= ! empty( $banner_content_color )			? $banner_content_color			: '#fff';
		$banner_ovelay_opacity_set		= ! empty( $banner_ovelay_opacity )			? $banner_ovelay_opacity		: '0.5';
		$banner_ovelay_color_set		= ! empty( $banner_ovelay_color )			? $banner_ovelay_color			: '';
		$banner_bg_size_set				= ! empty( $banner_bg_size )				? $banner_bg_size				: 'cover';
		$banner_bg_attachemnt_set 		= ! empty( $banner_bg_attachemnt )			? $banner_bg_attachemnt			: 'scroll';
		$banner_bg_position_set 		= ! empty( $banner_bg_position )			? $banner_bg_position			: 50;
		$banner_padding_top_set 		= ! empty( $banner_padding_top )			? $banner_padding_top			: '150px';
		$banner_padding_right_set 		= ! empty( $banner_padding_right )			? $banner_padding_right			: '0px';
		$banner_padding_bottom_set 		= ! empty( $banner_padding_bottom )			? $banner_padding_bottom		: '150px';
		$banner_padding_left_set 		= ! empty( $banner_padding_left )			? $banner_padding_left			: '0px';
		$banner_wrap_width_set 			= ! empty( $banner_wrap_width )				? $banner_wrap_width			: '';

		$banner_video_url				= ! empty( $banner_video_url )				? $banner_video_url				: '';
		$banner_vmvideo_url				= ! empty( $banner_vmvideo_url )			? $banner_vmvideo_url			: '';
		$banner_button_one_name			= ! empty( $banner_button_one_name )		? $banner_button_one_name		: '';
		$banner_button_one_link			= ! empty( $banner_button_one_link )		? $banner_button_one_link		: '';
		$banner_button_two_name			= ! empty( $banner_button_two_name )		? $banner_button_two_name		: '';
		$banner_button_two_link			= ! empty( $banner_button_two_link )		? $banner_button_two_link		: '';
		
		$banner_button_one_class		= ! empty( $banner_button_one_class )		? $banner_button_one_class		: '';
		$banner_button_two_class		= ! empty( $banner_button_two_class )		? $banner_button_two_class		: '';
		?>

		<style type="text/css">
			<?php if ( 'bgcolor' == $banner_type ) : ?>
				.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner{background-color: <?php echo esc_attr($banner_bg_color_set); ?>;}
			<?php endif;
			if ( 'bgcolor_image' == $banner_type ) : ?>
				.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner{background-color: <?php echo esc_attr($banner_bg_color_set); ?>;background-image: url(<?php echo esc_url($banner_image_url); ?>);background-size: <?php echo esc_attr($banner_bg_size_set); ?>;background-position: <?php echo esc_attr($banner_bg_position_set); ?>% center;background-attachment: <?php echo esc_attr($banner_bg_attachemnt_set); ?>}
			<?php endif;
			if ( 'image' == $banner_type ) : ?>
				.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner{ background-image: url(<?php echo esc_url($banner_image_url); ?>);background-size: <?php echo esc_attr($banner_bg_size_set); ?>;background-position: <?php echo esc_attr($banner_bg_position_set); ?>% center;background-attachment: <?php echo esc_attr($banner_bg_attachemnt_set); ?>}
			<?php endif;
			if (!empty($banner_ovelay_color)) : ?>
				.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner .hbupro-hero-banner-inner{background-color:<?php echo esc_attr( $banner_ovelay_color_set ); ?>;opacity: <?php echo esc_attr( $banner_ovelay_opacity_set ); ?>;}
			<?php endif;
			if ( 'video' == $banner_type ) : ?>
				.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner{background: none !important;}
			<?php endif;
			if ( 'video_image' == $banner_type ) : ?>
				.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner-inner{background-image: url(<?php echo esc_url($banner_image_url); ?>);background-size: <?php echo esc_attr($banner_bg_size_set); ?>;background-position: <?php echo esc_attr($banner_bg_position_set); ?>% center;background-attachment: <?php echo esc_attr($banner_bg_attachemnt_set); ?>}
			<?php endif; ?>
			.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner-inner-wrap{max-width: <?php echo esc_attr($banner_wrap_width_set); ?>px;}
			.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner h2.hbupro-hero-banner-title{font-size: <?php echo esc_attr($banner_title_fontsize_set); ?>px !important;line-height: <?php echo esc_attr($banner_title_fontsize_set); ?>px !important;color: <?php echo esc_attr($banner_title_color_set); ?> }
			.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner .hbupro-hero-banner-sub-title p, .hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner .hbupro-hero-banner-sub-title{font-size: <?php echo esc_attr($banner_subtitle_fontsize_set); ?>px !important;color: <?php echo esc_attr($banner_content_color_set); ?>}
			.hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> .hbupro-hero-banner-inner{padding: <?php echo esc_attr($banner_padding_top_set); ?> <?php echo esc_attr($banner_padding_right_set); ?> <?php echo esc_attr($banner_padding_bottom_set); ?> <?php echo esc_attr($banner_padding_left_set); ?>}
		</style>

		<?php

		// Shortcode file
		// SECURITY FIX: Secure file inclusion with validation
		$banner_design_file_path = HBU_DIR . '/templates/' . $banner_layout . '.php';
		
		// Double-check that the file exists and is within the templates directory
		$design_file = '';
		if ( file_exists( $banner_design_file_path ) ) {
			// Additional security: Ensure the real path is within the templates directory
			$real_path = realpath( $banner_design_file_path );
			$templates_dir = realpath( HBU_DIR . '/templates/' );
			
			if ( $real_path && $templates_dir && strpos( $real_path, $templates_dir ) === 0 ) {
				$design_file = $banner_design_file_path;
			}
		}
		
		// Some Post Variable
		$banner_title		= $post_data->post_title;
		$hbupro_content		= $post_data->post_content;
		$popup_content		= hbu_render_hero_banner_content( $hbupro_content );

		// Video Condition
		if ( 'video_image' == $banner_type || 'video' == $banner_type ) { 
			
			// video conf
			$video_conf = compact( 'banner_video_url', 'banner_vmvideo_url' );

			// Video script file 
			wp_enqueue_script( 'hbu-video-script' );
			wp_enqueue_script( 'hbu-public-script' );
		} ?>

		<div class="hbupro-hero-banner-wrp-<?php echo esc_attr($unique); ?> hbupro-clearfix hbupro-<?php echo esc_attr($banner_layout); ?>">
			<div class="hbupro-hero-banner hbupro-clearfix">

			<?php if ( 'video_image' == $banner_type || 'video' == $banner_type ) : ?>
				<div id="player-<?php echo esc_attr($unique); ?>" class="container-player hbu-container-player" data-conf="<?php echo htmlspecialchars( json_encode( $video_conf ) ); ?>"></div>
			<?php endif;
				// SECURITY FIX: Only include file if it passed all security checks
				if ( !empty($design_file) ) {
					include( $design_file );
				}
			?>
			</div>
		</div>

	<?php }

	wp_reset_postdata(); 
	$content .= ob_get_clean();
	return $content;
}
// 'popup_anything' shortcode
add_shortcode('hbupro_banner', 'hbu_shortcode');
