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
          При использовании материалов OleoScope.ru гиперссылка обязательна, в бумажных источниках обязательно указание ссылки на источник.<br>
          Настоящий ресурс содержит материалы категории <span>18+</span>
        </div>
        <div class="footer-secondary__copyright">© OleoScope 2023</div>
        <div class="footer-secondary__counters">
          <!-- Google tag (gtag.js) -->
          <script async src="https://www.googletagmanager.com/gtag/js?id=G-9M1PVGTD44"></script>
          <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
          
            gtag('config', 'G-9M1PVGTD44');
          </script>
          
          <!-- Yandex.Metrika counter -->
          <script type="text/javascript" >
             (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
             m[i].l=1*new Date();
             for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
             k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
             (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

             ym(55243105, "init", {
                  clickmap:true,
                  trackLinks:true,
                  accurateTrackBounce:true,
                  webvisor:true
             });
          </script>
          <noscript><div><img src="https://mc.yandex.ru/watch/55243105" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
          <!-- /Yandex.Metrika counter -->
        </div>
      </div>
    </div>
  </div>
</footer>
