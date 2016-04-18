<?php
/**
 * Handle setting and retrieving theme mods for the customizer.
 *
 * Find wrapper functions in `helper-functions.php`
 *
 * @package Jobify
 * @category Customizer
 * @since 3.0.0
 */

class Jobify_Customizer_Mods {

	/**
	 * @var array contains a list of mods
	 */
	public static $mods = array();

	/**
	 * Get a theme mod or return a default value if not set.
	 *
	 * @since 3.0.0
	 *
	 * @param string $key
	 * @return mixed
	 */
	public static function get( $key ) {
		$mods = self::get_defaults();

		$default = isset( $mods[ $key ] ) ? $mods[ $key ] : '';

		return get_theme_mod( $key, $default );
	}

	/**
	 * Get an array of default theme mods.
	 *
	 * @since 3.0.0
	 *
	 * @return array self::$mods
	 */
	public static function get_defaults() {
		if ( empty( self::$mods ) ) {
			self::$mods = array(
				// General
				'fixed-header' => true,

				// Colors
				'color-header-background' => '#01da90',
				'color-navigation-text' => '#ffffff',
				'color-primary' => '#01da90',
				'color-accent' => '#f08d3c',
				'color-body-text' => '#797979',
				'color-link' => '#24262B',
			
				// Accounts
				'registration-default' => 'employer',
				'registration-roles' => 'employer',
				
				// Call to Action
				'cta-display' => true,
				'cta-text' => '<h2>Got a question?</h2>We&#39;re here to help. Check out our FAQs, send us an email or call us at 1 800 555 5555',
				'color-cta-text' => '#ffffff',
				'color-cta-background' => '#3399cc',
				
				// Copyright
				'copyright' => sprintf( '&copy; %1$s %2$s &mdash; All Rights Reserved', date( 'Y' ), get_bloginfo( 'name' ) )
			);

			self::$mods = apply_filters( 'jobify_theme_mod_defaults', self::$mods );
		}

		return self::$mods;
	}
}
