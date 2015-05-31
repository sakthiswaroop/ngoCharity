<?php 

/** 
* file for contact us page form
*@package NgoCharity
*/

$ngoCharity_response = '';

function ngoCharity_contact_form_html()
{
	global $ngoCharity_response;
	echo $ngoCharity_response;

	$name = (isset($_POST["ngoCharity_contact_name"]))? $_POST["ngoCharity_contact_name"] : "";
	$email = (isset($_POST["ngoCharity_contact_email"]))? $_POST["ngoCharity_contact_email"] : "";
	$message = (isset($_POST["ngoCharity_contact_message"]))? $_POST["ngoCharity_contact_message"] : "";

	echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="POST">';
	echo '<ul class="unstyled">';

	echo '<li class="row-fluid"><div class="span12">';
	echo '<label>Name <span class="require">(Required)</span></label><input class="input-block-level" type="text" name="ngoCharity_contact_name" value="'. $name .'" placeholder="Full Name" required />';
	echo '</div></li>';

	echo '<li class="row-fluid"><div class="span12">';
	echo '<label>Email <span class="require">(Required)</span></label><input class="input-block-level" type="email" name="ngoCharity_contact_email" value="'. $email .'" placeholder="" required />';
	echo '</div></li>';

	echo '<li class="row-fluid"><div class="span12">';
	echo '<label>Message <span class="require">(Required)</span></label><textarea class="input-block-level" name="ngoCharity_contact_message" placeholder="" required>'.$message.'</textarea>';
	echo '</div></li>';

	echo '<li class="row-fluid"><div class="span12">';
	echo '<label>Verify <strong><em>(What is 2+5?)</em></strong> <span class="require">(Required)</span></label><input class="input-block-level" type="text" name="ngoCharity_contact_verify" placeholder="What is 2+5?" required />';
	echo '</div></li>';

	echo '<li class="row-fluid"><div class="span12">';
	echo '<input class="btn" type="submit" name="ngoCharity_contact_submit" value="Submit" />';
	echo '</div></li>';
	
	echo '</ul></form>';
}

function ngoCharity_sendMail() {
	global $ngoCharity_response;
    // if the submit button is clicked, send the email
    if ( isset( $_POST['ngoCharity_contact_submit'] ) ) {
 
        // sanitize form values
        $name    = sanitize_text_field( $_POST["ngoCharity_contact_name"] );
        $email   = sanitize_email( $_POST["ngoCharity_contact_email"] );
        $message = esc_textarea( $_POST["ngoCharity_contact_message"] );
        $verify = sanitize_text_field( $_POST["ngoCharity_contact_verify"] );

 		if(!(validateFields($name, $email, $message, $verify))){
 			return;
 		}
        // get the blog administrator's email address
        $to = "san.loggingin@gmail.com";

        $headers = array('Content-Type: text/html; charset=UTF-8');
        $headers[] = "From: $name <$email>" . "\r\n";

        $message = $message . '<p><strong>You have been contacted from <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a></strong></p>';
 
        // If email has been process for sending, display a success message
        if ( wp_mail( $to, 'Contacting', $message, $headers ) ) {
            $ngoCharity_response .= '<p>Thanks for contacting us. We will get back to you as soon as possible.</p>';
        } else {
            $ngoCharity_response .= '<p>An unexpected error occured. Please submit and try again.</p>';
        }
    }
}

function validateFields($name, $email, $message, $verify)
{
	global $ngoCharity_response;
	$error = false;
	if($name == null || $email == null || $message == null || $verify == null )
	{
		$ngoCharity_response .= '<p>All fields are required. Recheck and submit.</p>';
		$error = true;
	}

	if($verify != 7)
	{
		$ngoCharity_response .= '<p>Verification is incorrect</p>';
		$error = true;
	}

	if($error)
		return false;
	else
		return true;
}


function ngoCharity_contactform_shortcode() {
    ob_start();
    ngoCharity_sendMail();
    ngoCharity_contact_form_html();
 
    return ob_get_clean();
}
add_shortcode( 'ngoCharity_contact_form', 'ngoCharity_contactform_shortcode' );