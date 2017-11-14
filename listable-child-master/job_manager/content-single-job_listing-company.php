<?php
/**
 * Single view Company information box
 *
 * Hooked into single_job_listing_start priority 30
 *
 * @since  1.14.0
 */

global $post;
// get our custom meta
//$facebook_url = get_post_meta( get_the_ID(), '_company_facebook', true);
$location = get_post_meta( get_the_ID(), '_job_location', true);
$phone = get_post_meta( get_the_ID(), '_company_phone', true);
$twitter = get_post_meta( get_the_ID(), '_company_twitter', true);
//additional meta key
$min_budget = get_post_meta( get_the_ID(), '_org_min_budget', true);
$max_budget = get_post_meta( get_the_ID(), '_org_max_budget', true);
$min_pax = get_post_meta( get_the_ID(), '_org_mix_pax', true);
$max_pax = get_post_meta( get_the_ID(), '_org_max_pax', true);
$org_grade = get_post_meta( get_the_ID(), '_org_grade', true);
$area_outdoor = get_post_meta( get_the_ID(), '_area_type_outdoor', true);
$area_indoor = get_post_meta( get_the_ID(), '_area_type_indoor', true);
$area_hasil1  = "";$area_hasil2  = "";
?>
<div class="single-meta">
	<?php
	display_average_listing_rating();

	if ( ! empty( $phone ) ) :
		if ( strlen( $phone ) > 30 ) : ?>
			<a class="listing-contact  listing--phone" href="tel:<?php echo $phone; ?>" itemprop="telephone"><?php esc_html_e( 'Phone', 'listable' ); ?></a>
		<?php else : ?>
			<a class="listing-contact  listing--phone" href="tel:<?php echo $phone; ?>" itemprop="telephone"><?php echo $phone; ?></a>
		<?php endif; ?>
	<?php endif;

	do_action( 'listable_single_job_listing_before_social_icons' );

	if ( ! empty( $twitter ) ) {
		$twitter = preg_replace("[@]", "", $twitter);
		if ( strlen( $twitter ) > 30 ) : ?>
			<a class="listing-contact  listing--twitter" href="https://twitter.com/<?php echo $twitter; ?>" itemprop="url"> <?php esc_html_e( 'Twitter', 'listable' ); ?></a>
		<?php else : ?>
			<a class="listing-contact  listing--twitter" href="https://twitter.com/<?php echo $twitter; ?>" itemprop="url">@<?php echo $twitter; ?></a>
		<?php endif; ?>
	<?php }

	/** temporary(or not) removed
	if ( ! empty( $facebook_url ) ) { ?>
		<!--a class="company_facebook"" href="<?php echo $facebook_url ?>"><?php _e( 'Facebook', 'listable'); ?></a-->
	<?php }
	 */
	
	do_action( 'listable_single_job_listing_after_social_icons' );

	if ( $website = get_the_company_website() ) {
		$website_pure = preg_replace('#^https?://#', '', rtrim(esc_url($website),'/'));
		if ( strlen( $website_pure ) > 30 ) : ?>
			<a class="listing-contact  listing--website" href="<?php echo esc_url( $website ); ?>" itemprop="url" target="_blank" rel="nofollow"><?php esc_html_e( 'Website', 'listable' ); ?></a>
		<?php else : ?>
			<a class="listing-contact  listing--website" href="<?php echo esc_url( $website ); ?>" itemprop="url" target="_blank" rel="nofollow"><?php echo $website_pure; ?></a>
		<?php endif; ?>
	<?php } ?>	
	
	<!-- additional field -->
	
	
	<div class="meta-single-left">
		<div>Min Budget : <?php echo 'Rp '. number_format_i18n($min_budget) ;?></div>
		<div>Max Budget : <?php echo 'Rp '. number_format_i18n($max_budget) ;?></div>
		<div>Grade : <?php echo $org_grade ;?></div>
		<div>Kota : <?php echo get_the_term_list( $post->ID, 'city', '', ', ', '' ) ?></div>		

	</div>
	
	<div class="meta-single-right">
		<div>Min Pax : <?php echo number_format_i18n($min_pax) ;?></div>
		<div>Max Pax : <?php echo number_format_i18n($max_pax) ;?></div>
		
	
		<?php if ($area_indoor == "1" && $area_outdoor == "0") {?>
		<div><?php if (empty($area_hasil1)) { ;?></div>
		<div><?php echo 'Area Type : '. $area_hasil1 = "Indoor" ;?></div>
		<?php } else {?>
		<div> <?php $area_hasil1 = "";?> </div>
		<?php } ?>
		<?php } ?>
		
		<?php if ($area_outdoor == "1" && $area_indoor == "0") { ?>
		<div><?php if (empty($area_hasil2)) { ;?></div>
		<div><?php echo 'Area Type : '.$area_hasil2 = "Outdoor";?></div>
		<?php } else {;?>
		<div> <?php $area_hasil2 = "";?> </div>
		<?php } ?>		
		<?php } ?>	

		
		<?php if ($area_outdoor == "1" && $area_indoor == "1") { ?>
		<div><?php echo 'Area Type : Indoor, Outdoor' ;?></div>
		<?php } else {;?>
		<div> <?php $area_hasil2 = "";?> </div>
		<?php } ?>		


	</div>		
	
</div>


