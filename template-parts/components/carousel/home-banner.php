<?php
/**
 * Home carousel template
 *
 *
 * @package saturn
 */

 ?>

<!-- Swiper -->

<div class="swiper homeSlider">
    <div class="swiper-wrapper">
        <?php 
        $image = get_field('home_carousel_image_one');
        $size = 'full'; // (thumbnail, medium, large, full or custom size)
        if( $image ) : ?>
            <div class="swiper-slide">
                <?php
                echo wp_get_attachment_image( $image, $size, "", ["class" => "swiper-lazy"] ); ?>
                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                <div class="homeSlider__content">
                    <div class="container">
                        <div class="homeSlider__content--box">
                        <?php 
                        if ( get_field( 'home_carousel_copy_one' ) ): ?>
                        <h1 class="slider-copy"><?php the_field( 'home_carousel_copy_one' ); ?></h1>                
                        <?php endif; ?>
                        <!-- <p class="slider-brief">With competitive prices and flexible rental periods, renting a car has never been easier.</p> -->
                        <?php if ( get_field( 'home_carousel_button_url_one' ) ): ?>
                        <a class="btn btn-white btn-icon btn-lg slider-button" href="<?php the_field( 'home_carousel_button_url_one' ); ?>" target="_blank"><?php the_field( 'home_carousel_button_text_one' ); ?> <svg width="20" height="20"><use href="#icon-right-arrow"></use></svg><svg width="20" height="20"><use href="#icon-basket"></use></svg></a>
                        <?php endif; ?>
                        </div>                        
                    </div>
                </div>                
            </div>
        <?php endif; ?>

        <?php 
        $image = get_field('home_carousel_image_two');
        $size = 'full'; // (thumbnail, medium, large, full or custom size)
        if( $image ) : ?>
            <div class="swiper-slide">
                <?php
                echo wp_get_attachment_image( $image, $size, "", ["class" => "swiper-lazy"] ); ?>
                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                <div class="homeSlider__content">
                    <div class="container">
                        <div class="homeSlider__content--box">
                        <?php 
                        if ( get_field( 'home_carousel_copy_two' ) ): ?>
                        <h1 class="slider-copy"><?php the_field( 'home_carousel_copy_two' ); ?></h1>      
                        <?php endif; ?>
                        
                        <?php if ( get_field( 'home_carousel_button_url_two' ) ): ?>
                        <a class="btn btn-white btn-icon btn-lg slider-button" href="<?php the_field( 'home_carousel_button_url_two' ); ?>" target="_blank"><?php the_field( 'home_carousel_button_text_two' ); ?> <svg width="20" height="20"><use href="#icon-right-arrow"></use></svg></a>
                        <?php endif; ?>
                        </div>                    
                    </div>
                </div>                
            </div>
        <?php endif; ?>

        <?php 
        $image = get_field('home_carousel_image_three');
        $size = 'full'; // (thumbnail, medium, large, full or custom size)
        if( $image ) : ?>
            <div class="swiper-slide">
                <?php
                echo wp_get_attachment_image( $image, $size, "", ["class" => "swiper-lazy"] ); ?>
                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                <div class="homeSlider__content">
                    <div class="container">
                        <div class="homeSlider__content--box">
                        <?php 
                        if ( get_field( 'home_carousel_copy_three' ) ): ?>
                        <h1 class="slider-copy"><?php the_field( 'home_carousel_copy_three' ); ?></h1>    
                        <?php endif; ?>

                        <?php if ( get_field( 'home_carousel_button_url_three' ) ): ?>
                        <a class="btn btn-white btn-icon btn-lg slider-button" href="<?php the_field( 'home_carousel_button_url_three' ); ?>" target="_blank"><?php the_field( 'home_carousel_button_text_three' ); ?> <svg width="20" height="20"><use href="#icon-right-arrow"></use></svg></a>
                        <?php endif; ?>
                        </div>                    
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="swiper-button-next" id="carousel-next"></div>
    <div class="swiper-button-prev" id="carousel-prev"></div>
    <div class="swiper-pagination"></div>
</div>
