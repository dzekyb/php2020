<?php function base() {
    echo str_replace('index.php', '',$_SERVER['PHP_SELF']);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3bb373b9eb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php base(); ?>css/styles.css">
    <title>Logotip price calculator</title>
</head>
