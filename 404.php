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
        <main class="main">
          <div class="archive-layout">
            <div class="archive-layout__content">
              <h1>404 Страница не найдена.</h1>
              <div class="content">
                <p>Ничего не найдено по этому пути. Попробуйте воспользоваться ссылками ниже или поиском.</p>
              </div>
            </div>
            <div class="archive-layout__right sidebar">
              <?php get_default_sidebar() ?>
            </div>
          </div>
        </main>
      </div>
    
      <?php get_template_part('partials/footer') ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
