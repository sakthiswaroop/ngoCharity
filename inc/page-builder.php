<?php 

function ngoCharity_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => __('Themes Custom Widget', 'ngoCharity'),
        'filter' => array(
            'groups' => array('ngoCharity')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'ngoCharity_widget_tabs', 20);


function contactUs_prebuilt_layouts($layouts){
    $layouts['contact-us'] = array(
        // We'll add a title field
        'name' => __('Contacts Us', 'ngoCharity'),
        'description' => 'Contact us template',
        'widgets' => array(
			array(
			    'type' => 'visual',
			    'title' =>'', 
			    'text' => '<section class="contact-box"><h2>Get In <strong>Touch</strong></h2><p>We\'re very approachable and would love to speak to you. Feel free to call, send us an email, Tweet us or simply complete the enquiry form</p><ul class="contact-list"><li class="list-phone">+44 - 123 - 4567890</li><li class="list-email"><a href="#">Info@h-e-l-p.com</a></li><li class="list-facebook"><a href="#">www.facebook.com/h-e-l-p</a></li><li class="list-twitter"><a href="#">\#h-e-l-p</a></li></ul></section>',
			    'filter' => 0,
			    'panels_info' => array
			    (
			        'class' => 'WP_Widget_Black_Studio_TinyMCE',
			        'raw' => '', 
			        'grid' => 0,
			        'cell' => 0,
			        'id' => 0,
			        'style' => array
			        (
			            'background_display' => 'tile'
			        )
			    )
			),
			array
			(
			    'type' => 'visual',
			    'title' => '',
			    'text' => '<section class="comment-area"><h2 class="text-pink">Leave <strong>Reply</strong></h2><form action="http://www.extracoding.com/demo/html/help/index.html" method="get"><ul class="unstyled"><li class="row-fluid"><div class="span12"><label>Name <span class="require">(Required)</span></label><br /> <input class="input-block-level" type="text" placeholder="" /></div></li><li class="row-fluid"><div class="span12"><label>Email <span class="require">(Required)</span></label><br /> <input class="input-block-level" type="text" placeholder="" /></div></li><li class="row-fluid"><div class="span12"><label>Subject <span class="require">(Required)</span></label><br /> <input class="input-block-level" type="text" placeholder="" /></div></li><li class="row-fluid"><div class="span12"><label>Message <span class="require">(Required)</span></label><br /> <textarea class="input-block-level" placeholder=""></textarea></div></li><li class="row-fluid"><div class="span12"><input class="btn" type="submit" value="Submit" /></div></li></ul></form></section>',
			    'filter' => 0,
			    'panels_info' => array
			    (
			        'class' => 'WP_Widget_Black_Studio_TinyMCE',
			        'raw' => '',
			        'grid' => 0,
			        'cell' => 1,
			        'id' => 1,
			        'style' => array
			        (
			            'background_display' => 'tile'
			        )
			    )
			)
		),
        'grids' =>  array(
		    'cells' => 2,
		    'style' => array
		    (
		        'background_display' => 'tile'
		    )

		),
        'grid_cells' => array(
			array(
			    'grid' => 0,
			    'weight' => 0.44997188117131
			),
			array
			(
			    'grid' => 0,
			    'weight' => 0.55002811882869
			)
		)
    );
    return $layouts;

}
add_filter('siteorigin_panels_prebuilt_layouts','contactUs_prebuilt_layouts');