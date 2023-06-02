<a href="<?php the_permalink(); ?>" class="safari-card p-relative">
    <figure>
        <div class="safari-media-box">
        <?php
        if ( has_post_thumbnail() ) {
            the_post_custom_thumbnail(
                get_the_ID(),
                'c-medium',
                [
                    'size'  => '(max-width: 480px), 480px, 315px',
                    'class' => 'safari-card__img'
                ]
            );
        } else { ?>
            <img class="safari-card__img" src="https://via.placeholder.com/480x480" alt="Card imag cap">
        <?php } ?>
        </div>
        <figcaption class="safari-card__content">
            <h3 class="card-header"><?php echo esc_html( get_the_title() ); ?></h3>
            <div class="card-cta">
                <?php esc_html_e( 'View the Park', 'saturn' ); ?>
            </div>
        </figcaption>
    </figure>
</a>
