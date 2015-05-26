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
                 'high'); // $priority

    add_meta_box(
                 'ngoCharity_gallery_url', // $id
                 'Gallery Link', // $title
                 'ngoCharity_gallery_url_callback', // $callback
                 'post', // $page
                 'side', // $context
                 'high'); // $priority
}

add_action( 'admin_print_styles-post-new.php', 'event_date_picker_scripts', 11 );
add_action( 'admin_print_styles-post.php', 'event_date_picker_scripts', 11 );

function event_date_picker_scripts() {
        wp_enqueue_style( 'jquery-ui-css',get_template_directory_uri().'/lib/jquery-ui-1.11.4/jquery-ui.css');

        wp_enqueue_script( 'external-jquery', get_template_directory_uri().'/lib/jquery-ui-1.11.4/external/jquery/jquery.js', array( 'jquery' ) );
        wp_enqueue_script( 'jquery-ui', get_template_directory_uri().'/lib/jquery-ui-1.11.4/jquery-ui.js');
}

function ngoCharity_event_details_callback()
{ 
    global $post , $ngoCharity_event_category;
    wp_nonce_field( basename( __FILE__ ), 'ngoCharity_event_details_nonce' ); 
    
    $ngoCharity_event_date = get_post_meta( $post->ID, 'ngoCharity_event_date', true );
    $ngoCharity_event_time = get_post_meta( $post->ID, 'ngoCharity_event_time', true );
    $ngoCharity_event_time_md = get_post_meta( $post->ID, 'ngoCharity_event_time_md', true );
    $ngoCharity_event_venue = get_post_meta( $post->ID, 'ngoCharity_event_venue', true );
    ?>

    <table>
        <tr>
            <td colspan="2"><em class="f13">Improve your information by filling all the fields</em></td>
        </tr>
        <tr>
            <td>Date:</td> 
            <td><input type="text" id="datepicker" name="ngoCharity_event_date" placeholder="Click and select the date" value="<?php echo $ngoCharity_event_date; ?>"></td>
        </tr>
        <tr>
            <td>Time:</td>
            <td>
                <select name="ngoCharity_event_time">
                    <option value="">Select</option>
                    <?php for($hr=1; $hr <= 12; $hr++){?>
                    <option value="<?php echo $hr ?>"  <?php selected( $ngoCharity_event_time, $hr); ?>><?php echo $hr ?></option>
                    <?php } ?>
                </select>
                <select name="ngoCharity_event_time_md">
                    <option value="">Select</option>
                    <option value="AM" <?php selected( $ngoCharity_event_time_md, 'AM'); ?>>AM</option>
                    <option value="PM" <?php selected( $ngoCharity_event_time_md, 'PM'); ?>>PM</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Venue:</td> 
            <td><input type="text" name="ngoCharity_event_venue" placeholder="Venue for event" value="<?php echo $ngoCharity_event_venue; ?>"></td>
        </tr>
    </table>


    <script type="text/javascript">
        (function($){
            $( "#datepicker" ).datepicker({ dateFormat: 'dd - mm - yy' });

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
        $old_date = get_post_meta( $post_id, 'ngoCharity_event_date', true);
        $old_time = get_post_meta( $post_id, 'ngoCharity_event_time', true);
        $old_time_md = get_post_meta( $post_id, 'ngoCharity_event_time_md', true);
        $old_venue = get_post_meta( $post_id, 'ngoCharity_event_venue', true);

        $new_date = sanitize_text_field($_POST['ngoCharity_event_date']);
        $new_time = sanitize_text_field($_POST['ngoCharity_event_time']);
        $new_time_md = sanitize_text_field($_POST['ngoCharity_event_time_md']);
        $new_venue = sanitize_text_field($_POST['ngoCharity_event_venue']);

        
        if ( $new_date && '' == $new_date ){
            add_post_meta( $post_id, 'ngoCharity_event_date', $new_date );
        }elseif ($new_date && $new_date != $old_date) {  
            update_post_meta($post_id, 'ngoCharity_event_date', $new_date);  
        } elseif ('' == $new_date && $old_date) {  
            delete_post_meta($post_id,'ngoCharity_event_date', $old_date);  
        } 

        if ( $new_time && '' == $new_time ){
            add_post_meta( $post_id, 'ngoCharity_event_time', $new_time );
        }elseif ($new_time && $new_time != $old_time) {  
            update_post_meta($post_id, 'ngoCharity_event_time', $new_time);  
        } elseif ('' == $new_time && $old_time) {  
            delete_post_meta($post_id,'ngoCharity_event_time', $old_time);  
        } 

        if ( $new_time_md && '' == $new_time_md ){
            add_post_meta( $post_id, 'ngoCharity_event_time_md', $new_time_md );
        }elseif ($new_time_md && $new_time_md != $old_time_md) {  
            update_post_meta($post_id, 'ngoCharity_event_time_md', $new_time_md);  
        } elseif ('' == $new_time_md && $old_time_md) {  
            delete_post_meta($post_id,'ngoCharity_event_time_md', $old_time_md);  
        } 

        if ( $new_venue && '' == $new_venue ){
            add_post_meta( $post_id, 'ngoCharity_event_venue', $new_venue );
        }elseif ($new_venue && $new_venue != $old_venue) {  
            update_post_meta($post_id, 'ngoCharity_event_venue', $new_venue);  
        } elseif ('' == $new_venue && $old_venue) {  
            delete_post_meta($post_id,'ngoCharity_event_venue', $old_venue);  
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
