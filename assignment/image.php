<?php

	include 'D:\1RRC\Term 3\XAMPP\htdocs\assignment\php-image-resize-master\lib\ImageResize.php';
  	include 'D:\1RRC\Term 3\XAMPP\htdocs\assignment\php-image-resize-master\lib\ImageResizeException.php';

  	function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    function file_is_a_valid($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = mime_content_type($temporary_path);
        
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }
    $image_upload_detected = isset($_FILES['Image']) && ($_FILES['Image']['error'] === 0);
    $upload_error_detected = isset($_FILES['Image']) && ($_FILES['Image']['error'] > 0);
    
    

    if ($image_upload_detected) { 
        $filename              = $_FILES['Image']['name'];
        $temporary_file_path  = $_FILES['Image']['tmp_name'];
        $new_file_path        = file_upload_path($filename);

        if (file_is_a_valid($temporary_file_path, $new_file_path)) {    
            move_uploaded_file($temporary_file_path, $new_file_path);
            $medium_substr = '.';
            $medium_attachment = '_medium';
            $medium_image = str_replace($medium_substr, $medium_attachment.$medium_substr, $new_file_path);

            $Image = new \Gumlet\ImageResize($new_file_path);
            $Image->scale(50);
            $Image->save($medium_image);
        }
    }
?>