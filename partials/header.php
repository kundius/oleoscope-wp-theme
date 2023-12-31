<div class="header">
    <div class="header-main">
        <div class="container header-main__container">
            <button class="header-main__menu" aria-label="Меню"></button>
            <a href="/" class="header-main__logo">
                <img src="<?php bloginfo('template_url') ?>/dist/images/logo.svg" alt="<?php bloginfo('name') ?>" width="300" height="100" >
            </a>
            <div class="header-main__divider-1"></div>
            <div class="header-main__search">
                <form role="search" id="searchform" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
                    <input type="text" class="searchform__control" placeholder="<?php echo esc_attr_x( 'Найти на сайте …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">
                    <button class="searchform__submit" aria-label="Поиск"></button>
                </form>
            </div>
            <a href="/?s=" aria-label="Поиск" class="header-main__search-link"></a>
            <div class="header-main__divider-2"></div>
            <div class="header-main__subscribe">
                <a href="/about/subscription" class="header-subscribe">
                    <span class="header-subscribe__icon" aria-hidden="true">
                    </span>
                    <span class="header-subscribe__content">
                        <span class="header-subscribe__title">
                            Подписаться
                        </span>
                        <span class="header-subscribe__desc">
                            На 12 месяцев
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="container header-nav__container">
            <?php wp_nav_menu([
                'theme_location' => 'menu-1',
                'container' => false,
                'menu_id' => 'primary-menu',
                'menu_class' => 'header-menu',
                'depth' => 1,
            ]); ?>
            
            <div class="header-social">
                <button class="header-social__button">
                    Мы в соц. сетях
                </button>
                <div class="header-social__links">
                    <?php wp_nav_menu([
                        'theme_location' => 'menu-social',
                        'container' => false,
                        'menu_id' => 'header-social',
                        'menu_class' => 'footer-social',
                        'depth' => 1,
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="drawer">
    <?php wp_nav_menu([
        'theme_location' => 'menu-1',
        'container' => false,
        'menu_id' => 'drawer-menu',
        'menu_class' => 'drawer-menu',
        'depth' => 1,
    ]); ?>
</div>
