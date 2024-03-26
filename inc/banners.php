<?php

function wpb_load_widget() {
    register_widget( 'banner_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

class banner_widget extends WP_Widget {

    function __construct() {
        parent::__construct('banner_widget', 'Баннер', array());
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $widget_id = $args['widget_id'];

        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

        /* Здесь будем выводить метаданные */

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
        $title = $instance[ 'title' ];
        } else {
        $title = 'Баннер';
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

}

register_sidebar(array(
    'id' => 'banner-1',
    'name' => 'Баннер #1',
));

register_sidebar(array(
    'id' => 'banner-2',
    'name' => 'Баннер #2',
));

register_sidebar(array(
    'id' => 'banner-3',
    'name' => 'Баннер #3',
));

register_sidebar(array(
    'id' => 'banner-4',
    'name' => 'Баннер #4',
));

register_sidebar(array(
    'id' => 'banner-5',
    'name' => 'Баннер #5',
));
