<?php
    global $ngoCharity_options;
    $ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );
?>
<?php
    if($ngoCharity_settings['show_slider'] == 'yes')
    { 
        if($ngoCharity_settings['slider_options'] == 'single_post_slider')
        {
            $slider1 = get_post($ngoCharity_settings['slider1']);
            $slider2 = get_post($ngoCharity_settings['slider2']);
            $slider3 = get_post($ngoCharity_settings['slider3']);
        // }elseif($ngoCharity_settings['slider_options'] == 'cat_post_slider'){
        }else{
            $sliderCat = $ngoCharity_settings['slider_cat'];
            $noOfSlider = 3;
            $args = array('numberposts'=> $noOfSlider);
            if($sliderCat)
                $args = array('numberposts'=> $noOfSlider, 'category'=> $sliderCat);
            $posts = wp_get_recent_posts($args, OBJECT); //by default ARRAY_A

            $slider1 = $posts[0];
            $slider2 = $posts[1];
            $slider3 = $posts[2];
        }

    ?>

    
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
                <?php if ($slider1): ?>
                <li data-transition="papercut" data-slotamount="15" data-masterspeed="2300" data-delay="9400">
                    <?php 
                        if(has_post_thumbnail($slider1->ID))
                        {
                            echo get_the_post_thumbnail( $slider1->ID, 'full' );
                        }
                    ?>
                    <!-- <img src="<?php bloginfo('template_directory'); ?>/images/resource/slide-1.jpg" alt="slide"> -->
                    <div class="caption large_yallow lfl stl"
                        data-x="left"
                        data-y="170"
                        data-speed="500"
                        data-start="500"
                        data-easing="easeOutExpo"><?php echo $slider1->post_title; ?>
                    </div>
                    <div class="caption medium_grey lfr"
                        data-x="left"
                        data-y="236"
                        data-speed="500"
                        data-start="800"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus vestibulum libero
                    </div>
                </li>
                <?php endif ?>
                <?php if ($slider2): ?>
                <li data-transition="flyin" data-slotamount="1" data-masterspeed="300">
                    <?php 
                        if(has_post_thumbnail($slider2->ID))
                        {
                            echo get_the_post_thumbnail( $slider2->ID, 'full' );
                        }
                    ?>
                    <!-- <img src="<?php bloginfo('template_directory'); ?>/images/resource/slide-2.jpg" alt="slide"> -->
                    <div class="caption large_grey lfl"
                        data-x="right"
                        data-y="190"
                        data-speed="800"
                        data-start="800"
                        data-easing="easeOutExpo"><?php echo $slider2->post_title; ?>
                    </div>
                    <div class="caption small_white sfb"
                        data-x="right"
                        data-y="264"
                        data-speed="800"
                        data-start="1200"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus vestibulum
                    </div>
                </li>
                <?php endif ?>
                <?php if ($slider3): ?>
                <li data-transition="papercut" data-slotamount="1" data-masterspeed="300">
                    <?php 
                        if(has_post_thumbnail($slider3->ID))
                        {
                            echo get_the_post_thumbnail( $slider3->ID, 'full' );
                        }
                    ?>
                    <!-- <img src="<?php bloginfo('template_directory'); ?>/images/resource/slide-3.jpg" alt="slide"> -->
                    <div class="caption large_grey lfl"
                        data-x="center"
                        data-y="bottom"
                        data-voffset="-115"
                        data-hoffset="100"
                        data-speed="800"
                        data-start="800"
                        data-easing="easeOutExpo"><?php echo $slider3->post_title; ?>
                    </div>
                    <div class="caption small_white sfb"
                        data-x="center"
                        data-y="bottom"
                        data-voffset="-55"
                        data-hoffset="100"
                        data-speed="800"
                        data-start="1200"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus vestibulum
                    </div>
                </li>
                <?php endif ?>
            </ul>
      
            <div class="tp-bannertimer"></div>
        </div>
    </div><!-- slider ends -->
<?php }
?>



<!-- <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
                <li data-transition="papercut" data-slotamount="15" data-masterspeed="2300" data-delay="9400">
                    <img src="<?php bloginfo('template_directory'); ?>/images/resource/slide-1.jpg" alt="slide">
                    <div class="caption large_yallow lfl stl"
                        data-x="left"
                        data-y="170"
                        data-speed="500"
                        data-start="500"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus
                    </div>
                    <div class="caption medium_grey lfr"
                        data-x="left"
                        data-y="236"
                        data-speed="500"
                        data-start="800"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus vestibulum libero
                    </div>
                    <div class="caption medium_grey lfb"
                        data-x="left"
                        data-y="290"
                        data-speed="500"
                        data-start="800"
                        data-easing="easeOutExpo">nibh. eufermentum etellus vestibulum.
                    </div>
                </li>
                
                <li data-transition="flyin" data-slotamount="1" data-masterspeed="300">
                    <img src="<?php bloginfo('template_directory'); ?>/images/resource/slide-2.jpg" alt="slide">
                    <div class="caption large_grey lfl"
                        data-x="right"
                        data-y="190"
                        data-speed="800"
                        data-start="800"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus
                    </div>
                    <div class="caption small_white sfb"
                        data-x="right"
                        data-y="264"
                        data-speed="800"
                        data-start="1200"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus vestibulum
                    </div>
                </li>
                
                <li data-transition="papercut" data-slotamount="1" data-masterspeed="300">
                    <img src="<?php bloginfo('template_directory'); ?>/images/resource/slide-3.jpg" alt="slide">
                    <div class="caption large_grey lfl"
                        data-x="center"
                        data-y="bottom"
                        data-voffset="-115"
                        data-hoffset="100"
                        data-speed="800"
                        data-start="800"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus
                    </div>
                    <div class="caption small_white sfb"
                        data-x="center"
                        data-y="bottom"
                        data-voffset="-55"
                        data-hoffset="100"
                        data-speed="800"
                        data-start="1200"
                        data-easing="easeOutExpo">Sollicitudin a lacinia eufermentum etellus vestibulum
                    </div>
                </li>
            </ul>
      
            <div class="tp-bannertimer"></div>
        </div>
    </div><!-- slider ends -->