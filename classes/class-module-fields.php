<?php
if ( ! class_exists( 'GOCMBB_Rgba_Colors' ) ) {
	class GOCMBB_Rgba_Colors {
		/**
		 * Hex to Rgba For color
		 *
		 * @param $hex
		 * @param $opacity
		 *
		 * @return string
		 * @since 1.0.0
		 */
		public function gocmbb_hex2rgba( $hex, $opacity ) {
			$hex = str_replace( '#', '', $hex );
			if ( strlen( $hex ) == 3 ) {
				$r = hexdec( $hex[0] . $hex[0] );
				$g = hexdec( $hex[1] . $hex[1] );
				$b = hexdec( $hex[2] . $hex[2] );
			} else {
				$r = hexdec( substr( $hex, 0, 2 ) );
				$g = hexdec( substr( $hex, 2, 2 ) );
				$b = hexdec( substr( $hex, 4, 2 ) );
			}
			$rgba = array( $r, $g, $b, $opacity );

			return 'rgba(' . implode( ', ', $rgba ) . ')';
		}

		/**
		 * Change Color To hex
		 *
		 * @param string $code
		 *
		 * @return string
		 * @since 1.0.0
		 */
		public function gocmbb_parse_color_to_hex( $code = '' ) {
			$color = '';
			$hex   = '';
			if ( $code != '' ) {
				if ( strpos( $code, 'rgba' ) !== false ) {
					$code  = ltrim( $code, 'rgba(' );
					$code  = rtrim( $code, ')' );
					$rgb   = explode( ',', $code );
					$hex   .= str_pad( dechex( $rgb[0] ), 2, '0', STR_PAD_LEFT );
					$hex   .= str_pad( dechex( $rgb[1] ), 2, '0', STR_PAD_LEFT );
					$hex   .= str_pad( dechex( $rgb[2] ), 2, '0', STR_PAD_LEFT );
					$color = $hex;
				} else {
					$color = ltrim( $code, '#' );
				}
			}

			return $color;
		}
	}
}

if ( ! class_exists( 'GOCMBB_Custom_Option_Field_Type' ) ) {
	class GOCMBB_Custom_Option_Field_Type {
		/**
		 * gocmbb_Custom_Option_Type constructor.
		 */
		public function __construct() {
			add_action( 'fl_builder_control_gocmbb-radio', [ $this, 'gocmbbRadioField' ], 1, 4 );
			add_action( 'fl_builder_control_gocmbb-multinumber', [ $this, 'gocmbbMultiNumberField' ], 1, 3 );
		}

		/**
		 * gocmbb modules option type for radio fields
		 *
		 * @param $name
		 * @param $value
		 * @param $field
		 *
		 * @since 1.0.0
		 */
		public function gocmbbRadioField( $name, $value, $field ) {
			if ( ! isset( $field['options'] ) ) {
				return;
			}
			$options = ( isset( $field['options'] ) && is_array( $field['options'] ) ) ? $field['options'] : array();
			$toggle  = ( isset( $field['toggle'] ) && is_array( $field['toggle'] ) ) ? $field['toggle'] : array();
			foreach ( $options as $opt_key => $opt_value ) {
				?>
                <div class="gocmbb-field-wrap">
                    <label class="gocmbb-label gocmbb-option-<?php echo $opt_key; ?> <?php echo $name; ?> <?php echo ( $opt_key == $value || ( '' == $value && $opt_key == $default ) ) ? 'selected' : ''; ?>">
                        <input type="radio" class="gocmbb-field-radio" name="<?php echo $name; ?>"
                               value="<?php echo $opt_key; ?>" <?php echo ( $opt_key == $value || ( '' == $value && $opt_key == $default ) ) ? 'checked="checked"' : ''; ?> />
                        <span><?php echo $opt_value; ?></span>
                    </label>
                </div>
				<?php
			}
			?>
            <input type="hidden" class="gocmbb-field-radio-data" value="<?php echo ( $value && '' !== $value ) ? $value : $default; ?>"
                   data-name="<?php echo $name; ?>" <?php echo count( $toggle ) ? "data-toggle='" . json_encode( $toggle ) . "'" : ''; ?> />
            <script> NJBAFields._initRadioFields();
                jQuery('.fl-builder-settings-fields .gocmbb-field-radio  ').click(function () {
                    jQuery('.fl-builder-settings:visible').find('.fl-builder-settings-fields input[type="radio"]').parent().removeClass('selected');
                    jQuery('.fl-builder-settings:visible').find('.fl-builder-settings-fields input[type="radio"]:checked').parent().addClass('selected');
                });
            </script>
			<?php
		}

		/**
		 * gocmbb modules option type for multiple Input Fields.
		 *
		 * @param $name
		 * @param $value
		 * @param $field
		 */
		public function gocmbbMultiNumberField( $name, $value, $field ) {
			if ( ! isset( $field['options'] ) || ! is_array( $field['options'] ) ) {
				return;
			}
			$options = $field['options'];
			//$class   = ( isset( $field['class'] ) ) ? $field['class'] : '';
			//$default = isset( $field['default'] ) ? $field['default'] : array();
			$value = (array) $value;
			?>
            <div class="gocmbb-multinumber-wrap">
				<?php
				foreach ( $options as $key => $opt ) {
					$placeholder = isset( $opt['placeholder'] ) ? $opt['placeholder'] : '';
					//$size        = isset( $opt['size'] ) ? 'size="' . $opt['size'] . '"' : '';
					//$maxlength   = isset( $opt['maxlength'] ) ? 'maxlength="' . $opt['maxlength'] . '"' : '';
					$icon    = isset( $opt['icon'] ) ? 'fa ' . $opt['icon'] : '';
					$preview = isset( $opt['preview'] ) ? $opt['preview'] : array();
					$tooltip = isset( $opt['tooltip'] ) ? $opt['tooltip'] : '';
					//$description = isset( $opt['description'] ) ? 'description="' . $opt['description'] . '"' : '';
					?>
                    <span class="gocmbb-multinumber <?php echo $icon; ?> gocmbb-field" <?php echo count( $preview ) ? "data-preview='" . json_encode( $preview ) . "'" : ''; ?> title="<?php echo $tooltip; ?>">
                        <input type="number" name="<?php echo $name . '[][' . $key . ']'; ?>" value="<?php if ( $value[ $key ] >= '0' ) {
	                        echo $value[ $key ];
                        } ?>" class="gocmbb-field-multinumber" placeholder="<?php echo $placeholder; ?>"/>
                    </span>
					<?php
				}
				?>
            </div>
			<?php
		}
	}

	$gocmbb_Custom_Option_Field_Type = new GOCMBB_Custom_Option_Field_Type();
}

if ( ! class_exists( 'GOCMBB_Countdown' ) ) {
	class GOCMBB_Countdown {
		/**
		 * GOCMBB_Countdown constructor.
		 */
		public function __construct() {
			add_action( 'fl_builder_control_gocmbb-normal-date', [ $this, 'gocmbbNormalDateField' ], 1, 4 );
			add_action( 'fl_builder_control_gocmbb-evergreen-date', [ $this, 'gocmbbEvergreenDateField' ], 1, 4 );
		}

		/**
		 * gocmbb modules option type for Normal Date Countdown.
		 *
		 * @param $name
		 * @param $value
		 * @param $field
		 * @param $settings
		 *
		 * @since 1.0.0
		 */
		public function gocmbbNormalDateField( $name, $value, $field, $settings ) {
			//$custom_class = isset( $field['class'] ) ? $field['class'] : '';
			$preview = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );
			echo '<div class="gocmbb-date-wrap fl-field" data-type="select" data-preview=\'' . $preview . '\'><div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_days" ><option value="0">' . __( 'Date',
					'bb-gocmbb' ) . '</option>';
			for ( $i = 1; $i <= 31; $i ++ ) {
				$selected = '';
				if ( isset( $settings->fixed_date_days ) ) {
					if ( $i == $settings->fixed_date_days ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} else if ( $i == 29 ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
				}
			}
			echo '</select></br><label>' . __( 'Date', 'bb-gocmbb' ) . '</label></div>';
			echo '<div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_month" >';
			echo '<option value="0">' . __( 'Month', 'bb-gocmbb' ) . '</option>';
			echo '<option value="01" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '01' ) ? 'selected' : '' ) . ' >Jan</option>';
			echo '<option value="02" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '02' ) ? 'selected' : '' ) . ' >Feb</option>';
			echo '<option value="03" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '03' ) ? 'selected' : '' ) . ' >Mar</option>';
			echo '<option value="04" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '04' ) ? 'selected' : '' ) . ' >Apr</option>';
			echo '<option value="05" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '05' ) ? 'selected' : '' ) . ' >May</option>';
			echo '<option value="06" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '06' ) ? 'selected' : '' ) . ' >Jun</option>';
			echo '<option value="07" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '07' ) ? 'selected' : '' ) . ' >Jul</option>';
			echo '<option value="08" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '08' ) ? 'selected' : '' ) . ' >Aug</option>';
			echo '<option value="09" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '09' ) ? 'selected' : '' ) . ' >Sep</option>';
			echo '<option value="10" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '10' ) ? 'selected' : '' ) . ' >Oct</option>';
			echo '<option value="11" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '11' ) ? 'selected' : '' ) . ' >Nov</option>';
			echo '<option value="12" ' . ( ( isset( $settings->fixed_date_month ) && $settings->fixed_date_month == '12' ) ? 'selected' : '' ) . ' >Dec</option>';
			echo '</select></br><label>' . __( 'Months', 'bb-gocmbb' ) . '</label></div>';
			echo '<div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_year" >';
			echo '<option value="0">' . __( 'Year', 'bb-gocmbb' ) . '</option>';
			for ( $i = date( 'Y' ); $i < date( 'Y' ) + 6; $i ++ ) {
				$selected = '';
				if ( isset( $settings->fixed_date_year ) ) {
					if ( $i == $settings->fixed_date_year ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} else if ( $i == date( 'Y' ) + 5 ) {
					$selected = 'selected';
				}
				echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
			}
			echo '</select></br><label>' . __( 'Years', 'bb-gocmbb' ) . '</label></div>';
			echo '<div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_hour" >';
			echo '<option value="0">' . __( 'Hour', 'bb-gocmbb' ) . '</option>';
			for ( $i = 0; $i < 24; $i ++ ) {
				$selected = '';
				if ( isset( $settings->fixed_date_hour ) ) {
					if ( $i == $settings->fixed_date_hour ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} else if ( $i == 23 ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
				}
			}
			echo '</select></br><label>' . __( 'Hours', 'bb-gocmbb' ) . '</label></div>';
			echo '<div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_minutes" >';
			echo '<option value="0">' . __( 'Minutes', 'bb-gocmbb' ) . '</option>';
			for ( $i = 0; $i < 60; $i ++ ) {
				$selected = '';
				if ( isset( $settings->fixed_date_minutes ) ) {
					if ( $i == $settings->fixed_date_minutes ) {
						$selected = "selected";
					} else {
						$selected = '';
					}
				} else if ( $i == 59 ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
				}
			}
			echo '</select></br><label>' . __( 'Minutes', 'bb-gocmbb' ) . '</label></div><div>';
		}

		/**
		 * gocmbb modules option type for evergreen date countdown
		 *
		 * @param $name
		 * @param $value
		 * @param $field
		 * @param $settings
		 *
		 * @since 1.0.0
		 */
		public function gocmbbEvergreenDateField( $name, $value, $field, $settings ) {
			$custom_class = isset( $field['class'] ) ? $field['class'] : '';
			$selected     = '';
			$preview      = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );
			echo '<div class="fl-field gocmbb-evergreen-wrap" data-type="select" data-preview=\'' . $preview . '\'><div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_days" >';
			echo '<option value="0">' . __( 'Days', 'bb-gocmbb' ) . '</option>';
			for ( $i = 0; $i <= 31; $i ++ ) {
				if ( isset( $settings->evergreen_date_days ) ) {
					if ( $i == $settings->evergreen_date_days ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} else if ( $i == 30 ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
				}
			}
			echo '</select></br><label>' . __( 'Days', 'bb-gocmbb' ) . '</label></div>';
			echo '<div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_hour" >';
			echo '<option value="0">' . __( 'Hours', 'bb-gocmbb' ) . '</option>';
			for ( $i = 0; $i < 24; $i ++ ) {
				if ( isset( $settings->evergreen_date_hour ) ) {
					if ( $i == $settings->evergreen_date_hour ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} else if ( $i == 23 ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
				}
			}
			echo '</select></br><label>' . __( 'Hours', 'bb-gocmbb' ) . '</label></div>';
			echo '<div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_minutes" >';
			echo '<option value="0">' . __( 'Minutes', 'bb-gocmbb' ) . '</option>';
			for ( $i = 0; $i < 60; $i ++ ) {
				if ( isset( $settings->evergreen_date_minutes ) ) {
					if ( $i == $settings->evergreen_date_minutes ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} else if ( $i == 59 ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
				}
			}
			echo '</select></br><label>' . __( 'Minutes', 'bb-gocmbb' ) . '</label></div>';
			echo '<div class="gocmbb-countdown-custom-fields"><select class="text text-full" name="' . $name . '_seconds" >';
			echo '<option value="0">' . __( 'Seconds', 'bb-gocmbb' ) . '</option>';
			for ( $i = 0; $i < 60; $i ++ ) {
				if ( isset( $settings->evergreen_date_seconds ) ) {
					$selected = $i == $settings->evergreen_date_seconds ? 'selected' : '';
				} else if ( $i == 59 ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . $i . '" ' . $selected . '>0' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
				}
			}
			echo '</select></br><label>' . __( 'Seconds', 'bb-gocmbb' ) . '</label></div></div>';
		}
	}

	$gocmbb_countdown = new GOCMBB_Countdown();
}
if ( ! class_exists( 'GOCMBB_Simplify' ) ) {
	class GOCMBB_Simplify {
		/**
		 * GOCMBB_Simplify constructor.
		 */
		public function __construct() {
			add_action( 'fl_builder_control_gocmbb-simplify', [ $this, 'gocmbbSimplify' ], 1, 4 );
		}

		/**
		 * gocmbb modules option type for simplify.
		 *
		 * @param $name
		 * @param $value
		 * @param $field
		 * @param $settings
		 */
		public function gocmbbSimplify( $name, $value, $field, $settings ) {
			if ( is_object( $value ) ) {
				$value = json_decode( json_encode( $value ), true );
			}
			$preview  = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );
			$selector = '';
			$simplify = 'collapse';
			$medias   = array(
				'desktop'       => ( isset( $value['desktop'] ) ) ? $value['desktop'] : '',
				'medium_device' => ( isset( $value['medium'] ) ) ? $value['medium'] : '', // Medium Device
				'small_device'  => ( isset( $value['small'] ) ) ? $value['small'] : '',   // Small Device
			);
			if ( $medias['medium_device'] != '' || $medias['small_device'] != '' ) {
				$simplify = 'expand';
			}
			$simplify       = ( isset( $value['simplify'] ) ) ? $value['simplify'] : $simplify;
			$simplify_style = ( $simplify == 'collapse' ) ? 'style="display:none;"' : 'style="display:inline-block;"';
			$html           = '<div class="gocmbb-simplify-wrapper">';
			$html           .= '  <div class="gocmbb-simplify-items" >';
			foreach ( $medias as $key => $default_value ) {
				switch ( $key ) {
					case 'desktop':
						$style    = '';
						$selector = ' data-type="text" data-preview=\'' . $preview . '\'';
						$class    = 'fl-field require';
						$data_id  = strtolower( ( preg_replace( '/\s+/', '_', $key ) ) );
						$dashicon = "<i class='dashicons dashicons-desktop gocmbb-help-tooltip'></i>";
						$html     .= "<div class='gocmbb-size-wrap'>";
						$html     .= $this->gocmbbSimplifyMediaField( $name, $class, $dashicon, $key, $default_value, $selector, $data_id, $style );
						$html     .= "<div class='simplify' gocmbb-toggle='" . $simplify . "'>
                                        <input type='hidden' class='simplify_toggle' name='" . $name . "[][simplify]' value='" . $simplify . "'>
                                        <i class='simplify-icon dashicons dashicons-arrow-right-alt2 gocmbb-help-tooltip'></i>
                                        <div class='gocmbb-tooltip simplify-options'>" . __( "Responsive Options", "gocmbb" ) . '</div>
                                      </div>';
						$html     .= '</div>';
						break;
					case 'medium_device':
						$style    = $simplify_style;
						$selector = '';
						$class    = 'optional';
						$data_id  = strtolower( ( preg_replace( '/\s+/', '_', $key ) ) );
						$dashicon = "<i class='dashicons dashicons-tablet gocmbb-help-tooltip' style='transform: rotate(90deg);'></i>";
						$html     .= "<div class='gocmbb-simplify-size-wrap'>";
						$html     .= $this->gocmbbSimplifyMediaField( $name, $class, $dashicon, $key, $default_value, $selector, $data_id, $style );
						break;
					case 'small_device':
						$style    = $simplify_style;
						$selector = '';
						$class    = 'optional';
						$data_id  = strtolower( ( preg_replace( '/\s+/', '_', $key ) ) );
						$dashicon = "<i class='dashicons dashicons-smartphone gocmbb-help-tooltip'></i>";
						$html     .= $this->gocmbbSimplifyMediaField( $name, $class, $dashicon, $key, $default_value, $selector, $data_id, $style );
						$html     .= '</div>';
						break;
				}
			}
			$html .= '  </div>';
			$html .= '</div>';
			echo $html;
		}

		/**
		 * simplify input fields
		 *
		 * @param $name
		 * @param $class
		 * @param $dashicon
		 * @param $key
		 * @param $default_value
		 * @param $selector
		 * @param $data_id
		 * @param $style
		 *
		 * @return string
		 */
		public function gocmbbSimplifyMediaField( $name, $class, $dashicon, $key, $default_value, $selector, $data_id, $style ) {
			$tooltipVal = str_replace( '_', ' ', $data_id );
			$html       = '<div class="gocmbb-simplify-item ' . $class . ' ' . $data_id . ' "' . $selector . ' ' . $style . '>';
			$html       .= '<span class="gocmbb-icon">';
			$html       .= $dashicon;
			$html       .= '<div class="gocmbb-tooltip ' . $data_id . '">' . ucwords( $tooltipVal ) . '</div>';
			$html       .= '</span>';
			$html       .= '    <input type="text" name="' . $name . '[][' . str_replace( '_device', '',
					$key ) . ']" class="gocmbb-simplify-input" maxlength="3" size="6" value="' . $default_value . '" />';
			$html       .= '  </div>';

			return $html;
		}
	}

	new GOCMBB_Simplify();
}
if ( ! class_exists( 'GOCMBB_Render_Js_Css' ) ) {
	class GOCMBB_Render_Js_Css {
		/**
		 * GOCMBB_Render_Js_Css constructor.
		 */
		public function __construct() {
			add_filter( 'fl_builder_render_css', [ $this, 'fl_gocmbb_render_css' ], 10, 3 );
			add_filter( 'fl_builder_render_js', [ $this, 'fl_gocmbb_render_js' ], 10, 3 );
		}

		/**
		 * Render Global gocmbb-layout-builder css
		 *
		 * @param $css
		 * @param $nodes
		 * @param $global_settings
		 *
		 * @return string
		 * @since  1.0.0
		 */
		public function fl_gocmbb_render_css( $css, $nodes, $global_settings ) {
			$css .= file_get_contents( GOCMBB_MODULE_DIR . 'assets/css/gocmbb-frontend.css' );

			return $css;
		}

		/**
		 * Render Global gocmbb-layout-builder js
		 *
		 * @param $js
		 * @param $nodes
		 * @param $global_settings
		 *
		 * @return string
		 * @since 1.0.0
		 */
		public function fl_gocmbb_render_js( $js, $nodes, $global_settings ) {
			$temp = file_get_contents( GOCMBB_MODULE_DIR . 'assets/js/gocmbb-frontend.js' ) . $js;
			$js   = $temp;

			return $js;
		}
	}

	new GOCMBB_Render_Js_Css();
}

if ( ! class_exists( 'GOCMBB_Draggable' ) ) {
	class GOCMBB_Draggable {
		/**
		 * GOCMBB_Draggable constructor.
		 */
		public function __construct() {
			add_action( 'fl_builder_control_gocmbb-draggable', [ $this, 'gocmbb_draggable' ], 1, 4 );
		}

		/**
		 * gocmbb draggable fields
		 *
		 * @param $name
		 * @param $value
		 * @param $field
		 * @param $settings
		 *
		 * @since 1.0.0
		 */
		public function gocmbb_draggable( $name, $value, $field, $settings ) {
			$val     = ( isset( $value ) && $value != '' ) ? $value : '0,0';
			$coord   = explode( ',', $val );
			$preview = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );
			echo "<script>jQuery(function(){ NJBAFields._initDraggableFields({name:'" . $name . "'}); });</script><div class='gocmbb-draggable-wrap fl-field' data-type='text' data-preview='" . $preview . "'><div class='gocmbb-draggable-section'></div><div class='gocmbb-draggable-point' style='top:" . $coord[1] . "%;left:" . $coord[0] . "%;'></div></div><input type='hidden' value='" . $val . "' name='" . $name . "' />";
		}
	}

	new GOCMBB_Draggable();
}
?>
<?php
if ( ! class_exists( 'GOCMBB_FB_Setting' ) ) { //GOCMBB_FB_Setting Type
	class GOCMBB_FB_Setting {
		/**
		 * Returns Facebook App ID from gocmbb Settings.
		 * @return mixed
		 * @since 1.6
		 */
		public function gocmbbGetFbAppId() {
			$options = get_option( 'gocmbb_options' );

			return $options['facebook_app_id'];
		}

		/**
		 * Build the URL of Facebook SDK.
		 * @return string
		 * @since 1.6
		 */
		public function gocmbbGetFbSdkUrl() {
			$app_id = $this->gocmbbGetFbAppId();
			if ( $app_id && ! empty( $app_id ) ) {
				return sprintf( 'https://connect.facebook.net/%s/sdk.js#xfbml=1&version=v2.12&appId=%s', get_locale(), $app_id );
			}

			return sprintf( 'https://connect.facebook.net/%s/sdk.js#xfbml=1&version=v2.12', get_locale() );
		}

		/**
		 * This Function not used any placed in at that time.
		 * @return string
		 */
		public function gocmbbGetFbAppSettingsUrl() {
			$app_id = $this->gocmbbGetFbAppId();
			if ( $app_id ) {
				return sprintf( 'https://developers.facebook.com/apps/%d/settings/', $app_id );
			}

			return 'https://developers.facebook.com/apps/';
		}

		/**
		 * Get gocmbb module Description.
		 * @return string
		 * @since 1.6
		 */
		public function gocmbbGetFbModuleDesc() {
			$app_id = $this->gocmbbGetFbAppId();
			if ( ! $app_id ) {
				return sprintf( __( 'You can set your Facebook App ID in the <a href="%s" target="_blank"> General Settings</a></br></br>For Facebook App ID, you need to <a href="https://developers.facebook.com/docs/apps/register/" target="_blank"> register and configure</a> an app.</br></br>Once registered, add the domain to your <a href="https://developers.facebook.com/apps/" target="_blank"> App Domains </a></br></br>Looking for More Info <a href="https://www.ninjabeaveraddon.com/documentation/" target="_blank"> Click Here </a>.',
					'bb-gocmbb' ), admin_url( 'admin.php?page=gocmbb-admin-setting#general' ) );
			}

			return sprintf( __( 'You are connected to Facebook App %1$s, <a href="%2$s" target="_blank"> Change App </a></br></br>For Facebook App ID, you need to <a href="https://developers.facebook.com/docs/apps/register/" target="_blank"> register and configure</a> an app.</br></br>Once registered, add the domain to your <a href="https://developers.facebook.com/apps/" target="_blank"> App Domains </a></br></br>Looking for More Info <a href="https://www.ninjabeaveraddon.com/documentation/" target="_blank"> Click Here </a>.',
				'bb-gocmbb' ), $app_id, admin_url( 'admin.php?page=gocmbb-admin-setting#general' ) );
		}
	}
}
