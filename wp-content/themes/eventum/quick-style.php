<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;

$output = '';

$headerbg = $themeum_options['header-bg'];
if(isset($headerbg)){
	$output .= '.header{ background: '.esc_attr($themeum_options['header-bg']) .'; }';
}

if ($themeum_options['header-fixed']){

	if(isset($headerbg)){
		$output .= '#masthead.sticky{ background-color: rgba('.esc_attr(themeum_hex2rgb($headerbg)).',.95); }';
	}
	$output .= '#masthead.sticky{ position:fixed;top:0; z-index:99999;margin:0 auto 30px; width:100%;box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.22);}';
	$output .= '#masthead.sticky #header-container{ padding:0;transition: padding 200ms linear; -webkit-transition:padding 200ms linear;}';
	$output .= '#masthead.sticky .navbar.navbar-default{ background: rgba(255,255,255,.95); border-bottom:1px solid #f5f5f5}';
}

if(isset($themeum_options['header-font-color'])){
	$output .= '#main-menu .nav>li>a{ color: '.esc_attr($themeum_options['header-font-color']) .'; }';
}
if(isset($themeum_options['menu-color'])){
	$output .= '#main-menu .nav>li>a:hover{ color: '.esc_attr($themeum_options['menu-color']) .'; }';
}

if(isset($themeum_options['ticket-menu-bg-color'])){
	$output .= '#main-menu .nav>li.ticket-menu a{ background-color: '.esc_attr($themeum_options['ticket-menu-bg-color']) .'; }';
}
if(isset($themeum_options['ticket-menu-bg-hover-color'])){
	$output .= '#main-menu .nav>li.ticket-menu a:hover{ background-color: '.esc_attr($themeum_options['ticket-menu-bg-hover-color']) .'; }';
}

#submenu subheader-title-bg

if( $themeum_options['subheader-title-bg'] == 0 ){
	$output .= '.sub-title-inner h2{ background: none; }';
}

if(isset($themeum_options['submenu-text-color'])){
	$output .= '#main-menu .nav>li>ul li a{ color: '.esc_attr($themeum_options['submenu-text-color']) .'; }';
}
if(isset($themeum_options['submenu-hover-bg'])){
	$output .= '#main-menu .nav>li>ul li:hover{ background-color: '.esc_attr($themeum_options['submenu-hover-bg']) .'; }';
}
if(isset($themeum_options['submenu-text-hover-color'])){
	$output .= '#main-menu .nav>li>ul li a:hover{ color: '.esc_attr($themeum_options['submenu-text-hover-color']) .'; }';
}

// .sub-title-inner h2
if(isset($themeum_options['subheader-title-bg'])){
	$output .= '.sub-title-inner h2{ color: '.esc_attr($themeum_options['subheader-title-bg']) .'; }';
}




if(isset($themeum_options['subheader-title-color'])){
	$output .= '.sub-title-inner h2{ color: '.esc_attr($themeum_options['subheader-title-color']) .'; }';
}

if(isset($themeum_options['header-font-size'])){
	$output .= '.sub-title-inner h2{ font-size: '.esc_attr($themeum_options['header-font-size']) .'px; }';
}

if(isset($themeum_options['breadcrumb-text-color'])){
	$output .= '.sub-title .breadcrumb, .sub-title .breadcrumb>li>a, .breadcrumb>li+li:before, .sub-title .breadcrumb>.active{ color: '.esc_attr($themeum_options['breadcrumb-text-color']) .'; }';
}

if(isset($themeum_options['breadcrumb-font-size'])){
	$output .= '.sub-title .breadcrumb{ font-size: '.esc_attr($themeum_options['breadcrumb-font-size']) .'px; }';
}

if(isset($themeum_options['subheader-margin-bottom'])){
	$output .= '.sub-title{ margin-bottom: '.esc_attr($themeum_options['subheader-margin-bottom']) .'px; }';
}
# End ...









if(isset($themeum_options['footer-bg-color'])){
	$output .= 'footer{ background-color: '.esc_attr($themeum_options['footer-bg-color']) .'; }';
}

if(isset($themeum_options['footer-text-color'])){
	$output .= '.footer-wrap-inner .copyright, footer .social-icons i{ color: '.esc_attr($themeum_options['footer-text-color']) .'; }';
}

if($themeum_options['logo-width']){
	$output .= '.logo-wrapper .navbar-brand>img{ width: '. (int) esc_attr($themeum_options['logo-width']) .'px; }';
}
if($themeum_options['logo-height']){
	$output .= '.logo-wrapper .navbar-brand>img{ height: '. (int) esc_attr($themeum_options['logo-height']) .'px; }';
}

if(isset($themeum_options['header-padding-top'])){
	$output .= '.site-header{ padding-top: '. (int) esc_attr($themeum_options['header-padding-top']) .'px; }';
}

if(isset($themeum_options['header-height'])){
	$output .= '.site-header{ min-height: '. (int) esc_attr($themeum_options['header-height']) .'px; }';
}

if(isset($themeum_options['header-padding-bottom'])){
	$output .= '.site-header{ padding-bottom: '. (int) esc_attr($themeum_options['header-padding-bottom']) .'px; }';
}

if(isset($themeum_options['footer-bg'])){
	$output .= '#footer{ background: '.esc_attr($themeum_options['footer-bg']) .'; }';
}


if (isset($themeum_options['comingsoon-en']) && $themeum_options['comingsoon-en']) {
	$output .= "body {
		background: #fff;
		display: table;
		width: 100%;
		height: 100%;
		min-height: 100%;
	}";
}


//404 background
$output .= ".error-page-inner{
	width: 100%;
    height: 100%;
    min-height: 100%;
    position: absolute;
    background: url(".esc_url($themeum_options['errorpage']['url']).") no-repeat 100% 0; 
    background-size: contain;
}";


if(isset($themeum_options['custom-css'])){
	$output .= $themeum_options['custom-css'];
}

echo $output;

