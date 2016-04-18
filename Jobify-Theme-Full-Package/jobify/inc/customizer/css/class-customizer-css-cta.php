<?php
/**
 * Output the CTA CSS.
 *
 * @package Jobify
 * @category Customizer
 * @since 3.0.0
 */
class Jobify_Customizer_CSS_CTA {

    public function __construct() {
        $this->css = jobify_customizer()->css;

        add_action( 'jobify_output_customizer_css', array( $this, 'colors' ), 0 );
    }

    public function colors() {
		$text = jobify_theme_mod( 'color-cta-text' );
        $background = jobify_theme_mod( 'color-cta-background' );

        $this->css->add( array(
            'selectors' => array(
                '.footer-cta',
                '.footer-cta a',
                '.footer-cta tel'
            ),
            'declarations' => array(
                'color' => esc_attr( $text )
            )
        ) );

        $this->css->add( array(
            'selectors' => array(
                '.footer-cta a.button:hover'
            ),
            'declarations' => array(
                'color' => esc_attr( $background ) . ' !important' // ew
            )
        ) );

        $this->css->add( array(
            'selectors' => array(
                '.footer-cta',
            ),
            'declarations' => array(
                'background-color' => esc_attr( $background ),
            )
        ) );
    }

}
