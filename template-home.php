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
            <div class="nav-slider-button-prev"></div>
            <div class="nav-slider-button-next"></div>
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

          <div class="home-layout">
            <div class="home-layout__left">
              <div class="news-feed">
                <div class="news-feed__item">
                  <a href="#" class="news-feed__title">Удмуртия экспортировала в КНР почти 1 тыс. тонн рапсового масла в 2022 г.</a>
                  <div class="news-feed__date">05.06.2023</div>
                </div>
                <div class="news-feed__item">
                  <a href="#" class="news-feed__title">Удмуртия экспортировала в КНР почти 1 тыс. тонн рапсового масла в 2022 г.</a>
                  <div class="news-feed__date">05.06.2023</div>
                </div>
                <div class="news-feed__item">
                  <a href="#" class="news-feed__title">Удмуртия экспортировала в КНР почти 1 тыс. тонн рапсового масла в 2022 г.</a>
                  <div class="news-feed__date">05.06.2023</div>
                </div>
              </div>

              <div class="home-layout__subscribe">
                <div class="widget-subscribe">
                  <div class="widget-subscribe__title">Подписка на новости</div>
                  <form action="" class="widget-subscribe__form">
                    <div class="widget-subscribe__controls">
                      <input type="text" name="email" class="widget-subscribe__input" placeholder="Ваш e-mail" />
                      <button class="widget-subscribe__submit"></button>
                    </div>
                    <label class="widget-subscribe__approve">
                      <input type="checkbox" name="approve">
                      <span></span>
                      Согласие на <a href="#">обработку данных</a>
                    </label>
                  </form>
                </div>
              </div>
            </div>

            <div class="home-layout__center">
              <div class="widget-side">
                <div class="widget-side__title">Аналитика</div>
                <div class="analytics-list">
                  <div class="analytics-list__item">
                    <article class="card-medium">
                      <figure class="card-medium__media">
                        <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="" class="card-medium__image" />
                        <ul class="card-medium__tags">
                          <li class="card-medium__tag">Внутренний рынок</li>
                          <li class="card-medium__tag">Цены</li>
                        </ul>
                      </figure>
                      <div class="card-medium__date">05.06.2023</div>
                      <a href="#" class="card-medium__title">Агросектор обречен на снижение. Высокая база прошлого года не позволит отрасли продемонстрировать рост</a>
                    </article>
                  </div>
                  <div class="analytics-list__item">
                    <article class="card-medium">
                      <figure class="card-medium__media">
                        <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="" class="card-medium__image" />
                        <ul class="card-medium__tags">
                          <li class="card-medium__tag">Внутренний рынок</li>
                          <li class="card-medium__tag">Цены</li>
                        </ul>
                      </figure>
                      <div class="card-medium__date">05.06.2023</div>
                      <a href="#" class="card-medium__title">Агросектор обречен на снижение. Высокая база прошлого года не позволит отрасли продемонстрировать рост</a>
                    </article>
                  </div>
                  <div class="analytics-list__item">
                    <article class="card-medium">
                      <figure class="card-medium__media">
                        <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="" class="card-medium__image" />
                        <ul class="card-medium__tags">
                          <li class="card-medium__tag">Внутренний рынок</li>
                          <li class="card-medium__tag">Цены</li>
                        </ul>
                      </figure>
                      <div class="card-medium__date">05.06.2023</div>
                      <a href="#" class="card-medium__title">Агросектор обречен на снижение. Высокая база прошлого года не позволит отрасли продемонстрировать рост</a>
                    </article>
                  </div>
                </div>
              </div>
            </div>

            <div class="home-layout__right">
              <div class="widget-side">
                <div class="widget-side__title">Цены и балансы</div>
                <ul class="vertical-menu">
                  <li class="menu-item">
                    <a href="#">
                    База данных по ценам на торговых площадках РФ
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#">
                    База данных по ценам на зарубежных торговых площадках
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#">
                    Обзор зарубежных цен
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#">
                    Балансы мировых рынков
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="#">
                    База данных по внешней торговле
                    </a>
                  </li>
                </ul>
              </div>

              <div class="home-layout__hot">
                <div class="widget-side">
                  <div class="widget-side__title">самое читаемое</div>
                  <div class="hot-list">
                    <div class="hot-list__item">
                      <article class="card-flat">
                        <a href="#" class="card-flat__title">Масла по миру дешевеют. Что происходило с ценами на сырье и готовую продукцию в мае?</a>
                        <div class="card-flat__foot">
                          <div class="card-flat__date">02.06.2023</div>
                          <div class="card-flat__views">20201</div>
                        </div>
                      </article>
                    </div>
                    <div class="hot-list__item">
                      <article class="card-flat">
                        <a href="#" class="card-flat__title">Масла по миру дешевеют. Что происходило с ценами на сырье и готовую продукцию в мае?</a>
                        <div class="card-flat__foot">
                          <div class="card-flat__date">02.06.2023</div>
                          <div class="card-flat__views">20201</div>
                        </div>
                      </article>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="home-layout__knowledge">
                <div class="widget-knowledge">
                  <div class="widget-knowledge__title">Центр знаний</div>
                  <figure class="widget-knowledge__media">
                    <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="" class="widget-knowledge__image" />
                  </figure>
                  <div class="widget-knowledge__content">
                    <a href="#" class="widget-knowledge__name">
                      Эксперт рассказал, как обнуление вывозной пошлины на масло повлияет на рынок
                    </a>
                    <div class="widget-knowledge__date">
                      31.05.2023
                    </div>
                  </div>
                </div>
              </div>

              <div class="home-layout__video">
                <div class="widget-side">
                  <div class="widget-side__title">Видеоролики</div>
                  <div class="video-list">
                    <div class="video-list__item">
                      <div class="card-video">
                        <figure class="card-video__media">
                          <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="" class="card-video__image" />
                        </figure>
                        <a class="card-video__title" href="#">Ход посевной кампании, производство масла в РФ, подорожание оливкового масла</a>
                      </div>
                    </div>
                    <div class="video-list__item">
                      <div class="card-video">
                        <figure class="card-video__media">
                          <img src="<?php bloginfo('template_url') ?>/dist/images/Layer_4.png" alt="" class="card-video__image" />
                        </figure>
                        <a class="card-video__title" href="#">Ход посевной кампании, производство масла в РФ, подорожание оливкового масла</a>
                      </div>
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
