<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package NgoCharity
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<section class="comment-area">
    <?php if ( have_comments() ) : ?>
        <div class="heading">
            <?php printf('<h2>Comments <strong>(%s)</strong></h2>', get_comments_number()); ?>
        </div>
        <div class="user-comments">
            <ul>
            <?php
                wp_list_comments( array(
                    'style'      => 'ul',
                    'callback'   => 'ngoCharity_user_comment_box'
                ) );
            ?>
            </ul>
        </div><!-- .comment-list -->
    <?php
        //have comments() end
        // If comments are closed and there are comments, let's leave a little note, shall we?
        elseif ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <div class="heading">
            <?php echo '<h2>Comments <strong><i>(closed)</i></strong></h2>'; ?>
        </div>

    <?php else: // no_comments() ?>
        <div class="heading">
            <?php echo '<h2><i>No Comments</i></h2>'; ?>
        </div>
    <?php endif; // no_comments() ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <div class="heading">
            <?php echo '<h2>Comments <strong><i>(closed)</i></strong></h2>'; ?>
        </div>
    <?php endif; ?>
</section>

<section class="comment-area">
<?php 
    comment_form();
?>
</section>
