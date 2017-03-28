<?php
/**
 * Display Single Speaker 
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Eventum
 * @version     1.0
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

get_header();
?>

<section id="main" class="clearfix">

	<?php require_once 'sub-header.php'; ?>
	<div class="container">

			<?php while(have_posts()): the_post(); ?>

					<?php
					$designation = rwmb_meta('themeum_designation');
					$facebook = rwmb_meta('themeum_facebook_url');
					$soundcloud = rwmb_meta('themeum_soundcloud_url');
					$twitter = rwmb_meta('themeum_twitter_url');
					$dribbble = rwmb_meta('themeum_dribbble_url');
					$flickr = rwmb_meta('themeum_flickr_url');
					$google = rwmb_meta('themeum_google_url');
					$pinterest = rwmb_meta('themeum_pinterest_url');
					$youtube = rwmb_meta('themeum_youtube_url');
					$linkedin = rwmb_meta('themeum_linkedin_url');
					$behance = rwmb_meta('themeum_behance_url');
					$vk = rwmb_meta('themeum_vk_url');
					$skype = rwmb_meta('themeum_skype_url');
					$instagram = rwmb_meta('themeum_instagram_url');
					?>


					<div class="row">
							<div class="col-sm-5">
								<?php
									if (has_post_thumbnail( $post->ID ) ): 
									  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'speaker-thumb' );
									  echo '<img class="img-responsive" src="'.esc_url($image[0]).'" alt="'.get_the_title().'">';
									endif;
								?>
							</div>

							<div class="col-sm-7">

								<h2 class="speaker-title"><?php the_title(); ?></h2>
								<p class="lead speaker-designation"><?php echo esc_attr($designation); ?></p>

									<div class="speaker-social-icons">
										<ul>
											<?php if( $facebook != '' ){ ?>
												<li>
													<a target="_blank" class="social-facebook" href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a>
												</li>
											<?php } ?>
											<?php if( $soundcloud != '' ){ ?>
												<li>
													<a target="_blank" class="social-soundcloud" href="<?php echo esc_url($soundcloud); ?>"><i class="fa fa-soundcloud"></i></a>
												</li>
											<?php } ?>
											<?php if( $twitter != '' ){ ?>
												<li>
													<a target="_blank" class="social-twitter" href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
												</li>
											<?php } ?>
											<?php if( $dribbble != '' ){ ?>
												<li>
													<a target="_blank" class="social-dribbble" href="<?php echo esc_url($dribbble); ?>"><i class="fa fa-dribbble"></i></a>
												</li>
											<?php } ?>
											<?php if( $flickr != '' ){ ?>
												<li>
													<a target="_blank" class="social-flickr" href="<?php echo esc_url($flickr); ?>"><i class="fa fa-flickr"></i></a>
												</li>
											<?php } ?>
											<?php if( $google != '' ){ ?>
												<li>
													<a target="_blank" class="social-google-plus" href="<?php echo esc_url($google); ?>"><i class="fa fa-google-plus"></i></a>
												</li>
											<?php } ?>
											<?php if( $pinterest != '' ){ ?>
												<li>
													<a target="_blank" class="social-pinterest" href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest"></i></a>
												</li>
											<?php } ?>
											<?php if( $youtube != '' ){ ?>
												<li>
													<a target="_blank" class="social-youtube" href="<?php echo esc_url($youtube); ?>"><i class="fa fa-youtube"></i></a>
												</li>
											<?php } ?>
											<?php if( $linkedin != '' ){ ?>
												<li>
													<a target="_blank" class="social-linkedin" href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
												</li>
											<?php } ?>
											<?php if( $behance != '' ){ ?>
												<li>
													<a target="_blank" class="social-behance" href="<?php echo esc_url($behance); ?>"><i class="fa fa-behance"></i></a>
												</li>
											<?php } ?>
											<?php if( $vk != '' ){ ?>
												<li>
													<a target="_blank" class="social-vk" href="<?php echo esc_url($vk); ?>"><i class="fa fa-vk"></i></a>
												</li>
											<?php } ?>
											<?php if( $skype != '' ){ ?>
												<li>
													<a target="_blank" class="social-skype" href="skype:<?php echo esc_url($skype); ?>?chat"><i class="fa fa-skype"></i></a>
												</li>
											<?php } ?>
											<?php if( $instagram != '' ){ ?>
												<li>
													<a target="_blank" class="social-instagram" href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram"></i></a>
												</li>
											<?php } ?>
										</ul>
									</div>
								
								<div class="speaker-description"><?php the_content(); ?></div>
							</div>
						</div>


			<?php endwhile; ?>
	</div><!--/.container-->
</section>
<?php get_footer();





