<?php
if (post_password_required()) {
  return;
}
?>

<section id="comments" class="post-comments">
  <?php if (have_comments()) : ?>
    <h2 class="total-comments">Comentários (<?=get_comments_number()?>)</h2>
  <?php endif; // have_comments() ?>

  <?php //comment_form(); ?>
  <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" class="reply">
    <?php echo get_avatar( wp_get_current_user()->user_email, 59 ); ?>
    <input type="text" id="comment" name="comment" maxlength="65525" aria-required="true" required="required"></textarea>
    <?php if ( !is_user_logged_in() ) { ?>
    <button class="send fb-login">Enviar</button>
    <?php } else { ?>
    <input type="submit" class="send" value="Enviar">
    <?php } ?>
    <input type="hidden" name="comment_post_ID" value="1" id="<?=get_post_ID?>">
    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
  </form>

  <?php if (have_comments()) : ?>

    <div class="comment list">
      <?php wp_list_comments( 'type=comment&callback=mytheme_comment&style=div&max_depth=2&avatar_size=59' ); ?>
    </div>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav>
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
  <?php endif; // have_comments() ?>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'sage'); ?>
    </div>
  <?php endif; ?>

</section>
