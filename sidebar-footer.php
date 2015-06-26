<?php if ( is_active_sidebar( 'widget_footer' ) ) : ?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <?php dynamic_sidebar( 'widget_footer' ); ?>
        </div>
    </div>
</footer>
<?php endif; ?>