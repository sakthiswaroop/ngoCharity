<?php
/**
 * @package NgoCharity
 */

global $ngoCharity_options;
$ngoCharity_settings = get_option( 'ngoCharity_options', $ngoCharity_options );

$ngoCharity_event_category = $ngoCharity_settings['event_cat'];
$ngoCharity_gallery_category = $ngoCharity_settings['gallery_cat'];

add_action('add_meta_boxes', 'ngoCharity_add_custom_box');

function ngoCharity_add_custom_box()
{    
    add_meta_box(
        'ngoCharity_event_details', // $id
        'Event Details', // $title
        'ngoCharity_event_details_callback', // $callback
        'post', // $page
        'side', // $context
        'high' // $priority
    ); 
    add_meta_box(
        'ngoCharity_gallery_url', // $id
        'Gallery Link', // $title
        'ngoCharity_gallery_url_callback', // $callback
        'post', // $page
        'side', // $context
        'high' // $priority
    );
}

function event_custombox_scripts($hook) {
    if ( !('post-new.php' == $hook || 'post.php' == $hook) ) {
        return;
    }

    wp_enqueue_style( 'datetimepicker css',get_template_directory_uri().'/lib/datetimepicker/jquery.datetimepicker.css');
    wp_enqueue_script( 'datetimepicker js', get_template_directory_uri().'/lib/datetimepicker/jquery.datetimepicker.js', array( 'jquery' ) );
}
add_action( 'admin_enqueue_scripts', 'event_custombox_scripts' );


function ngoCharity_event_details_callback()
{ 
    global $post , $ngoCharity_event_category;
    wp_nonce_field( basename( __FILE__ ), 'ngoCharity_event_details_nonce' ); 
    
    $ngoCharity_event_datetime = get_post_meta( $post->ID, 'ngoCharity_event_datetime', true );
    $ngoCharity_event_venue = get_post_meta( $post->ID, 'ngoCharity_event_venue', true );
    $ngoCharity_event_featured = get_post_meta( $post->ID, 'ngoCharity_event_featured', true );
    ?>

    <table>
        <tr>
            <td colspan="2"><em class="f13">Improve your information by filling all the fields</em></td>
        </tr>
        <tr>
            <td>Date:</td> 
            <td><input type="text" id="datetimepicker" name="ngoCharity_event_datetime" placeholder="Click and select the date and time" value="<?php echo $ngoCharity_event_datetime; ?>"></td>
        </tr>
        <tr>
            <td>Venue:</td> 
            <td><input type="text" name="ngoCharity_event_venue" placeholder="Venue for event" value="<?php echo $ngoCharity_event_venue; ?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="checkbox" value="1" name="ngoCharity_event_featured" <?php echo ($ngoCharity_event_featured)? 'checked="checked"' : ''; ?>>
                <strong><i>Set as Featured Event</i></strong>
            </td>
        </tr>
    </table>


    <script type="text/javascript">
        (function($){
            $('#datetimepicker').datetimepicker({
                format:'d - m - Y | h:i a',
                timepickerScrollbar:true
            });

            $(window).bind('load', function(){ 
                if($('body #in-category-<?php echo $ngoCharity_event_category; ?>').is(':checked')){
                    $('#ngoCharity_event_details').fadeIn(); 
                }else{
                    $('#ngoCharity_event_details').fadeOut(); 
                }

            
                $(document).on('change','#categorychecklist input', function(){
                    if($('#in-category-<?php echo $ngoCharity_event_category; ?>').is(':checked')){
                       $('#ngoCharity_event_details').fadeIn(); 
                    }else{
                       $('#ngoCharity_event_details').fadeOut(); 
                    }
                }).change();
            });
        })(jQuery);

    </script>
    <?php
} 

function ngoCharity_save_event_details( $post_id ) { 
    global $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'ngoCharity_event_details_nonce' ] ) || !wp_verify_nonce( $_POST[ 'ngoCharity_event_details_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
    
     if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  

        //Execute this saving function
        $old_datetime = get_post_meta( $post_id, 'ngoCharity_event_datetime', true);
        $old_venue = get_post_meta( $post_id, 'ngoCharity_event_venue', true);
        $old_featured = get_post_meta( $post_id, 'ngoCharity_event_featured', true);

        $new_datetime = sanitize_text_field($_POST['ngoCharity_event_datetime']);
        $new_venue = sanitize_text_field($_POST['ngoCharity_event_venue']);
        $new_featured = sanitize_text_field($_POST['ngoCharity_event_featured']);

        
        if ( $new_datetime && '' == $new_datetime ){
            add_post_meta( $post_id, 'ngoCharity_event_datetime', $new_datetime );
        }elseif ($new_datetime && $new_datetime != $old_datetime) {  
            update_post_meta($post_id, 'ngoCharity_event_datetime', $new_datetime);  
        } elseif ('' == $new_datetime && $old_datetime) {  
            delete_post_meta($post_id,'ngoCharity_event_datetime', $old_date);  
        }

        if ( $new_venue && '' == $new_venue ){
            add_post_meta( $post_id, 'ngoCharity_event_venue', $new_venue );
        }elseif ($new_venue && $new_venue != $old_venue) {  
            update_post_meta($post_id, 'ngoCharity_event_venue', $new_venue);  
        } elseif ('' == $new_venue && $old_venue) {  
            delete_post_meta($post_id,'ngoCharity_event_venue', $old_venue);  
        } 

        if ( $new_featured && '' == $new_featured ){
            add_post_meta( $post_id, 'ngoCharity_event_featured', $new_featured );
        }elseif ($new_featured && $new_featured != $old_featured) {  
            update_post_meta($post_id, 'ngoCharity_event_featured', $new_featured);  
        } elseif ('' == $new_featured && $old_featured) {  
            delete_post_meta($post_id,'ngoCharity_event_featured', $old_featured);  
        }
}
add_action('save_post', 'ngoCharity_save_event_details'); 


function ngoCharity_gallery_url_callback()
{ 
    global $post , $ngoCharity_gallery_category;
    wp_nonce_field( basename( __FILE__ ), 'ngoCharity_gallery_url_nonce' ); 

    $ngoCharity_gallery_url = get_post_meta( $post->ID, 'ngoCharity_gallery_url', true );

    ?>

    <table>
        <tr>
            <td colspan="2"><em class="f13">Copy and paste the album link from Facebook, Flickr or what you prefer!</em></td>
        </tr>

        <tr>
            <td>   
                <input type="text" name="ngoCharity_gallery_url" placeholder="Paste link here" value="<?php echo $ngoCharity_gallery_url; ?>">
            </td>
        </tr>
    </table>

    <script type="text/javascript">
        (function($){
        $(window).bind('load', function(){ 
            if($('body #in-category-<?php echo $ngoCharity_gallery_category; ?>').is(':checked')){
                $('#ngoCharity_gallery_url').fadeIn(); 
            }else{
                $('#ngoCharity_gallery_url').fadeOut(); 
            }

        
            $(document).on('change','#categorychecklist input', function(){
                if($('#in-category-<?php echo $ngoCharity_gallery_category; ?>').is(':checked')){
                   $('#ngoCharity_gallery_url').fadeIn(); 
                }else{
                   $('#ngoCharity_gallery_url').fadeOut(); 
                }
            }).change();
        });
        })(jQuery);

    </script>

    <?php 
} 

function ngoCharity_save_gallery_url( $post_id ) { 
    global $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'ngoCharity_gallery_url_nonce' ] ) || !wp_verify_nonce( $_POST[ 'ngoCharity_gallery_url_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
    
     if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  

        //Execute this saving function
        $old_url = get_post_meta( $post_id, 'ngoCharity_gallery_url', true);
        $new_url = sanitize_text_field($_POST['ngoCharity_gallery_url']);
        
        if ( $new_url && '' == $new_url ){
            add_post_meta( $post_id, 'ngoCharity_gallery_url', $new_url );
        }elseif ($new_url && $new_url != $old_url) {  
            update_post_meta($post_id, 'ngoCharity_gallery_url', $new_url);  
        } elseif ('' == $new_url && $old_url) {  
            delete_post_meta($post_id,'ngoCharity_gallery_url', $old_url);  
        } 
}
add_action('save_post', 'ngoCharity_save_gallery_url'); 
