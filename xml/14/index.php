<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servis za vijesti</title>
</head>
<body>
    
    <form action="index.php" method="POST">
        <select name="author">
            <option value="1">Pero</option>
            <option value="2">Himzo</option>
            <option value="3">Haso</option>
            <option value="4">Mujo</option>
            <option value="5">Suljo</option>
        </select>
        <select name="format">
            <option value="">Odaberi format</option>
            <option value="json">JSON</option>
            <option value="xml">XML</option>
        </select>
        <input type="text" name="limit" placeholder="Unesi broj vijesti" value="1">
        <input type="submit" value="Daj vijesti">
    </form>

    <?php
        if(isset($_POST['author'])){
            $author = $_POST['author'];
            @$format = $_POST['format'];
            @$limit = $_POST['limit'];

            $results = getNews($author, $format, $limit);
            var_dump($results);
        }

        function getNews($author, $format='json', $limit = 5){
            $read = file_get_contents(
                "http://localhost/amarbeslija/xml/14/service.php?" .
                "&author=" . $author .
                "&format=" . $format .
                "&limit="  . $limit
            );
            // Vrati sadržaj pročitanog service.php fajla
            return $read;
        }

    ?>



</body>
</html>