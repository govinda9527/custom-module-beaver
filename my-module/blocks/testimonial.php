<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$testi_quote             = !empty(get_field( 'testi_quote' )) ? get_field( 'testi_quote' ) : 'Your quote here...';
$testi_author            = get_field( 'testi_author' );
$testi_role       = get_field( 'testi_role' );
$testi_image             = get_field( 'testi_image' );
$testi_background_color  = get_field( 'testi_background_color' ); // ACF's color picker.
$testi_color        = get_field( 'testi_color' ); // ACF's color picker.
$quote_attribution = '';

if ( $testi_author ) {
    $quote_attribution .= '<footer class="testimonial__attribution">';
    $quote_attribution .= '<cite class="testimonial__author">' . $testi_author . '</cite>';

    if ( $testi_role ) {
        $quote_attribution .= '<span class="testimonial__role">' . $testi_role . '</span>';
    }

    $quote_attribution .= '</footer><!-- .testimonial__attribution -->';
}

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'testimonial';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
if ( $testi_background_color || $testi_color ) {
    $class_name .= ' has-custom-acf-color';
}

// Build a valid style attribute for background and text colors.
$styles = array( 'background-color: ' . $testi_background_color, 'color: ' . $testi_color );
$style  = implode( '; ', $styles );
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $style ); ?>">
    <div class="testimonial__col">
        <blockquote class="testimonial__blockquote">
            <?php echo esc_html( $testi_quote ); ?>

            <?php if ( !empty( $quote_attribution ) ) : ?>
                <?php echo wp_kses_post( $quote_attribution ); ?>
            <?php endif; ?>
        </blockquote>
    </div>

    <?php if ( $testi_image ) : ?>
        <div class="testimonial__col">
            <figure class="testimonial__image">
                <?php echo wp_get_attachment_image( $testi_image['ID'], 'full', '', array( 'class' => 'testimonial__img' ) ); ?>
            </figure>
        </div>
    <?php endif; ?>
</div>