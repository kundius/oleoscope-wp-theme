<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OleoScope
 */
?>
<?php
if ( !empty(get_field('about_company')) )
{
?>
<aside id="primary" class="widget-area">
  <section class="acf_about_company">
    <h2><?= __('Company Profile', 'oleoscope') ?></h2>
    <?php the_field('about_company'); ?>

    <?php if ( !empty(get_field('about_company_link')) ) : ?>
    <p><a class="readmore" href="<?php the_field('about_company_link'); ?>"><?= __('More about this company', 'oleoscope') ?></a></p>
    <?php endif; ?>
  </section>
</aside><!-- #secondary -->
<?php
}
?>