<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button onclick="goBack()">Back</button>
    <button onclick="goForward()">Forward</button>
    <script>
        function goBack(){
            window.history.back();
        }

        function goForward(){
            window.history.forward();
        }
    </script>
</body>
</html>