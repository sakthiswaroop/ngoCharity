<?php 

/** 
* file for contact us page form
*@package NgoCharity
*/

global $ngoCharity_response, $contact_name, $contact_email, $contact_message, $contact_subject;

function ngoCharity_contact_form_html()
{
	global $ngoCharity_response, $contact_name, $contact_email, $contact_message, $contact_subject;
	echo $ngoCharity_response;
?>
	<section class="comment-area">
		<h2 class="text-pink">Leave <strong>Reply</strong></h2>
		<form method="POST" action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>">
			<ul class="unstyled">
				<li class="row-fluid">
					<div class="span12">
						<label>Name <span class="require">(Required)</span></label>
						<input type="text" class="input-block-level" name="ngoCharity_contact_name" value="<?php echo $contact_name; ?>" placeholder="Type your name here">
					</div>
				</li>
				<li class="row-fluid">
					<div class="span12">
						<label>Email <span class="require">(Required)</span></label>
						<input type="text" class="input-block-level" name="ngoCharity_contact_email" value="<?php echo $contact_email; ?>" placeholder="Type your valid email address">
					</div>
				</li>
				<li class="row-fluid">
					<div class="span12">
						<label>Subject <span class="require">(Required)</span></label>
						<input type="text" class="input-block-level" name="ngoCharity_contact_subject" value="<?php echo $contact_subject; ?>" placeholder="Purpose for contacting">
					</div>
				</li>
				<li class="row-fluid">
					<div class="span12">
						<label>Message <span class="require">(Required)</span></label>
						<textarea class="input-block-level" name="ngoCharity_contact_message" placeholder="Write your message here!"><?php echo $contact_message; ?></textarea>
					</div>
				</li>
				<li class="row-fluid">
					<div class="span12">
						<label>Prove you are human <strong><em>(What is 2+5?)</em></strong> <span class="require">(Required)</span></label>
						<input type="text" class="input-block-level" name="ngoCharity_contact_verify" placeholder="What is 2+5?">
					</div>
				</li
				<li class="row-fluid">
					<div class="span12">
						<input type="submit" class="btn" name="ngoCharity_contact_submit" value="Submit">
					</div>
				</li>
			</ul>
		</form>
	</section><!-- comment form ends -->
<?php
}

function ngoCharity_sendMail() {    
	global $ngoCharity_options, $ngoCharity_response, $contact_name, $contact_email, $contact_message, $contact_subject;
    $ngoCharity_settings = get_option('ngoCharity_options', $ngoCharity_options);

    // if the submit button is clicked, send the email
    if ( isset( $_POST['ngoCharity_contact_submit'] ) ) {
 
        // sanitize form values
        $contact_name    = sanitize_text_field( $_POST["ngoCharity_contact_name"] );
        $contact_email   = sanitize_email( $_POST["ngoCharity_contact_email"] );
        $contact_subject = sanitize_text_field( $_POST["ngoCharity_contact_subject"] );
        $contact_message = esc_textarea( $_POST["ngoCharity_contact_message"] );
        $verify = sanitize_text_field( $_POST["ngoCharity_contact_verify"] );

 		if(!(validateFields($contact_name, $contact_email, $contact_subject, $contact_message, $verify))){
 			return;
 		}

 		//allowing html content

        // get the blog administrator's email address
        $to = $ngoCharity_settings['contactEmail'];

        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = "From: $contact_name <$contact_email>" . "\r\n";
 
        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $contact_subject, $contact_message, $headers ) ) {
            $ngoCharity_response .= '<p>Thanks for contacting us. We will get back to you as soon as possible.</p>';
        } else {
            $ngoCharity_response .= '<p>An unexpected error occured. Please submit and try again.</p>';
        }
    }else{
    	$contact_name    = "";
        $contact_email   = "";
        $contact_subject = "";
        $contact_message = "";
    }
}

function validateFields($name, $email, $subject, $message, $verify)
{
	global $ngoCharity_response;
	$error = false;
	if($name == null || $email == null || $subject == null || $message == null || $verify == null )
	{
		$ngoCharity_response .= '<p>All fields are required. Please, recheck and submit.</p>';
		$error = true;
	}

	if($verify != 7)
	{
		$ngoCharity_response .= '<p>Human verification is incorrect.</p>';
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