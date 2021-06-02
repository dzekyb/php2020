<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <nav>
        <a href="1">1</a>
        <a href="2">2</a>
        <a href="3">3</a>
        <a href="4">4</a>
        <?php
            $user = 2;
            if($user === 1){
                echo '<a href="5">5</a>';
            }

        ?>
    </nav>
    
    <h1>Test</h1>
    
    <?php

        for($i = 1; $i <= 7; $i++)
        {
            echo "<p>" . $i . "</p>";
        }


    ?>

</body>
</html>