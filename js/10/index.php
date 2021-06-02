<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p id="result"></p>
    <button onclick="startWorker()">Start</button>
    <button onclick="stopWorker()">End</button>

    <p id="result2"></p>
    <button onclick="startWorker2()">Start</button>
    <button onclick="stopWorker2()">End</button>
    <script>
        var w;
        var w2;

        function startWorker(){
            if(typeof(Worker) !== "undefined"){
                if(typeof(w) == "undefined"){
                    w = new Worker("worker.js");
                }

                w.onmessage = function(event){
                    document.getElementById("result").innerHTML = event.data;
                };
            }else{
                document.getElementById("result").innerHTML = "Workers are not supported!";
            }
        }

        function stopWorker(){
            w.terminate();
            w = undefined;
        }

        function startWorker2(){
            if(typeof(Worker) !== "undefined"){
                if(typeof(w2) == "undefined"){
                    w2 = new Worker("worker.js");
                }

                w2.onmessage = function(event){
                    document.getElementById("result2").innerHTML = event.data;
                };
            }else{
                document.getElementById("result2").innerHTML = "Workers are not supported!";
            }
        }

        function stopWorker2(){
            w2.terminate();
            w2 = undefined;
        }
    </script>
</body>
</html>