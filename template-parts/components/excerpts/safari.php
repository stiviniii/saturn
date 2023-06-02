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
            <?php if( get_field('from_price') ): ?>
                <span class="price"><span><span><?php esc_html_e( 'FROM', 'saturn' ); ?></span><?php the_field('from_price'); ?><span><?php esc_html_e( '/pp', 'saturn' ); ?></span></span></span>
            <?php endif; ?>
            
            <h3 class="card-header"><?php echo esc_html( get_the_title() ); ?></h3>
            <?php
            if (has_category('Safari',$post->ID)) { ?>
                <p class="sub-header"><?php echo wp_trim_words(get_the_excerpt(), 24); ?></p>
            <?php } ?>
            
            <div class="card-cta">
                <?php esc_html_e( 'Uncover this adventure', 'saturn' ); ?>
            </div>
        </figcaption>
    </figure>
</a>
