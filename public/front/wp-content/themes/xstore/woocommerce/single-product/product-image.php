<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


global $post, $etheme_global, $post_id, $product, $is_IE, $main_slider_on, $attachment_ids, $main_attachment_id;

$post_id = get_the_ID();

if( defined('DOING_AJAX') && DOING_AJAX && ! isset($etheme_global['quick_view']) ) {
    if( ! empty( $_REQUEST['product_id'] ) ) {
        $post_id = (int) $_REQUEST['product_id'];
        setup_postdata( $post_id );
        $main_attachment_id = get_post_thumbnail_id( $post_id );
        $product = wc_get_product($post_id);
        if( ! empty($_REQUEST['option']) ) {
            $option = esc_attr($_REQUEST['option']);
            $attributes = $product->get_attributes();
            $variations = $product->get_available_variations();
            $images = '';
            $thumb = '';
            $attachment_ids = array();

            foreach($variations as $variation) {
                if( isset( $variation['attributes']['attribute_' . $swatch] ) && $variation['attributes']['attribute_' . $swatch] == $option && has_post_thumbnail( $variation['variation_id'] ) ) {
                    $main_attachment_id = get_post_thumbnail_id( $variation['variation_id'] );
                }
            }

        }
    }

} else {
    $attachment_ids = $product->get_gallery_image_ids();
    $main_attachment_id = get_post_thumbnail_id( $post_id );
}



$has_video = false;

$gallery_slider = ( isset( $etheme_global['gallery_slider'] ) ) ? $etheme_global['gallery_slider'] : '';
$vertical_slider = ( isset( $etheme_global['vertical_slider'] ) ) ? $etheme_global['vertical_slider'] : '';
$show_thumbs = ( isset( $etheme_global['show_thumbs'] ) ) ? $etheme_global['show_thumbs'] : '';

if( defined('DOING_AJAX') && DOING_AJAX ) {
    $gallery_slider = true;
}

$video_attachments = array();
$videos = etheme_get_attach_video($product->get_id());
if(isset($videos[0]) && $videos[0] != '') {
    $video_attachments = get_posts( array(
        'post_type' => 'attachment',
        'include' => $videos[0]
    ) );
}

if(count($video_attachments)>0 || etheme_get_external_video($product->get_id()) != '') {
    $has_video = true;
}

$main_slider_on = ( count( $attachment_ids ) > 0 || $has_video );

$class = '';
if ( $main_slider_on ) {
    $class .= ' main-slider-on';
}

$class .= ( $gallery_slider ) ? ' gallery-slider-on' : ' gallery-slider-off';

if ( $is_IE ) {
    $class .= ' ie';
}

$et_zoom = etheme_get_option( 'product_zoom' );
$et_zoom_class = 'woocommerce-product-gallery__image';

if ( $et_zoom ) {
    $class .= ' zoom-on';
}

if ( ! $gallery_slider ) {
    $wrapper_classes = array();
}

?>


<?php if ( ! defined('DOING_AJAX') && ! isset($etheme_global['quick_view']) ): ?>
    <div class="swiper-entry swipers-couple-wrapper images-wrapper arrows-hovered <?php if ( $vertical_slider && $gallery_slider && $attachment_ids ) echo'swiper-vertical-images'; ?>">
<?php endif;

$swiper_container = '';
$swiper_wrapper = '';
if ( $gallery_slider && ( count($attachment_ids) > 0 || $has_video ) ){
    $swiper_container = 'swiper-container';
    $swiper_wrapper = 'swiper-wrapper';
}
    ?>
    <div class="<?php echo esc_attr($swiper_container); ?> images<?php echo esc_attr( $class ); ?> swiper-control-top" data-space="10" <?php echo (etheme_get_option('thumbs_autoheight')) ? 'data-autoheight="true"' : ''?>>
        <div class="<?php echo esc_attr($swiper_wrapper); ?> main-images">
            <?php if ( has_post_thumbnail( $post_id ) ) {

                $index = 0;
                $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
                $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
                $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
                $placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';

                // **********************************************************************************************
                // ! Main product image
                // **********************************************************************************************

                $attributes = array(
                    'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
                    'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
                    'data-src'                => $full_size_image[0],
                    'data-large_image'        => $full_size_image[0],
                    'data-large_image_width'  => $full_size_image[1],
                    'data-large_image_height' => $full_size_image[2]
                );

                $gallery_slider = ($gallery_slider) ? 'swiper-slide' : '';
                $html  = '<div class="'.$gallery_slider.' images woocommerce-product-gallery woocommerce-product-gallery__wrapper"><div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_catalog' ) . '" class="'. $et_zoom_class .'"><a class="woocommerce-main-image pswp-main-image zoom" href="' . esc_url( $full_size_image[0] ) . '" data-width="' . esc_attr( $full_size_image[1] ) . '" data-height="' . esc_attr( $full_size_image[2] ) . '" data-index="'. $index .'">';
                $html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
                $html .= '</a></div></div>';

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

                // **********************************************************************************************
                // ! Product slider
                // **********************************************************************************************

                if( $main_slider_on ){

                    if( count( $attachment_ids ) > 0 ) {
                        foreach ( $attachment_ids as $key => $attachment_id ) {
                            $index ++;
                            $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );

                            $attributes = array(
                                'title'                   => esc_attr( get_the_title( $attachment_id ) ),
                                'data-caption'            => esc_attr( get_the_excerpt( $attachment_id ) ),
                                'data-src'                => $full_size_image[0],
                                'data-large_image'        => $full_size_image[0],
                                'data-large_image_width'  => $full_size_image[1],
                                'data-large_image_height' => $full_size_image[2],
                            );

                            $html  = '<div class="'.esc_attr( $gallery_slider ).' images woocommerce-product-gallery woocommerce-product-gallery__wrapper"><div data-thumb="' . get_the_post_thumbnail_url( $attachment_id, 'shop_catalog' ) . '" class="' . $et_zoom_class . '"><a href="' . esc_url( $full_size_image[0] ) . '"  data-large="'.esc_url( $full_size_image[0] ).'" data-width="' . esc_attr( $full_size_image[1] ) . '"  data-height="' . esc_attr( $full_size_image[2] ) . '" data-index="'. $index .'" itemprop="image" class="woocommerce-main-image zoom" >';


                            $html .= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), false, $attributes );
                            $html .= '</a></div></div>';

                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $attachment_id ) );
                        }
                    }

                }

            } else {
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src( 'woocommerce_single' ), esc_html__( 'Placeholder', 'xstore' ) ), $post_id );
            }
            ?>
            <?php if(etheme_get_external_video($product->get_id())): ?>
            <div class="<?php echo esc_attr( $gallery_slider ); ?> images woocommerce-product-gallery">
                <?php echo etheme_get_external_video($product->get_id()); ?>
            </div>
            <?php endif; ?>

            <?php if(count($video_attachments)>0): ?>
                <div class="<?php echo esc_attr( $gallery_slider ); ?> images woocommerce-product-gallery">
                    <video controls="controls">
                        <?php foreach($video_attachments as $video):  ?>
                            <?php $video_ogg = $video_mp4 = $video_webm = false; ?>
                            <?php if($video->post_mime_type == 'video/mp4' && !$video_mp4): $video_mp4 = true; ?>
                                <source src="<?php echo esc_url( $video->guid ); ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                            <?php endif; ?>
                            <?php if($video->post_mime_type == 'video/webm' && !$video_webm): $video_webm = true; ?>
                                <source src="<?php echo esc_url( $video->guid ); ?>" type='video/webm; codecs="vp8, vorbis"'>
                            <?php endif; ?>
                            <?php if($video->post_mime_type == 'video/ogg' && !$video_ogg): $video_ogg = true; ?>
                                <source src="<?php echo esc_url( $video->guid ); ?>" type='video/ogg; codecs="theora, vorbis"'>
                                <?php esc_html_e('Video is not supporting by your browser', 'xstore'); ?>
                                <a href="<?php echo esc_url( $video->guid ); ?>"><?php esc_html_e('Download Video', 'xstore'); ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </video>
                </div>
            <?php endif; ?>

        </div>
        <?php if( count( $attachment_ids ) > 0 ) { ?>
            <div class="swiper-pagination"></div>
        <?php } ?>

        <?php etheme_360_view_block(); ?>

        <?php
        if ( $gallery_slider &&(  count( $attachment_ids ) > 0 || $has_video ) ) {
            echo '<div class="swiper-custom-left"></div>
                  <div class="swiper-custom-right"></div>
            ';
        } ?>

    </div>

    <div class="empty-space col-xs-b15 col-sm-b30"></div>
<?php
if($gallery_slider && $show_thumbs) {
    global $post_id, $product, $woocommerce, $main_slider_on, $attachment_ids, $main_attachment_id;

    $zoom_plugin = etheme_is_zoom_activated();

    $thums_size = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );

    $ul_class = '';
    if (!$vertical_slider) {
    $ul_class = 'swiper-wrapper '; }

    $ul_class .= 'right thumbnails-list';

    if( $zoom_plugin ) {
        $ul_class .= ' yith_magnifier_gallery';
    }

    if ( $vertical_slider && is_rtl() ) {
        $ul_class .= ' slick-rtl';
    }

    if( empty( $attachment_ids ) ) {
        $attachment_ids = $product->get_gallery_image_ids();
    }

    if ( $attachment_ids || $has_video ) {
        $loop       = 0;
        $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
        $res_slides = etheme_get_option('count_slides') ? etheme_get_option('count_slides') : 4;
        ?>
        <div class="<?php echo (!$vertical_slider) ? 'swiper-container swiper-control-bottom thumbnails ' : 'vertical-thumbnails'; ?> <?php echo 'columns-' . $columns; ?> <?php echo (count($attachment_ids) + 1 <= $res_slides) ? ' no-arrows' : ''; ?> <?php echo (!$gallery_slider) ? 'noslider' : 'slider'; ?>" <?php if (!$vertical_slider) : ?>data-breakpoints="1" data-xs-slides="<?php echo ( etheme_get_option('responsive_slides') ) ? etheme_get_option('responsive_slides') : 3 ?>" data-sm-slides="<?php echo esc_attr( $res_slides ); ?>" data-md-slides="<?php echo esc_attr( $res_slides ); ?>" data-lt-slides="<?php echo esc_attr( $res_slides ); ?>" data-slides-per-view="<?php echo esc_attr( $res_slides ); ?>" data-clickedslide="1" data-space="10" <?php echo (etheme_get_option('thumbs_autoheight')) ? 'data-autoheight="true"' : ''; ?> <?php endif;?>>
            <?php etheme_loader(); ?>
            <ul class="<?php echo esc_attr( $ul_class ); ?>"<?php if ($vertical_slider) echo 'data-slick={"slidesToShow":'.esc_attr( $res_slides ) . '}';?>>
                <?php

                if( count( $attachment_ids ) > 0 || $has_video ) {
                    $type_slider = ($vertical_slider) ? 'slick-slide' : 'swiper-slide';
                    $classes = array( 'zoom' );

                    $image       = wp_get_attachment_image( $main_attachment_id, $thums_size );
                    $image_class = esc_attr( implode( ' ', $classes ) );
                    $image_title = esc_attr( get_the_title( $main_attachment_id ) );


                    $image_link  = wp_get_attachment_image_src( $main_attachment_id, 'full' );

                    list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $main_attachment_id, "shop_single" );
                    list( $magnifier_url, $magnifier_width, $magnifier_height ) = wp_get_attachment_image_src( $main_attachment_id, "shop_magnifier" );
                    if ( has_post_thumbnail( $post_id ) ) {
                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li class="'.$type_slider.' thumbnail-item %s"><a href="%s" class="pswp-additional %s" title="%s" data-small="%s" data-large="%s" data-width="%s" data-height="%s">%s</a></li>', $image_class, $magnifier_url, $image_class, $image_title, $thumbnail_url, $image_link[0], $image_link[1], $image_link[2], $image ), $post_id, $post_id, $image_class );
                    }
                }

                foreach ( $attachment_ids as $attachment_id ) {
                    $classes = array( 'zoom' );

                    $image_link = wp_get_attachment_url( $attachment_id );

                    if ( ! $image_link )
                        continue;

                    $image       = wp_get_attachment_image( $attachment_id, $thums_size );
                    $image_class = esc_attr( implode( ' ', $classes ) );
                    $image_title = esc_attr( get_the_title( $attachment_id ) );
                    $image_link  = wp_get_attachment_image_src( $attachment_id, 'full' );

                    list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $attachment_id, "shop_single" );
                    list( $magnifier_url, $magnifier_width, $magnifier_height ) = wp_get_attachment_image_src( $attachment_id, "shop_magnifier" );

                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li class="'.$type_slider.' thumbnail-item %s"><a href="%s" data-large="%s" data-width="%s" data-height="%s" class="pswp-additional %s" title="%s" data-small="%s">%s</a></li>', $image_class, $magnifier_url, $image_link[0], $image_link[1], $image_link[2], $image_class, $image_title, $thumbnail_url, $image ), $attachment_id, $post_id, $image_class );
                    $loop++;
                }
                ?>

                <?php if(etheme_get_external_video( $product->get_id() )): ?>
                    <li class="video-thumbnail thumbnail-item <?php echo esc_attr( $type_slider ); ?>">
                        <a href="#product-video-popup" class="open-video-popup">
                            <span class="et-icon et-play-button"></span>
                            <p><?php esc_html_e('video', 'xstore'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php if(count($video_attachments)>0): ?>
                    <li class="video-thumbnail thumbnail-item <?php echo esc_attr( $type_slider ); ?>">
                        <a href="#product-video-popup" class="open-video-popup">
                            <span class="et-icon et-play-button"></span>
                            <p><?php esc_html_e('video', 'xstore'); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
            <?php if ($vertical_slider) { ?> <div class="swiper-vertical-navig"></div> <?php }
            if( ( count( $attachment_ids ) > 0 || $has_video )&& !$vertical_slider ) { ?>
                    <div class="swiper-custom-left thumbnails-bottom"></div>
                    <div class="swiper-custom-right thumbnails-bottom"></div>
                <?php } ?>

        </div> 
        <?php
    }
}?>

<?php if ( ! defined('DOING_AJAX') && ! isset($etheme_global['quick_view']) ): ?>
    </div>
<?php endif;