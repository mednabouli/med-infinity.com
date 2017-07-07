<?php
// Information to be modified
error_reporting(0);
$to_email = "info@med-infinity.com"; // email address to which the form data will be sent
$subject = "Contact Request Med Infinity"; // subject of the email that is sent
$thanks_page = "contacts.html"; // path to the thank you page following successful form submission
$contact_page = "contacts.html"; // path to the HTML contact page where the form appears


$contact_name = strip_tags($_POST["contact_name"]);
$contact_email = strip_tags($_POST["contact_email"]);
$contact_number = strip_tags($_POST["contact_number"]);
$contact_message = strip_tags($_POST["contact_message"]);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: <' .$contact_email. '>' . "\r\n";
$headers .= "Reply-To: ".$contact_email."\r\n";

$email_body = 
	"<strong>From: </strong>" . $contact_name . "<br />
	<strong>Email: </strong>" . $contact_email . "<br />	
	<strong>Phone: </strong>" . $contact_number . "<br />	
	<strong>Message: </strong>" . $contact_message;
	

// Assuming there's no error, send the email and redirect to Thank You page
	
if( mail($to_email, $subject, $email_body, $headers) ) {	
	echo '<i class="fa fa-check"></i> Merci ' .$_POST["contact_name"]. '. Votre email a été envoyé avec succès!';
	
} else {	
	echo '<i class="fa fa-times"></i> Désoler ' .$contact_name. '. Votre e-mail n\'a pas été envoyé . Soumettez de nouveau formulaire à nouveau S\'il vous plaît..';
}
die();