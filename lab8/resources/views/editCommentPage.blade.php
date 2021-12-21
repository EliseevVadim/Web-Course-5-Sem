<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница редактирования информации о комментарии</title>
    <link rel="stylesheet" href="{{ url('css/editPageStyle.css') }}">
</head>
<body>
<form action="{{'/confirmCommentChanges/'.$comment->id}}" method="post">
    @csrf
    <h1>Редактировать информацию о комментарии</h1>
    <span class="mark">Введите новое имя автора</span>
    <input type="text" name="author" value="{{$comment->Author}}" placeholder="Введите имя автора...">
    <span class="mark">Введите измененный комментарий</span>
    <input type="text" name="content" value="{{$comment->Content}}" placeholder="Введите новый комментарий...">
    <button type="submit">Сохранить изменения</button>
</form>
</body>
</html>

