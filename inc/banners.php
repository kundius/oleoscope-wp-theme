<?php

function banner_load_widget() {
    register_widget( 'Banner_Widget' );
}
add_action( 'widgets_init', 'banner_load_widget' );

class Banner_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'banner_widget',
            'Баннер',
            array(
                'description' => 'Предназначен для области с баннерами. Выводится один баннер на область в случайном порядке.'
            )
        );
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $widget_id = $args['widget_id'];
        $url = get_field('url', 'widget_' . $widget_id);
        $image = get_field('image', 'widget_' . $widget_id);

        echo $args['before_widget'];

        echo '<a href="' . $url . '"><img src="' . $image['url'] . '" alt="' . $title . '" /></a>';

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

// register_sidebar(array(
//     'id' => 'banner-1',
//     'name' => 'Баннер #1',
//     'before_sidebar' => '<div class="banner-sidebar banner-sidebar_1">',
//     'after_sidebar' => "</div>\n",
//     'before_widget' => '<div id="%1$s" class="banner-sidebar__widget %2$s">',
//     'after_widget' => "</div>\n",
// ));

// register_sidebar(array(
//     'id' => 'banner-2',
//     'name' => 'Баннер #2',
//     'before_sidebar' => '<div class="banner-sidebar banner-sidebar_2">',
//     'after_sidebar' => "</div>\n",
//     'before_widget' => '<div id="%1$s" class="banner-sidebar__widget %2$s">',
//     'after_widget' => "</div>\n",
// ));

// register_sidebar(array(
//     'id' => 'banner-3',
//     'name' => 'Баннер #3',
//     'before_sidebar' => '<div class="banner-sidebar banner-sidebar_3">',
//     'after_sidebar' => "</div>\n",
//     'before_widget' => '<div id="%1$s" class="banner-sidebar__widget %2$s">',
//     'after_widget' => "</div>\n",
// ));

// register_sidebar(array(
//     'id' => 'banner-4',
//     'name' => 'Баннер #4',
//     'before_sidebar' => '<div class="banner-sidebar banner-sidebar_4">',
//     'after_sidebar' => "</div>\n",
//     'before_widget' => '<div id="%1$s" class="banner-sidebar__widget %2$s">',
//     'after_widget' => "</div>\n",
// ));

// register_sidebar(array(
//     'id' => 'banner-5',
//     'name' => 'Баннер #5',
//     'before_sidebar' => '<div class="banner-sidebar banner-sidebar_5">',
//     'after_sidebar' => "</div>\n",
//     'before_widget' => '<div id="%1$s" class="banner-sidebar__widget %2$s">',
//     'after_widget' => "</div>\n",
// ));
