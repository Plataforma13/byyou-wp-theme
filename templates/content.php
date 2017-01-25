<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-category"><a href="<?php the_permalink(); ?>"><?= get_categories()[0]->name; ?></a></h2>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large');?></a>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
