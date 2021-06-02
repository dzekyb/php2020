<?php
    if(!empty($_FILES)){

        $image_types = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp');

        if($_FILES['image']['size'] < 0){
            $result = "Error1: Wrong file size - File doesn't have content.";
        }else if($_FILES['image']['size'] > 100000000){
            $result = "Error2: Wrong file size - File is to big. Maximum upload is xyz.";
        }else if(!in_array($_FILES['image']['type'], $image_types)){
            $result = "Error3: Wrong file type sent. You can only use JPG, JPEG, PNG, GIF or WEBP image types.";
        }else if(!in_array(mime_content_type($_FILES['image']['tmp_name']), $image_types)){
            $result = "Error3: Wrong file type sent. You can only use JPG, JPEG, PNG, GIF or WEBP image types.";
        }else{
            $image = explode(".", $_FILES['image']['name']);
            $image_name = md5(md5($image[0] . date('d-m-Y H:i:s')));
            $image_full = "uploads/" . $image_name . "." . $image[1];

            if(move_uploaded_file($_FILES['image']['tmp_name'], $image_full)){
                $result = "File uploaded";
            }else{
                $result = "Error4: Can't upload file.";
            }
        }
    }else{
        $result = "Please upload your image.";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
</head>
<body>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">Select Image to Upload</label>
        <input type="file" name="image[]" multiple>
        <br>
        <input type="submit" value="Upload Image">
    </form>

    <h2> <?=$result;?> </h2>
</body>
</html>