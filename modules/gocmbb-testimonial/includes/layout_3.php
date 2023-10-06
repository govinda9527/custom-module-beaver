<?php
for ( $i = 0; $i < $number_testimonials; $i ++ ) :
	$testimonials = $settings->testimonials[ $i ];
	?>
    <div class="gocmbb-testimonial-body layout_<?php echo $settings->testimonial_layout; ?>">
        <div class="gocmbb-testimonial-body-left">
			<?php $module->gocmbb_profile_image_render( $i ); ?>
        </div>
		<?php if ( $settings->show_indicator === 'yes' ){ ?>
        <div class="gocmbb-testimonial-body-indicator ">
			<?php } ?>
            <div class="gocmbb-testimonial-body-right">
				<?php $module->gocmbb_profile_content( $i ); ?>
				<?php $module->gocmbb_profile_name( $i ); ?>
				<?php $module->gocmbb_profile_designation( $i ); ?>
				<?php $module->gocmbb_profile_ratings( $i ); ?>
            </div>
			<?php if ( $settings->show_indicator === 'yes' ){ ?>
        </div>
	<?php } ?>
    </div>
<?php endfor; ?>
