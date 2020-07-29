    <footer class="site-footer">
      <div class="site-footer-inner">
        <div class="footer-left">
          <?php if (have_rows('social', 'options')) : ?>
          <div class="socials">
            <?php while (have_rows('social', 'options')) : the_row(); ?>
            <div class="social">
              <a href="<?= get_sub_field('social_page') ?>"><i class="<?= get_sub_field('icon') ?>"></i></a>
            </div>
            <?php endwhile; ?>
          </div>
          <?php endif; ?>
          <div id="footer-phone-line"><?= sea_add_footer_phone_line() ?></div>
          <div id="footer-email-line"><?= sea_add_footer_email_line() ?></div>
          <div id="footer-address-line"><?= sea_add_footer_address_line() ?></div>
        </div>
        <div class="footer-right">
          <div id="footer-text-block"><?= sea_add_footer_text_block() ?></div>
          <p class="copyright">&copy; <?php echo date('Y'); ?> <span class="name"><?php bloginfo('name'); ?></span></p>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
    </body>

    </html>