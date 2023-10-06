<div class="gocmbb-testimonial layout-<?php echo $settings->testimonial_layout; ?>">

	<?php if ( $settings->heading !== '' && $settings->testimonial_layout != 6 && $settings->testimonial_layout != 7 && $settings->testimonial_layout != 8 ) { ?>
        <div class="gocmbb-testimonial-heading">
            <h1><?php echo $settings->heading; ?></h1>
        </div>
	<?php } ?>
    <div class="gocmbb-testimonial-main">
        <div class="gocmbb-testimonial-wrapper">
			<?php
			$layout              = $settings->testimonial_layout;
			$number_testimonials = count( $settings->testimonials );
			switch ( $layout ) {
				case '1':
					include( 'layout_1.php' );
					break;
				case '2':
					include( 'layout_2.php' );
					break;
				case '3':
					include( 'layout_3.php' );
					break;
				case '4':
					include( 'layout_4.php' );
					break;
				case '5':
					include( 'layout_5.php' );
					break;
				case '6':
					include( 'layout_6.php' );
					break;
				case '7':
					include( 'layout_7.php' );
					break;
				case '8':
					include( 'layout_8.php' );
					break;
				case '9':
					include( 'layout_9.php' );
					break;
			}
			?>
        </div>
		<?php if ( $settings->arrows ) { ?>
            <div class="gocmbb-arrow-wrapper <?php echo $settings->arrow_alignment; ?>">
                <div class="gocmbb-slider-prev gocmbb-slider-nav"></div>
                <div class="gocmbb-slider-next gocmbb-slider-nav"></div>
            </div>
		<?php } ?>
    </div>


</div>
