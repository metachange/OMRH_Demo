<?php
/**
 * Home: Feature Callout
 *
 * @package Jobify
 * @category Widget
 * @since 3.0.0
 */
class Jobify_Widget_Feature_Callout extends Jobify_Widget {

	public function __construct() {
		$this->widget_description = __( 'Display a full-width "feature" callout', 'jobify' );
		$this->widget_id          = 'jobify_widget_feature_callout';
		$this->widget_cssclass    = 'jobify_widget_feature_callout widget--home-feature-callout';
		$this->widget_name        = __( 'Jobify - Home: Feature Callout', 'jobify' );
		$this->control_ops        = array(
			'width' => 400
		);
		$this->settings           = array(
			'home' => array(
				'std' => __( 'Homepage', 'jobify' ),
				'type' => 'widget-area'
			),
			'text_align' => array(
				'type'  => 'select',
				'std'   => 'left',
				'label' => __( 'Text Align:', 'jobify' ),
				'options' => array(
					'left' => __( 'Left', 'jobify' ),
					'right' => __( 'Right', 'jobify' ),
					'center' => __( 'Center (cover only)', 'jobify' )
				)
			),
			'background' => array(
				'type'  => 'select',
				'std'   => 'pull',
				'label' => __( 'Image Style:', 'jobify' ),
				'options' => array(
					'cover' => __( 'Cover', 'jobify' ),
					'pull'  => __( 'Pull Out', 'jobify' )
				)
			),
			'background_position' => array(
				'type'  => 'select',
				'std'   => 'center center',
				'label' => __( 'Image Position:', 'jobify' ),
				'options' => array(
					'left top' => __( 'Left Top', 'jobify' ),
					'left center' => __( 'Left Center', 'jobify' ),
					'left bottom' => __( 'Left Bottom', 'jobify' ),
					'right top' => __( 'Right Top', 'jobify' ),
					'right center' => __( 'Right Center', 'jobify' ),
					'right bottom' => __( 'Right Bottom', 'jobify' ),
					'center top' => __( 'Center Top', 'jobify' ),
					'center center' => __( 'Center Center', 'jobify' ),
					'center bottom' => __( 'Center Bottom', 'jobify' ),
					'center top' => __( 'Center Top', 'jobify' )
				)
			),
			'cover_overlay' => array(
				'type' => 'checkbox',
				'std'  => 1,
				'label' => __( 'Use transparent overlay', 'jobify' )
			),
			'margin' => array(
				'type' => 'checkbox',
				'std'  => 1,
				'label' => __( 'Add standard spacing above/below widget', 'jobify' )
			),
			'text_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#717A8F',
				'label' => __( 'Text Color:', 'jobify' )
			),
			'background_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#ffffff',
				'label' => __( 'Background Color:', 'jobify' )
			),
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'jobify' )
			),
			'content' => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Content:', 'jobify' ),
				'rows'  => 5
			),
			'image' => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Image:', 'jobify' )
			)
		);

		parent::__construct();

		add_filter( 'jobify_feature_callout_description', 'wptexturize'        );
		add_filter( 'jobify_feature_callout_description', 'convert_smilies'    );
		add_filter( 'jobify_feature_callout_description', 'convert_chars'      );
		add_filter( 'jobify_feature_callout_description', 'wpautop'            );
		add_filter( 'jobify_feature_callout_description', 'shortcode_unautop'  );
		add_filter( 'jobify_feature_callout_description', 'prepend_attachment' );
        add_filter( 'jobify_feature_callout_description', 'do_shortcode'       );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$text_align = isset( $instance[ 'text_align' ] ) ? esc_attr( $instance[ 'text_align' ] ) : 'left';
		$background = isset( $instance[ 'background' ] ) ? esc_attr( $instance[ 'background' ] ) : 'cover';
		$background_color = isset( $instance[ 'background_color' ] ) ? esc_attr( $instance[ 'background_color' ] ) : '#ffffff';
		$background_position = isset( $instance[ 'background_position' ] ) ? esc_attr( $instance[ 'background_position' ] ) : 'center center';
		$overlay = isset( $instance[ 'cover_overlay' ] ) && 1 == $instance[ 'cover_overlay' ] ? 'has-overlay' : 'no-overlay';
		$margin = isset( $instance[ 'margin' ] ) && 1 == $instance[ 'margin' ] ? true : false;

		if ( ! $margin ) {
			$before_widget = str_replace( 'widget--home ', 'widget--home widget--home--no-margin ', $before_widget );
		}

		$image = isset( $instance[ 'image' ] ) ? esc_url( $instance[ 'image' ] ) : null;
		$content = $this->assemble_content( $instance );

		ob_start();
		?>

		<?php echo $before_widget; ?>

		<div class="feature-callout text-<?php echo $text_align; ?> image-<?php echo $background; ?>" style="background-color: <?php echo $background_color; ?>;">

			<?php if ( 'pull' == $background ) : ?>
				<div class="container">
					<div class="col-xs-12 col-sm-6 <?php echo ( 'right' == $text_align ) ? 'col-sm-offset-6' : ''; ?>">
						<?php echo $content; ?>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 <?php echo ( 'left' == $text_align ) ? 'col-sm-offset-6' : ''; ?> feature-callout-image-pull" style="background-image:url(<?php echo $image; ?>); ?>; background-position: <?php echo $background_position; ?>"></div>
			<?php else : ?>

				<div class="feature-callout-cover <?php echo $overlay; ?>" style="background-image:url(<?php echo $image; ?>); ?>; background-position: <?php echo $background_position; ?>">

					<div class="container">
						<div class="row">
							<div class="col-xs-12 <?php echo ( in_array( $text_align, array( 'left', 'right' ) ) ) ? 'col-sm-8 col-md-6' : ''; ?> <?php echo ( 'right' == $text_align ) ? 'col-sm-offset-4 col-md-offset-6' : ''; ?>">
								<?php echo $content; ?>
							</div>
						</div>
					</div>

				</div>

			<?php endif; ?>

		</div>

		<?php echo $after_widget; ?>

		<?php

		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );
	}

	private function assemble_content( $instance ) {
		$text_color = isset( $instance[ 'text_color' ] ) ? esc_attr( $instance[ 'text_color' ] ) : '#717A8F';

		$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
		$content = isset( $instance[ 'content' ] ) ? $instance[ 'content' ] : '';

		$output  = '<div class="callout-feature-content" style="color:' . $text_color . '">';
		$output .= '<h2 class="callout-feature-title" style="color:' . $text_color . '">' . $title . '</h2>';
		$output .= wpautop( $content );
		$output .= '</div>';

        $output  = apply_filters( 'jobify_feature_callout_description', $output );

		return $output;
	}
}
