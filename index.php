<?php
// Set HTTP response code to 403 Forbidden
http_response_code(403);

// Stop further processing to trigger Azure's custom 403 error page
exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warning - Page Not Found</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #000;
            color: #FF0000;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            padding: 20px;
            border: 5px solid #FF0000;
            max-width: 600px;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .warning-icon {
            font-size: 5em;
            color: #FF0000;
            margin-bottom: 20px;
        }

        .home-link {
            color: #FF0000;
            font-weight: bold;
            text-decoration: none;
            border: 2px solid #FF0000;
            padding: 10px 20px;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .home-link:hover {
            background-color: #FF0000;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="warning-icon">&#9888;</div>
        <h1>Warning!</h1>
        <p><strong>404 - Page Not Found</strong></p>
        <p>Restricted area. Attempting to access is a federally indictable offense.</p>
        <p>If you believe this is an error, please contact support immediately.</p>
        <a href="/404" class="home-link">Return to Home</a>
    </div>
</body>

</html>
