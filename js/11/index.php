<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container"></div>    
    <script>
        async function getUsers(){
            let url = "users.json";
            try{
                let result = await fetch(url);
                return await result.json();
            }catch(error){
                console.log(error);
            }
        }

        async function renderUsers(){
            let users = await getUsers();
            let html = '';
            users.forEach(user => {
                let htmlSegment = `
                <div class="user">
                <h2>${user.firstName} ${user.lastName}</h2>
                <p>${user.gender}</p>
                </div>`;

                html += htmlSegment;
            });

            let container = document.querySelector(".container");
            container.innerHTML = html;
        }

        renderUsers();

    </script>

</body>
</html>