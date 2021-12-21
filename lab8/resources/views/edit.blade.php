<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактирование атрибутов фотографии</title>
    <link rel="stylesheet" href="{{ url('css/editPageStyle.css') }}">
</head>
<body>
    <div id="image-holder">
        <img class="responsive" src={{url('uploads/original_images/'.$photo->Path)}} alt="#"}>
    </div>
    <form action="{{'/completeEditing/'.$photo->id}}" method="post">
        @csrf
        <h1>Редактировать атрибуты</h1>
        <span class="mark">Введите alt</span>
        <input type="text" name="alt" value="{{$photo->Alt}}" placeholder="Введите значение alt...">
        <span class="mark">Введите title</span>
        <input type="text" name="title" value="{{$photo->Title}}" placeholder="Введите значение title...">
        <button type="submit">Сохранить изменения</button>
    </form>
</body>
</html>
