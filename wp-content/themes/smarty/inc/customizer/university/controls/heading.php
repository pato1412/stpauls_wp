<?php
if ( ! class_exists( 'STM_Customizer_Heading_Control' ) ) {

	class STM_Customizer_Heading_Control extends WP_Customize_Control {

		public $type = 'stm-heading';

		public function render_content() { ?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'stm-', '', $this->type ) ); ?>">

				<div class="customize-control-title">
					<div class="customize-control-title__sep">
						<div class="customize-control-title__sep-line"></div>
					</div>
					<div class="customize-control-title__text">
						<?php echo esc_html( $this->label ); ?>
					</div>
					<div class="customize-control-title__sep">
						<div class="customize-control-title__sep-line"></div>
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