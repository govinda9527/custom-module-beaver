<?php
for ( $i = 0;
$i < $number_teams;
$i ++ ) :
$teams = $settings->teams[ $i ];
if ( $settings->teams_layout_view === 'box' )
{
?>
<div class="gocmbb-column-<?php echo $settings->show_col; ?>">
	<?php
	}
	else if ( $settings->teams_layout_view === 'slider' )
	{
	?>
    <div class="gocmbb-slide-<?php echo $i; ?>">
		<?php
		}
		?>
        <div class="gocmbb-team-section ">
            <div class="gocmbb-team-img">
				<?php $module->gocmbb_image_render( $i ); ?>
                <div class="gocmbb-read-more-link">
                    <div class="open-text-vertical">
                        <span class="open-text-vertical-area">
                             <h6><?php echo $teams->member_description; ?></h6>
                             <?php $module->gocmbb_button_render( $i ); ?>
                         </span>
                    </div>
                </div>
                <div class="gocmbb-overlay"></div>
            </div>
            <div class="gocmbb-team-content">
				<?php $module->gocmbb_short_bio( $i ); ?>
                <div class="gocmbb-team-social">
                    <div class="gocmbb-team-social-aminate">
						<?php $module->gocmbb_social_media( $i ); ?>
                    </div>
                </div>
            </div><!--gocmbb-team-content-->
        </div><!--gocmbb-team-section-->
    </div>
	<?php
	endfor;
	?>
				
