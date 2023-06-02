<a href="<?php the_permalink(); ?>" class="fleet-card p-relative">
    <figure>
        <?php
        if ( has_post_thumbnail() ) {
            the_post_custom_thumbnail(
                get_the_ID(),
                'c-medium',
                [
                    'size'  => '(max-width: 480px), 480px, 315px',
                    'class' => 'fleet-card__img'
                ]
            );
        } else { ?>
            <img class="fleet-card__img" src="https://via.placeholder.com/480x480" alt="Card imag cap">
        <?php } ?>

        <figcaption class="fleet-card__content">
            <h3 class="card-title"><?php echo esc_html( get_the_title() ); ?></h3>
            <?php if( get_field('discount_percent') ): ?>
                <span class="offer"><span><?php the_field('discount_percent'); ?></span></span>
            <?php endif; ?>

            <div class="fleet-card__content--features">
                <?php if( get_field('fleet_color') ): ?>
                    <span><svg width="12" height="10"><use xlink:href="#icon-bag"></use></svg> <?php the_field('fleet_color'); ?></span>
                <?php endif; ?>
                <?php if( get_field('fuel_type') ): ?>
                    <span><svg width="12" height="10"><use xlink:href="#icon-bag"></use></svg> <?php the_field('fuel_type'); ?></span>
                <?php endif; ?>
            </div>
            <?php if( get_field('from_what_price') ): ?>
                <p class="price"><?php the_field('from_what_price'); ?></p>
            <?php endif; ?>
        </figcaption>
    </figure>
</a>
