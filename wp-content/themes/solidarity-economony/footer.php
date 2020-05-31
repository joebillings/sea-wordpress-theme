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
          <p class="no-space"><?= the_field('telephone_number', 'options'); ?></p>
          <p class="no-space"><?= the_field('email_address', 'options'); ?></p>
          <?= the_field('address', 'options'); ?>
        </div>
        <div class="footer-right">
          <?= the_field('main_text', 'options'); ?>
          <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
    </body>

    </html>