<?php
/* Set e-mail recipient */
$myemail  = "contact@laurengiannotti.com";


/* Check all form inputs using check_input function */
$yourname = check_input($_POST['first_name'], "Enter your name");
$email    = check_input($_POST['email']);
$subject  = check_input($_POST['subject'], "Write a subject");
$comments = check_input($_POST['comments'], "Write your comments");

$EmailFrom = $email;

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

You have a message from: $yourname

Comments:
$comments

";

/* Send the message using mail() function */
mail($myemail, $subject, $message, "From: <$EmailFrom>");

/* Redirect visitor to the thank you page */
header('Location: thanks.htm');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>