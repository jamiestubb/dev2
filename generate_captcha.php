<?php

session_start();

// Generate random text for CAPTCHA
$captchaText = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);

// Store the CAPTCHA text in a session variable
$_SESSION['captcha_text'] = $captchaText;

// Create a larger image
$imageWidth = 200; // Width for a larger appearance
$imageHeight = 100; // Height for a larger appearance
$image = imagecreatetruecolor($imageWidth, $imageHeight);

// Set colors
$bgColor = imagecolorallocate($image, 255, 255, 255); // White background
$textColor = imagecolorallocate($image, 0, 0, 0); // Black text
$lineColor = imagecolorallocate($image, 64, 64, 64); // Gray lines

// Fill the background
imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, $bgColor);

// Add random lines for extra security
for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand(0, $imageHeight), $imageWidth, rand(0, $imageHeight), $lineColor);
}

// Path to the TTF font file
$fontFile = __DIR__ . '/fonts/Roboto-Regular.ttf'; // Update this path based on your project structure

// Set font size for TrueType font
$fontSize = 24; // Adjust font size as needed

// Calculate the bounding box to center the text
$bbox = imagettfbbox($fontSize, 0, $fontFile, $captchaText);
$textWidth = $bbox[2] - $bbox[0];
$textHeight = $bbox[1] - $bbox[7];

// Center the text in the image
$textX = ($imageWidth - $textWidth) / 2;
$textY = ($imageHeight - $textHeight) / 2 + $textHeight; // Adjust Y to place text inside image

// Add the text to the image
imagettftext($image, $fontSize, 0, $textX, $textY, $textColor, $fontFile, $captchaText);

// Output the image as a PNG
header("Content-type: image/png");
imagepng($image);

// Clean up
imagedestroy($image);
?>
