<footer class="footer">
  <div class="footer__primary">
    <div class="container">
      <div class="footer-primary">
        <a href="/" class="footer-primary__logo">
          <img src="<?php bloginfo('template_url') ?>/dist/images/logo.svg" alt="<?php bloginfo('name') ?>" width="300" height="100" >
        </a>
        <div class="footer-primary__nav">
          <?php wp_nav_menu([
            'theme_location' => 'menu-2',
            'container' => false,
            'menu_id' => 'footer-menu',
            'menu_class' => 'footer-menu',
            'depth' => 1,
          ]); ?>
        </div>
        <div class="footer-primary__social">
          <?php wp_nav_menu([
            'theme_location' => 'menu-social',
            'container' => false,
            'menu_id' => 'footer-social',
            'menu_class' => 'footer-social',
            'depth' => 1,
          ]); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__secondary">
    <div class="container">
      <div class="footer-secondary">
        <div class="footer-secondary__legal">
          При использовании материалов OleoScope.ru гиперссылка обязательна, в бумажных источниках обязательно указание ссылки на источник.<br />
          Настоящий ресурс содержит материалы категории <span>18+</span>
        </div>
        <div class="footer-secondary__copyright">© OleoScope 2023</div>
      </div>
    </div>
  </div>
</footer>
