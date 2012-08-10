<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
  <?php roots_post_before(); ?>
    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    <?php roots_post_inside_before(); ?>
      <header>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php roots_entry_meta(); ?>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <footer>
        <?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
        <?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
        <div class="row">
          <div class="span4">
            <h5><?php echo _e('Enjoyed this Post?') ?></h5>
            <p>
              Subscribe to our RSS Feed, Follow us on Twitter or simply recommend us to friends and colleagues!
              <div class="social-media-facebook">
                <div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="lucida grande"></div>
              </div>
              <div class="social-media-twitter">
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="pixlpitch" data-hashtags="magento">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
              </div>
              <div class="social-media-gplus">
              <!-- Place this tag where you want the share button to render. -->
              <div class="g-plus" data-action="share" data-height="15"></div>
              <!-- Place this tag after the last share tag. -->
              <script type="text/javascript">
                (function() {
                  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                  po.src = 'https://apis.google.com/js/plusone.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                })();
              </script>
              </div>
            </p>
          </div>
          <div class="span4">
            <h5><?php echo _e('Related Posts') ?></h5>
          </div>
        </div>
      </footer>
      <?php comments_template(); ?>
      <?php roots_post_inside_after(); ?>
    </article>
  <?php roots_post_after(); ?>
<?php endwhile; /* End loop */ ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>