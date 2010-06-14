<div style="margin-top:2em;">
  <?php if ($opt['Display'] == 'Y'): ?>
    <?php echo __('Short alternate link for this article: ') ?>
    <a href="<?php echo $shortUrl ?>"><?php echo get_post_meta($post->ID, 'GentleSourceShortURL', true); ?></a>
  <?php endif ?>
</div>