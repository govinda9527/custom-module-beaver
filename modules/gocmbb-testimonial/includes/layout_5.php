<?php
for ( $i = 0; $i < $number_testimonials; $i ++ ) :
	$testimonials = $settings->testimonials[ $i ];
	?>
    <div class="gocmbb-testimonial-body layout_<?php echo $settings->testimonial_layout; ?>">
        <div class="gocmbb-testimonial-body-right">
			<?php $module->gocmbb_profile_name( $i ); ?>
			<?php $module->gocmbb_profile_designation( $i ); ?>
			<?php $module->gocmbb_profile_content( $i ); ?>
			<?php $module->gocmbb_profile_ratings( $i ); ?>
        </div>
    </div>
<?php endfor; ?>
