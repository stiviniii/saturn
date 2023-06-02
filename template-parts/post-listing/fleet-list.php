<?php
/**
 * Template part for Trek group carousel
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neptune
 */

 $paged = get_query_var('paged');
 $casestudy = new WP_Query(array(
    'post_type'         	    => 'fleets',
    'posts_per_page'     	    => '16',
    'post_status'               => 'publish',
    'orderby'                   => 'name',
    'order'                     => 'ASC',
    'update_post_meta_cache'    => false,
    'update_post_term_cache'    => false,
    'hide_empty'                => 1,
    'depth'                     => 1,
    'paged'                     => $paged,
));
?>

<?php

if ( $casestudy->have_posts() ) :
    echo '<div class="row">';
    while ( $casestudy->have_posts() ) :
        $casestudy->the_post();
        global $wp_query;
        ?>

        <div class="col-md-6 col-lg-4 col-xl-3 my-1">
            <?php 
            get_template_part( 'template-parts/components/excerpts/fleet');
            ?>
        </div>

    <?php
    endwhile;
    echo '</div>';
    wp_reset_postdata();
    echo "<div class='row'><div class='page-pagination my-2'>" . paginate_links(array(
        'total' => $casestudy->max_num_pages,
        'prev_text' => __('« prev', 'neptune'),
        'next_text' => __('next »', 'neptune')
    )) . "</div></div>";

endif;
?>