<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Widgets</title>
    <style>
        .wrapper{
            display: flex;
            justify-content: space-around;
        }
        .wrapper .news{
            width: 25%;
            padding:2%;
            margin: 1;
            background: #2ea3f2;
            border: 1px solid rgba(0,0,0.3);
            color: #FFFFFF;
        }
        .wrapper .news *{
            text-align: center;
        }
        .wrapper .news a{
            text-decoration: none;
            width: 100%;
            display: block;
            background: #333;
            color: #eee;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php
            $connection = mysqli_connect("localhost", "root", "", "news");
            if($error = mysqli_connect_error($connection)){
                die("No connection!");
            }
            $query = mysqli_query($connection, 
            "SELECT * FROM news");
            while($row = mysqli_fetch_assoc($query)){
                echo "<div class='news'>";
                    echo "<h2>" . $row['title'] . "</h2>";
                    echo "<p>" . $row['body'] . "</p>";
                    echo "<a href='news/" . $row['id'] . "'>Open news</a>";
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>