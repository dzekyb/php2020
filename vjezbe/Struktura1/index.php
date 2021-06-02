<?php
/*** Load PHP functions for everything ***/
require 'includes/functions.php';
?>


<!DOCTYPE html>
<!-- Set choosen language -->
<html <?= setLanguage(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Metadata and Styles always the same for all pages -->
    <?= require 'modules/metadata.module.php'; ?>
    <?= require 'modules/styles.module.php'; ?>
</head>
<body id="wrapper-container">
    <div id="wrapper">
        <!-- Header always the same for all pages -->
        <?= require 'sections/header.section.php'; ?>
        <!-- Here we include proper page content -->
        <?= require 'sections/main.section.php'; ?>
        <!-- Footer always the same for all pages -->
        <?= require 'sections/footer.section.php'; ?>
    </div>
</body>
</html>