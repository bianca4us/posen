<?php
// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Theme_Item {

	static public function get_theme_item ( $theme, $theme_active, $popup_id, $theme_submit_name, $theme_submit_value ) {
		?>

		<div class="oneandone-selectable-item <?php echo $theme_active == true ? 'active' : '' ?> ">
			<div class="oneandone-theme-screenshot" onclick="showBox(<?php echo htmlspecialchars( json_encode( $popup_id ) ); ?>)">
				<img src="<?php echo $theme->screenshot_url; ?>" alt="">
			</div>
			<span class="oneandone-theme-more-details" onclick="showBox(<?php echo htmlspecialchars( json_encode( $popup_id ) ); ?>)"><?php _e( 'More information', '1and1-wordpress-wizard' ) ?></span>

			<h3 class="oneandone-theme-name">
				<?php if ( $theme_active == true ) { ?>
					<span><?php _ex( 'Active:', 'theme' ); ?></span>
				<?php } ?>
				<?php echo $theme->name; ?>
			</h3>

			<div class="oneandone-theme-actions">
				<input type="submit" name="<?php echo $theme_submit_name ?>" value="<?php echo $theme_submit_value ?>"
					   class="button button-primary customize load-customize hide-if-no-customize"/>
			</div>

			<div id="<?php echo $popup_id; ?>" style="display:none">
				<div class="oneandone-theme-info-box">
					<div class="oneandone-info-box-theme-screenshot">
						<?php if ( $theme->screenshot_url ) { ?>
							<div class="screenshot"><img src="<?php echo $theme->screenshot_url; ?>" alt=""/></div>
						<?php } else { ?>
							<div class="screenshot blank"></div>
						<?php } ?>
					</div>
					<div class="oneandone-theme-info">
						<h3 class="oneandone-theme-name"><?php echo $theme->name; ?><span
								class="oneandone-theme-version"><?php printf( esc_html( 'Version: %s', '1and1-wordpress-wizard' ), $theme->version ); ?></span></h3>
						<h4 class="oneandone-theme-author"><?php printf( esc_html( 'By %s', '1and1-wordpress-wizard' ), $theme->author ); ?></h4>

						<p class="oneandone-theme-description"><?php echo $theme->sections[ 'description' ]; ?></p>
					</div>
				</div>
			</div>

		</div>

	<?php
	}
}
