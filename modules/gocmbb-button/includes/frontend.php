<div class="gocmbb-btn-main <?php echo $settings->button_style; ?>">
    <a href="<?php if ( $settings->link !== '' ) {
		echo $settings->link;
	} ?>" target="<?php if ( $settings->link_target !== '' ) {
		echo $settings->link_target;
	} ?>"
       class="gocmbb-btn <?php echo ( isset( $settings->btn_class ) ) ? $settings->btn_class : ''; ?> <?php echo ( isset( $settings->a_class ) ) ? $settings->a_class : ''; ?> " <?php echo ( isset( $settings->a_data ) ) ? $settings->a_data : ''; ?>>
		<?php if ( $settings->button_icon_aligment === 'left' ) {
			$module->gocmbb_ButtonIcon_Image();
		} ?>
        <span class="gocmbb-button-text"><?php if ( $settings->button_text ) {
				echo $settings->button_text;
			} ?></span>
		<?php if ( $settings->button_icon_aligment === 'right' ) {
			$module->gocmbb_ButtonIcon_Image();
		} ?>
    </a>
</div>
