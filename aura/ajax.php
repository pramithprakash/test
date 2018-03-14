<?php
if (isset($_POST)) {
$email_to = "c1@34k.com";
$email_subject = "Your email from Auro.com";
function died($error) {
$diemessage="We are very sorry, but there were error(s) found with the form you submitted.
These errors appear below.
".$error."
Please go back and fix these errors.
";
die($diemessage);
}
$first_name = $_POST['first_name']; // required
$last_name = $_POST['last_name']; // required
$email_from = $_POST['email']; // required
$telephone = $_POST['telephone']; //  required
$comments = $_POST['comments']; // not required
if($first_name=="" || $last_name=="" || $email_from=="" || $telephone=="") {
died('We are sorry, but there appears to be a problem with the form you submitted.');
}
$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/';
if(!preg_match($email_exp,$email_from)) {
$error_message .= 'The Email Address you entered does not appear to be valid.
';
}
$string_exp = "/^[A-Za-z .'-]+$/";
if(!preg_match($string_exp,$first_name)) {
$error_message .= 'The First Name you entered does not appear to be valid
';
}
if(!preg_match($string_exp,$last_name)) {
$error_message .= 'The Last Name you entered does not appear to be valid
';
}
/*if(strlen($comments) < 2) {
$error_message .= 'The Comments you entered do not appear to be valid
';
}*/
if($error_message!=="") {
died($error_message);
}
else { //we didn't have an error to report so go on
$email_message = "";
function clean_string($string) {
$bad = array("content-type","bcc:","to:","cc:","href");
return str_replace($bad,"",$string);
}
$email_message .= '<html><head><body style="background-color:#eeeeee; margin:10px;">
<table width="100%" border="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" style="background-color:#fff; margin:0px;">
    <table width="572" border="0" cellspacing="0" cellpadding="0" style="font-size:12px; font-family: Arial, Helvetica, sans-serif; line-height:18px; color:#444444; ">
      <tr>
        <td align="left" valign="top" style="background-color:#ffffff; padding:20px; border-right:0 solid #d6d6d6; border-bottom:0 solid #d6d6d6;"><p style="color:#000000; font-size:16px;font-family: Arial, Helvetica, sans-serif;"><strong>You have received an Message from '.$_POST['name'].'</strong></p>
          <table width="100%" border="0" cellspacing="2" cellpadding="4" style="font-size:12px;font-family: Arial, Helvetica, sans-serif;color:#333333">
            <tr>
              <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Name</td>
              <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong>'.$first_name.' '.$last_name.'</strong></td>
              </tr>
			  <tr>
               <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Email</td>
              <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong>'.$email_from.'</strong></td>
            </tr>
            <tr>
               <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Contact Number</td>
              <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong>'.$telephone.'</strong></td>
            </tr>
			<tr>
               <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;">Message</td>
              <td align="left" valign="middle" style="border-bottom:1px solid #e2dfd9;"><strong>'.$comments.'</strong></td>
            </tr>
            </table>
          <p style="color:#333333;"> Thank you<br />
            <span style="color:#333333;"><strong>info@auro.com</strong></span><br />
          </p></td>
      </tr>
      <tr>
        <td align="left" valign="top" style=" text-align:center; color:#ffffff; background:#000000;font-size:11px; padding:15px 0px;">&copy; 2014 auro. All Rights Reserved.</td>
      </tr>
    </table></td>
  </tr>
</table>
</body></head>	</html>';
// create email headers
$headers .= 'From: '.$email_from." ".
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
'Reply-To: '.$email_from." " .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
echo ('Thank you for contacting us. We will be in touch with you very soon.');
}
}
?>