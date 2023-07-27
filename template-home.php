<?php
/*
Template Name: Главная
*/
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes();?> itemscope itemtype="http://schema.org/WebSite">
  <head>
    <?php get_template_part('partials/head');?>
  </head>
  <body <?php body_class() ?>>
    <?php wp_body_open() ?>

    <div class="page">
      <?php get_template_part('partials/header') ?>

      <div class="container">
        <div class="main">
          <div class="nav-slider">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="#" class="nav-slider__link">Мировые рынки</a></div>
                <div class="swiper-slide"><a href="#" class="nav-slider__link">Нормативное регулирование</a></div>
                <div class="swiper-slide"><a href="#" class="nav-slider__link">Уборочная</a></div>
                <div class="swiper-slide"><a href="#" class="nav-slider__link">Инвестиции</a></div>
                <div class="swiper-slide"><a href="#" class="nav-slider__link">Компании</a></div>
                <div class="swiper-slide"><a href="#" class="nav-slider__link">Цены</a></div>
                <div class="swiper-slide"><a href="#" class="nav-slider__link">Потребительский рынок</a></div>
              </div>
            </div>
            <div class="nav-slider-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="nav-slider-button-next"><i class="fa-solid fa-chevron-right"></i></div>
          </div>

          <div class="masthead">
            <div class="masthead__news">
              <div class="masthead-news">
                <div class="masthead-news__title">Новости недели</div>
                <div class="swiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="masthead-primary-item">
                        <div class="masthead-primary-item__image">
                          <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="">
                        </div>
                        <div class="masthead-primary-item__content">
                          <div class="masthead-primary-item__tags">
                            <a href="#" class="masthead-primary-item__tag">
                              Главное
                            </a>
                          </div>
                          <a href="#" class="masthead-primary-item__title">
                            Эксперт рассказал, как обнуление вывозной пошлины на масло повлияет на рынок
                          </a>
                          <div class="masthead-primary-item__date">
                            31.05.2023
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="masthead-primary-item">
                        <div class="masthead-primary-item__image">
                          <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="">
                        </div>
                        <div class="masthead-primary-item__content">
                          <div class="masthead-primary-item__tags">
                            <a href="#" class="masthead-primary-item__tag">
                              Главное
                            </a>
                          </div>
                          <a href="#" class="masthead-primary-item__title">
                            Эксперт рассказал, как обнуление вывозной пошлины на масло повлияет на рынок
                          </a>
                          <div class="masthead-primary-item__date">
                            31.05.2023
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
            <div class="masthead__interview">
              <div class="masthead-interview">
                <div class="masthead-interview__title">
                  Интервью
                </div>
                <div class="masthead-secondary-item">
                  <div class="masthead-secondary-item__image">
                    <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="">
                  </div>
                  <div class="masthead-secondary-item__content">
                    <a href="#" class="masthead-secondary-item__title">
                      Эксперт рассказал, как обнуление вывозной пошлины на масло повлияет на рынок
                    </a>
                    <div class="masthead-secondary-item__date">
                      31.05.2023
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="masthead__industry">
              <div class="masthead-industry">
                <div class="masthead-industry__title">
                  Отраслевой календарь
                </div>
                <div class="masthead-secondary-item">
                  <div class="masthead-secondary-item__image">
                    <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="">
                  </div>
                  <div class="masthead-secondary-item__content">
                    <a href="#" class="masthead-secondary-item__title">
                      6-9 июня: XXIV Международный зерновой раунд «Рынок зерна – вчера, сегодня, завтра»
                    </a>
                    <div class="masthead-secondary-item__date">
                      31.05.2023
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
