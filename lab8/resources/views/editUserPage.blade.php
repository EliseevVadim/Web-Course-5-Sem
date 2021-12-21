<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница редактирования информации о пользователе</title>
    <link rel="stylesheet" href="{{ url('css/editPageStyle.css') }}">
</head>
<body>
<form action="{{'/confirmUsersChanges/'.$user->id}}" method="post">
    @csrf
    <h1>Редактировать информацию о пользователе</h1>
    <span class="mark">Введите новое имя</span>
    <input type="text" name="name" value="{{$user->Name}}" placeholder="Введите имя пользователя...">
    <span class="mark">Введите новый логин</span>
    <input type="text" name="login" value="{{$user->Login}}" placeholder="Введите логин пользователя...">
    <span class="mark">Введите новый email</span>
    <input type="text" name="email" value="{{$user->Email}}" placeholder="Введите email пользователя...">
    <button type="submit">Сохранить изменения</button>
</form>
</body>
</html>

