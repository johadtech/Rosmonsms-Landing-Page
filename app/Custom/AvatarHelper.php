<?php

namespace App\Custom;

class AvatarHelper
{
    /**
     * Generate a random avatar.
     *
     * @param string $name
     * @return string
     */
    public static function generateAvatar($name)
    {
        // Define the avatar size
        $width = 100;
        $height = 100;

        // Create a blank image
        $image = imagecreatetruecolor($width, $height);

        // Generate a random color
        $bgColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

        // Get initials from the name
        $initials = self::getInitials($name);

        // Set text color
        $textColor = imagecolorallocate($image, 255, 255, 255);

        // Set font size and path
        $fontSize = 20;
        $fontPath = public_path('storage/font/OpenSans-Bold.ttf'); // Make sure you have the font file

        // Calculate text position
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $initials);
        $x = ($width - ($bbox[2] - $bbox[0])) / 2;
        $y = ($height - ($bbox[1] - $bbox[7])) / 2 + $fontSize;

        // Add text to the image
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $initials);

        // Generate a unique file name
        $fileName = 'avatar_' . time() . '.png';
        $filePath = public_path('storage/user/' . $fileName);

        // Create a buffer to hold the image data
        ob_start();
        // Save the image to the file
        //imagepng($image, $filePath);
        // Output the image as PNG to the buffer
        imagepng($image);
        // Get the image data from the buffer
        $imageData = ob_get_contents();
        // Clear the buffer
        ob_end_clean();

        // Free up memory
        imagedestroy($image);
        
        // Generate the base64 encoded string
        $base64Image = 'data:image/png;base64,' . base64_encode($imageData);

        //return $filePath;
        return $base64Image;
    }

    /**
     * Get initials from the name.
     *
     * @param string $name
     * @return string
     */
    private static function getInitials($name)
    {
    	/**
        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper($word[0]);
        }

        return $initials;
        **/
        $words = explode(' ', $name);
	    $initials = '';
	
	    foreach ($words as $word) {
	        if (strlen($word) > 0) {
	            $initials .= strtoupper($word[0]);
	        }
	    }
	
	    return $initials;
    }
}