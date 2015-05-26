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

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above" class="comment-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'accesspresslite' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'accesspresslite' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'accesspresslite' ) ); ?></div>
        </nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation ?>

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

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="comment-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'accesspresslite' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'accesspresslite' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'accesspresslite' ) ); ?></div>
        </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>

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

<?php comment_form(); ?>


















<?php /* ?>		
		<section class="comment-area">
            <div class="heading">
                <h2>Comments <strong>(07)</strong></h2>
            </div>
            <!-- heading ends -->
            <div class="user-comments">
                <ul>
                    <li>
                        <div class="comment-box">
                          <figure class="snap">
                            <img src="images/resource/thumbs/snap-1.jpg" alt="author">
                          </figure> 
                          <div class="comment-tp">
                            <strong>Jeff Brown</strong>
                            <p>Wednesday, 14 Nov 2012 </p>
                          </div>
                          <p>I'm liking the relaunched site, Anders. Adding a blog was a good idea too! I look forward to seeing how your site evo lves, oh, and using it as a resource in my daily work.</p>
                          <a href="#" class="reply-link">Reply</a>
                        </div>
                        <ul>
                            <li>
                              <div class="comment-box">
                                <figure class="snap">
                                  <img src="images/resource/thumbs/snap-2.jpg" alt="author">
                                </figure> 
                                <div class="comment-tp">
                                  <strong>Penny Disilva</strong>
                                  <p>Wednesday, 14 Nov 2012 </p>
                                </div>
                                <p>I'm liking the relaunched site, Anders. Adding a blog was a good idea too! I look forward to seeing how your site evo lves, oh, and using it as a resource in my daiI'm liking the relaunched site, Anders. Adding a blog was a good idea too!  I look forward to seeing how your site evolves, oh, and using it as a resource in my daily work.ly work.</p>
                                <a href="#" class="reply-link">Reply</a>
                              </div>
                              <ul>
                                  <li>
                                    <div class="comment-box">
                                      <figure class="snap">
                                        <img src="images/resource/thumbs/snap-3.jpg" alt="author">
                                      </figure> 
                                      <div class="comment-tp">
                                        <strong>Rick Wilson</strong>
                                        <p>Wednesday, 14 Nov 2012 </p>
                                      </div>
                                      <p>I'm liking the relaunched site, Anders. Adding a blog was a good idea too!</p>
                                      <a href="#" class="reply-link">Reply</a>
                                    </div>
  
                                    <ul>
                                        <li>
                                          <div class="comment-box">
                                            <figure class="snap">
                                              <img src="images/resource/thumbs/snap-4.jpg" alt="author">
                                            </figure> 
                                            <div class="comment-tp">
                                              <strong>Rick Wilson</strong>
                                              <p>Wednesday, 14 Nov 2012 </p>
                                            </div>
                                            <p>I'm liking the relaunched site, Anders. Adding a blog was a good idea too! I look forward to seeing how your site evolves, oh, and using it as a resource in my daiI'm</p>
                                            <a href="#" class="reply-link">Reply</a>
                                          </div>
                                        </li>
                                    </ul>
                                  </li>
                              </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                      <div class="comment-box">
                        <figure class="snap">
                          <img src="images/resource/thumbs/snap-5.jpg" alt="author">
                        </figure> 
                        <div class="comment-tp">
                          <strong>Rick Wilson</strong>
                          <p>Wednesday, 14 Nov 2012 </p>
                        </div>
                        <p>I'm liking the relaunched site, Anders. Adding a blog was a good idea too! I look forward to seeing how your site evo lves, oh, and using it as a resource in my daily work.</p>
                        <a href="#" class="reply-link">Reply</a>
                      </div>
                    </li>
                </ul>
            </div>
        </section><!-- user comments end -->
        <section class="comment-area">
          <h2 class="text-pink">Leave <strong>Reply</strong></h2>
          <form method="get" action="http://www.extracoding.com/demo/html/help/index.html">
            <ul class="unstyled">
              <li class="row-fluid">
                <div class="span6">
                  <label>Name <span class="require">(Required)</span></label>
                  <input type="text" class="input-block-level" placeholder="">
                </div>
                <div class="span6">
                  <label>Email <span class="require">(Required)</span></label>
                  <input type="text" class="input-block-level" placeholder="">
                </div>
              </li>
              <li class="row-fluid">
                <div class="span12">
                  <label>Subject <span class="require">(Required)</span></label>
                  <input type="text" class="input-block-level" placeholder="">
                </div>
              </li>
              <li class="row-fluid">
                <div class="span12">
                  <label>Message <span class="require">(Required)</span></label>
                  <textarea class="input-block-level" placeholder=""></textarea>
                </div>
              </li>
              <li class="row-fluid">
                <div class="span12">
                  <input type="submit" class="btn" value="Subscribe">
                  <p class="help-inline left-marg">*Your Email will never published.</p>
                </div>
              </li>
            </ul>
          </form>
        </section><!-- comment form ends -->
<?php */ ?>