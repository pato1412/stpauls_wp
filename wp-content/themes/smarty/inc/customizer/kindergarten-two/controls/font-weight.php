<?php
if ( ! class_exists( 'STM_Customizer_Font_Weight_Control' ) ) {

	class STM_Customizer_Font_Weight_Control extends WP_Customize_Control {

		public $type = 'stm-font-weight';

		public function render_content() {


			$weights = array(
				'100'       => esc_html__( 'Ultra Light', 'smarty' ),
				'100italic' => esc_html__( 'Ultra Light Italic', 'smarty' ),
				'200'       => esc_html__( 'Light', 'smarty' ),
				'200italic' => esc_html__( 'Light Italic', 'smarty' ),
				'300'       => esc_html__( 'Book', 'smarty' ),
				'300italic' => esc_html__( 'Book Italic', 'smarty' ),
				'400'       => esc_html__( 'Regular', 'smarty' ),
				'400italic' => esc_html__( 'Regular Italic', 'smarty' ),
				'500'       => esc_html__( 'Medium', 'smarty' ),
				'500italic' => esc_html__( 'Medium Italic', 'smarty' ),
				'600'       => esc_html__( 'Semi-Bold', 'smarty' ),
				'600italic' => esc_html__( 'Semi-Bold Italic', 'smarty' ),
				'700'       => esc_html__( 'Bold', 'smarty' ),
				'700italic' => esc_html__( 'Bold Italic', 'smarty' ),
				'800'       => esc_html__( 'Extra Bold', 'smarty' ),
				'800italic' => esc_html__( 'Extra Bold Italic', 'smarty' ),
				'900'       => esc_html__( 'Ultra Bold', 'smarty' ),
				'900italic' => esc_html__( 'Ultra Bold Italic', 'smarty' )
			);


			$input_args = array(
				'type'    => 'select',
				'label'   => $this->label,
				'name'    => '',
				'id'      => $this->id,
				'value'   => $this->value(),
				'link'    => $this->get_link(),
				'options' => $weights
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'stm-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-font-weight-wrapper">
						<?php stm_input( $input_args ); ?>
					</div>
				</div>

				<?php if ( '' != $this->description ) : ?>
					<div class="description customize-control-description">
						<?php echo esc_html( $this->description ); ?>
					</div>
				<?php endif; ?>

			</div>
			<?php
		}
	}
}