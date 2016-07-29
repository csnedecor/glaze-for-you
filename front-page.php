<?php

    if ( get_option( 'show_on_front' ) == 'posts' ) {
        get_template_part( 'index' );
    } elseif ( 'page' == get_option( 'show_on_front' ) ) {

 get_header(); ?>

  <div id="primary" class="content-area col-sm-12 col-md-12">
    <main id="main" class="site-main" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-content">
            <!-- Header slideshow -->
            <?php if( have_rows('slideshow') ): ?>
              <?php $i = 0; ?>
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <?php while( have_rows('slideshow') ): the_row(); ?>
                  <?php if ($i == 0) { ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>" class="active"></li>
                  <?php } else { ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i ?>"></li>
                  <?php } ?>
                    <?php $i++; ?>
                  <?php endwhile; ?>
                </ol>

                <div class="carousel-inner" role="listbox">
                  <?php $z = 0; ?>
                  <?php while( have_rows('slideshow') ): the_row();

                    // vars
                    $image = get_sub_field('slide_image');
                    $title = get_sub_field('slide_title');
                    $caption = get_sub_field('slide_caption');
                    $button_text = get_sub_field('button_text');
                    $link = get_sub_field('button_url');
                    ?>

                    <div class="item <?php if ($z == 0) { echo 'active';}?>">
                      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>">
                      <div class="carousel-caption">
                        <?php if (!empty($title)) { ?>
                          <h4 <?php if (empty($caption)) { echo 'class="no-caption"';} ?>><?php echo $title ?></h4>
                        <?php } ?>
                        <?php if (!empty($caption)) { ?>
                          <p <?php if (empty($title)) { echo 'class="no-caption"';} ?>><?php echo $caption ?></p>
                        <?php } ?>
                        <?php if (!empty($button_text) && !empty($link)) { ?>
                          <div class="button-wrap">
                            <a href="<?php echo $link ?>" class="slider-button"><?php echo $button_text ?></a>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <?php $z++; ?>
                  <?php endwhile; ?>
                </div>
                <?php if (count(get_field('slideshow')) > 1) { ?>
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                <?php } ?>
              </div>
              <?php endif; ?>
        </div>
      </article>
    </main>
  </div>
  <div id="primary" class="content-area col-sm-12 col-md-8">
    <main id="main" class="site-main" role="main">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-content">

            <?php the_content(); ?>
            <?php
              wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
                'after'  => '</div>',
              ) );
            ?>
          </div><!-- .entry-content -->
          <?php edit_post_link( __( 'Edit', 'unite' ), '<footer class="entry-meta"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
        </article><!-- #post-## -->



        <?php
          // If comments are open or we have at least one comment, load up the comment template
          if ( comments_open() || '0' != get_comments_number() ) :
            comments_template();
          endif;
        ?>

      <?php endwhile; // end of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->
<?php get_sidebar(); ?>
<?php
  get_footer();
}
?>
