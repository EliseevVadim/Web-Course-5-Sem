<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Просмотр изображения</title>
    <link rel="stylesheet" href={{url('css/photoPageStyle.css')}}>
</head>
<body>
<div id="image-holder">
    <img class="responsive" src={{url('uploads/original_images/'.$photo->Path)}} alt="#"}>
    <div class="info-mark">
        <span class="info-key">Загрузил:</span>
        <span class="info-value">{{$photo->author}}</span>
    </div>
    <div class="info-mark">
        <span class="info-key">Просмотров:</span>
        <span class="info-value">{{$photo->Views}}</span>
    </div>
    <?php
    session_start();
    ?>
    @if($_SESSION['auth'])
        <button onclick="location.href='{{url('/edit/'.$photo->id)}}'">Редактировать атрибуты</button>
    @endif
</div>
<div id="comments-area">
    <h1>Комментарии</h1>
    <ul id="comments">
        @foreach($comments as $comment)
            <li>
                <span class="name">{{$comment->author}}:</span>
                <span class="comment">{{$comment->content}}</span>
            </li>
        @endforeach
    </ul>
    <form id="comment-form" action={{url('/leaveComment/'.$photo->id)}} method="post">
        @csrf
        <h2>Оставить свой комментарий</h2>
        <span>Введите свое имя</span>
        <input type="text" name="author" placeholder="Ваше имя..." required>
        <span>Введите свой комментарий</span>
        <textarea name="content" id="comment-field" cols="30" rows="10" placeholder="Ваш комментарий..." required></textarea>
        <button type="submit">Отправить</button>
    </form>
</div>
</body>
</html>
