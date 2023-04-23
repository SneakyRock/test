<?php
/**
 * Template for displaying a single camper in a bootstrap card.
 *
 * This template can be overridden by copying it to yourtheme/dp-camper/card-dp_camper.php.
 *
 */

defined( 'ABSPATH' ) || exit;

$thumbnail = get_the_post_thumbnail_url();
$model = get_post_meta( get_the_ID(), 'model', true );
$seats = get_post_meta( get_the_ID(), 'seats', true );
$sleeping_places = get_post_meta( get_the_ID(), 'sleeping_places', true );
$object_url = get_post_meta( get_the_ID(), 'object_url', true );
?>
<div class="card mb-3">
    <div class="row g-0">
        <?php if ( $thumbnail ) : ?>
            <div class="col-md-4">
                <img src="<?php echo esc_url( $thumbnail ); ?>" class="img-fluid rounded-start" alt="<?php the_title_attribute(); ?>">
            </div>
        <?php endif; ?>
        <div class="<?php echo $thumbnail ? 'col-md-8' : 'col-md-12'; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <ul class="list-unstyled">
                    <li><strong><?php _e( 'Model:', 'dp-camper' ); ?></strong> <?php echo esc_html( $model ); ?></li>
                    <li><strong><?php _e( 'Seats:', 'dp-camper' ); ?></strong> <?php echo esc_html( $seats ); ?></li>
                    <li><strong><?php _e( 'Sleeping Places:', 'dp-camper' ); ?></strong> <?php echo esc_html( $sleeping_places ); ?></li>
                    <?php if ( $object_url ) : ?>
                        <li><strong><?php _e( 'Object Detail URL:', 'dp-camper' ); ?></strong> <a href="<?php echo esc_url( $object_url ); ?>" target="_blank"><?php echo esc_html( $object_url ); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>