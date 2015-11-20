<?php

/*

@package sunsettheme

	==================
		ADMIN PAGE 
	==================
*/

function sunset_add_administration_panel(){
	
	//generate sunset admin page
	add_menu_page( 'Sunset Theme Options', 'Sunset', 'manage_options', 'abriel_sunset', 'sunset_theme_create_page', 'dashicons-palmtree', 110 );
	
	//generate admin sub-pages
	add_submenu_page( 'abriel_sunset', 'Sunset Theme Options', 'General', 'manage_options', 'abriel_sunset', 'sunset_theme_create_page' );
	add_submenu_page( 'abriel_sunset', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'abriel_sunset_css', 'sunset_theme_settings_page' );
	
	//Activate custom settings
	add_action('admin_init', 'sunset_custom_settings');
}
add_action('admin_menu', 'sunset_add_administration_panel');

function sunset_custom_settings() {
	register_setting('sunset-settings-group', 'profile_picture');
	register_setting('sunset-settings-group', 'first_name');
	register_setting('sunset-settings-group', 'last_name');
	register_setting('sunset-settings-group', 'user_description');
	register_setting('sunset-settings-group', 'twitter_handler', 'sunset_sanitize_twitter_handler');
	register_setting('sunset-settings-group', 'facebook_handler');
	register_setting('sunset-settings-group', 'google+_handler');
	
	
	add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'abriel_sunset');
	
	add_settings_field('sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'abriel_sunset', 'sunset-sidebar-options');
	add_settings_field('sidebar-name', 'Full Name', 'sunset_sidebar_name', 'abriel_sunset', 'sunset-sidebar-options');
	add_settings_field('sidebar-description', 'Description', 'sunset_sidebar_description', 'abriel_sunset', 'sunset-sidebar-options');
	add_settings_field('sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'abriel_sunset', 'sunset-sidebar-options');
	add_settings_field('sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'abriel_sunset', 'sunset-sidebar-options');
	add_settings_field('sidebar-google+', 'Google+ handler', 'sunset_sidebar_google', 'abriel_sunset', 'sunset-sidebar-options');
	
}
function sunset_sidebar_options(){
	echo 'Customize your Sidebar Information';
}

function sunset_sidebar_profile() {
	$image = esc_attr( get_option( 'profile_picture' ) );
	echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><input type="hidden" id="profile-picture" name="profile_picture" value="'.$image.'" />';
}
function sunset_sidebar_name() {
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}
function sunset_sidebar_description(){
	$description = esc_attr( get_option( 'user_description' ) );
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" />';	
}
function sunset_sidebar_twitter(){
	$twitter = esc_attr( get_option( 'twitter_handler' ) );
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" /><p class="description">Input your Twitter username without the @ character.</p>';	
}
function sunset_sidebar_facebook(){
	$facebook = esc_attr( get_option( 'facebook_handler' ) );
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler" />';	
}
function sunset_sidebar_google(){
	$google = esc_attr( get_option( 'google+_handler' ) );
	echo '<input type="text" name="google+_handler" value="'.$google.'" placeholder="Google+ Handler" />';	
}
//sanitization settings
function sunset_sanitize_twitter_handler( $input ) {
	$output = sanitize_text_field( $input );
	$output = str_replace('@','', $output);
	return $output;
}



function sunset_theme_create_page(){
	require_once( get_template_directory().'/inc/templates/sunset-admin.php' );
}

function sunset_theme_settings_page(){
	//generation of our admin page
}