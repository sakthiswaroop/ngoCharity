<div class="bottom">
    <div class="container">
      <div class="bottom-left">
        <p>&copy;2013 H.E.L.P. All rights reserved. Theme Designed By <a href="#">Themebazaar</a></p>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#">Environment</a></li>
          <li><a href="contact.html">Contact Us</a></li>
          <li><a href="#">Site Map</a></li>
        </ul>
      </div>
      <div class="social-links">
        <ul>
          <li><a href="#" class="icon-yahoo tooltip" title="yahoo"></a></li>
          <li><a href="#" class="icon-facebook tooltip" title="facebook"></a></li>
          <li><a href="#" class="icon-rss tooltip" title="rss"></a></li>
          <li><a href="#" class="icon-flickr tooltip" title="flickr"></a></li>
          <li><a href="#" class="icon-msn tooltip" title="msn"></a></li>
          <li><a href="#" class="icon-stumbleupon tooltip" title="stumbleupon"></a></li>
        </ul>
      </div>
    </div>
  </div><!-- bottom ends -->
</div><!-- wrap ends -->

<div id="dialog-search">
  <div class="heading">Search</div>
  <div class="dialog-block">
      <form method="get" action="http://www.extracoding.com/demo/html/help/index.html" class="user-search-form">
        <input type="text" class="input-block-level" placeholder="Enter Any Keyword">
        <input type="submit" class="btn" value="Search">
      </form>
  </div>
  <!-- dialog-block ends --> 
</div><!-- dialog ends -->
<div id="dialog-login">
  <div class="heading">User Login</div>
  <div class="dialog-block">
      <form method="get" action="http://www.extracoding.com/demo/html/help/index.html" class="user-login-form">
        <input type="text" class="input-block-level" placeholder="User Login">
        <input type="password" class="input-block-level" placeholder="Password">
        <div class="controls">
          <label class="help-inline"><input type="checkbox" class="checkbox">Remeber me</label>
          <input type="submit" class="btn pull-right" value="Sign In">
        </div>
      </form>
  </div><!-- dialog-block ends --> 
  <div class="dialog-btm">
    Don't have an account? <a href="#">Create one now!</a>
  </div>
</div><!-- dialog ends -->
<div class="dialog-overlay"></div>


<?php wp_footer(); ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "../../../../connect.facebook.net/en_US/all.js#xfbml=1&appId=203335796018";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- jQuery Revolution Slider  -->
<!-- <script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script> -->
<script type="text/javascript">
  var tpj=jQuery;
  tpj.noConflict();
  tpj(document).ready(function() {

  if (tpj.fn.cssOriginal!=undefined)
    tpj.fn.css = tpj.fn.cssOriginal;

    tpj('.fullwidthbanner').revolution(
      {
        delay:9000,
        startwidth:1170,
        startheight:550,

        onHoverStop:"on",           // Stop Banner Timet at Hover on Slide on/off

        thumbWidth:100,             // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
        thumbHeight:50,
        thumbAmount:3,

        hideThumbs:0,
        navigationType:"none",        // bullet, thumb, none
        navigationArrows:"solo",        // nexttobullets, solo (old name verticalcentered), none

        navigationStyle:"round",        // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


        navigationHAlign:"center",        // Vertical Align top,center,bottom
        navigationVAlign:"top",         // Horizontal Align left,center,right
        navigationHOffset:0,
        navigationVOffset:20,

        soloArrowLeftHalign:"left",
        soloArrowLeftValign:"center",
        soloArrowLeftHOffset:20,
        soloArrowLeftVOffset:0,

        soloArrowRightHalign:"right",
        soloArrowRightValign:"center",
        soloArrowRightHOffset:20,
        soloArrowRightVOffset:0,

        touchenabled:"on",            // Enable Swipe Function : on/off



        stopAtSlide:-1,             // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
        stopAfterLoops:-1,            // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

        hideCaptionAtLimit:0,         // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
        hideAllCaptionAtLilmit:0,       // Hide all The Captions if Width of Browser is less then this value
        hideSliderAtLimit:0,          // Hide the whole slider, and stop also functions if Width of Browser is less than this value


        fullWidth:"on",
        shadow:0                //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

      });
});
</script>

</body>
</html>
