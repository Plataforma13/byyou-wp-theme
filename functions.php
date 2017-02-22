<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <div class="comment-body">
      <?php if ( 'div' != $args['style'] ) : ?>
          <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php endif; ?>
      <div class="comment-author vcard">
          <?php echo get_avatar( $comment, 59 ); ?>
          <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
      </div>
      <?php if ( $comment->comment_approved == '0' ) : ?>
           <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
            <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
          <?php
          /* translators: 1: date, 2: time */
          printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
          ?>
      </div>

      <?php comment_text(); ?>


    </div>

    <?php if ( $depth < $args['max_depth'] ) : ?>
      <form action="http://localhost:8080/blog/wp-comments-post.php" method="post" class="reply">
          <?php echo get_avatar( wp_get_current_user()->user_email, 59 ); ?>
          <input type="text" id="comment" name="comment" maxlength="65525" aria-required="true" required="required"></textarea>
          <?php if ( !is_user_logged_in() ) { ?>
          <button class="send fb-login">Enviar</button>
          <?php } else { ?>
          <input type="submit" class="send" value="Enviar">
          <?php } ?>
          <input type="hidden" name="comment_post_ID" value="1" id="<?=$comment->comment_post_ID?>">
          <input type="hidden" name="comment_parent" id="comment_parent" value="<?php comment_ID() ?>">
      </form>
    <?php endif; ?>


    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
}

// add_filter('get_comments_number', 'comment_count', 0);
// function comment_count( $count ) {
// if ( ! is_admin() ) {
// global $id;
// $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
// return count($comments_by_type['comment']);
// } else {
// return $count;
// }
// }


// Run this code on 'after_theme_setup', when plugins have already been loaded.
add_action('after_setup_theme', 'my_load_plugin');
// This function loads the plugin.
function my_load_plugin() {
// Check to see if your plugin has already been loaded. This can be done in several
// ways - here are a few examples:
//
// Check for a class:
//  if (!class_exists('MyPluginClass')) {
//
// Check for a function:
//  if (!function_exists('my_plugin_function_name')) {
//
// Check for a constant:
//  if (!defined('MY_PLUGIN_CONSTANT')) {
  if (!class_exists('Social')) {
    // load Social if not already loaded
    // die(get_template_directory());
    include_once(get_template_directory().'/plugins/wp-ulike/wp-ulike.php');
  }

  include_once(get_template_directory().'/plugins/zm-ajax-login-register/plugin.php');


}
