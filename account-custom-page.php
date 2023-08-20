<?php

/*
*   Template Name: Account Page
*/

if ( is_user_logged_in() && is_account_page() ) {
    get_header();
} else {
    get_header( "noheader" );
}



$the_post_id = get_the_ID();
$hide_title = get_post_meta( $the_post_id, '_hide_page_title', true);
$heading_class = ! empty( $hide_title ) && 'yes' === $hide_title ? 'hide' : '';

?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); ?>

			
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header p-relative <?php if ( is_user_logged_in() && is_account_page() ) { ?>account-header mb-6<?php } ?>"
                <?php if ( is_user_logged_in() && is_account_page() ) { ?> style="background-image: url(<?php
                if ( has_post_thumbnail() ) {
                    $featured_image_url = get_the_post_thumbnail_url();
                    echo esc_url( $featured_image_url );
                }
                ?>);"<?php }
                
                
                ?>>
                    <div class="wrapper p-0 <?php if ( ! is_user_logged_in() && is_account_page() ) { ?>screen-reader-text<?php } ?>">
                        <?php 
                        if ( is_user_logged_in() && is_account_page() ) {

                            $user = wp_get_current_user();
                            if ( $user->exists() ) {
                                $display_name = $user->display_name ? $user->display_name : $user->first_name;
                                echo '<h1 class="entry-title">Welcome ' . esc_html( $display_name ) . '</h1>';
                            }
                        } else {
                            // the_title( '<h1 class="entry-title">', '</h1>' ); 
                            printf(
                                '<h1 class="page-title %1$s">%2$s</h1>',
                                esc_attr( $heading_class ),
                                wp_kses_post( get_the_title() )
                            );
                        }                    
                        ?>
                    </div>
                </header><!-- .entry-header -->


                <div class="entry-content <?php if ( is_user_logged_in() && is_account_page() ) { ?>account-main<?php } else { ?>account-reg<?php } ?>">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'saturn' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->




                <?php if ( get_edit_post_link() ) : ?>
                    <footer class="entry-footer wrapper">
                        <?php
                        edit_post_link(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __( 'Edit <span class="screen-reader-text">%s</span>', 'saturn' ),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                wp_kses_post( get_the_title() )
                            ),
                            '<span class="edit-link">',
                            '</span>'
                        );
                        ?>
                    </footer><!-- .entry-footer -->
                <?php endif; ?>
            </article><!-- #post-<?php the_ID(); ?> -->








            <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
        <div class="clear"></div>
	</main><!-- #main -->

<?php
if ( is_user_logged_in() && is_account_page() ) {
    get_footer();
} else {
    get_footer( "nofooter" );
}