<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <?php the_post_thumbnail('medium_large', array('class' => 'card-img-top')); ?>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php the_title(); ?></h5>
              <p class="card-text"><?php echo get_post_meta(get_the_ID(), 'dp_camper_seats', true); ?> Seats</p>
              <p class="card-text"><?php echo get_post_meta(get_the_ID(), 'dp_camper_sleeping_places', true); ?> Sleeping Places</p>
              <a href="<?php echo get_post_meta(get_the_ID(), 'dp_camper_object_detail_url', true); ?>" class="btn btn-primary" target="_blank">Details</a>
            </div>
          </div>
        </div>
      </div>

      <?php endwhile; endif; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>