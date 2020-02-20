<?php
function filterName($field)
{
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);

    if (filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>
        array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        return $field;
    } else {
        return false;
    }
}
function filterEmail($field)
{
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);

    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return $field;
    } else {
        return false ;
    }
}

function filterString($field)
{
    $field = filter_Var(trim($field), FILTER_SANITIZE_STRING);
    if (!empty($field)) {
        return $field;
    } else {
        return false ;
    }
}

$nameErr = $emailErr = $messageErr = "";
$name = $email = $subject  = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Please enter your name.";
    } else {
        $name = filterName($_POST["name"]);
        if ($name == false) {
            $nameErr = "Please enter a valid name.";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Please enter your email address.";
    } else {
        $email = filterEmail($_POST["email"]);
        if ($email == false) {
            $emailErr = "Please enter a valid email address.";
        }
    }

    if (empty($_POST["subject"])) {
        $subject = "";
    } else {
        $subject = filterString($_POST["subject"]);
    }

    if (empty($_POST["message"])) {
        $messageErr = "Please enter your message.";
    } else {
        $message = filterString($_POST["message"]);
        if ($message == false) {
            $messageErr = "Please enter a valid message.";
        }
    }

    
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $mailTo = 'markosberg1234@outlook.com';


        $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        if (mail($mailTo, $subject, $message, $headers)) {
            echo '<p class="success"> Your message has been sent successfully!</p>';
        } else {
            echo '<p class="error"> Unable to send email. Please try again!</p>';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
</head>
<body>
<main>
    <section class="contact-section" id="contact">
        <div class="contact-container">


            <form class="methodForm" action="contact.php" method="post">
                <label for="name-box"></label><input type="text" autocomplete="name" name="name" placeholder="Name" id="name-box" required   />
                <label for="email-box"></label><input type="email" autocomplete="email" name="mail" placeholder="Email" id="email-box" required  />


                <label for="subject-box"></label><input type="text" maxlength="41" name="subject" placeholder="Subject" id="subject-box"  />


                <label for="message-box"></label>
                <input type="text" name="message" placeholder="Message" id="message-box" required/>



                <button type="submit" name="Submit" id="submit-btn" >Contact Me</button>
            </form>
        </div>
    </section>
</main>
</body>







