<?php // Here we include proper page ?>
<?php require 'main.php'; ?>

<?php if(!isset($_GET['page'])) {
    require('pages/index.php');
} ?>