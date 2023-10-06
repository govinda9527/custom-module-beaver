<?php
for ( $i = 0; $i < $number_testimonials; $i ++ ) :
	$testimonials = $settings->testimonials[ $i ];
	?>
    <div class="gocmbb-testimonial-body layout_<?php echo $settings->testimonial_layout; ?>">
        <div class="gocmbb-testimonial-body-inner">
            <div class="gocmbb-testimonial-body-quote-box">
                <div class="gocmbb-testimonial-quote-box-content">
					<?php $module->gocmbb_profile_image_render( $i ); ?>
					<?php $module->gocmbb_profile_name( $i ); ?>
					<?php $module->gocmbb_profile_designation( $i ); ?>
					<?php $module->gocmbb_profile_ratings( $i ); ?>
                    <div class="gocmbb-testimonial-content-warpper">
						<?php $module->gocmbb_left_quotesign(); ?>
						<?php $module->gocmbb_profile_content( $i ); ?>
						<?php $module->gocmbb_right_quotesign(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endfor; ?>
