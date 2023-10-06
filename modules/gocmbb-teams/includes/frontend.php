<?php
?>
<div class="gocmbb-teams-main gocmbb-teams-layout-<?php echo $settings->team_layout; ?>">
	<?php /* if ( $settings->heading != '') {?>
			<div class="gocmbb-heading">
		    	<<?php echo $settings->heading_tag_selection; ?>> <?php echo $settings->heading; ?> </<?php echo $settings->heading_tag_selection; ?>>
		        <div class="gocmbb-bottom-line"></div>
		    </div>
	    <?php }*/  ?>
    <div class="gocmbb-teams-body">
        <div class="gocmbb-teams-wrapper">
			<?php
			$layout       = $settings->team_layout;
			$number_teams = count( $settings->teams );
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
			}
			?>
        </div><!--gocmbb-teams-wrapper-->

    </div><!--gocmbb-teams-body-->
</div><!--gocmbb-teams-main-->
    
	
	
	
