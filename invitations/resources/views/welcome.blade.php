<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вас пригласили в компанию</title>
</head>
<body>
    <h1>Вас пригласили в компанию {{$name}}</h1>
    <button id="btn">Принять приглашение</button>
</body>
<script>
    let btn = document.getElementById("btn");
    btn.onclick = function() {
        alert("Установите приложение Charity Steps")
    }
</script>
</html>
