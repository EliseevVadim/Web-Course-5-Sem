<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/mainPageStyle.css') }}">
</head>
<body>
<header>
    <div id="greetings-message">
        <?php
            if (isset($_SESSION['name'])) {
                $message = 'Добро пожаловать, '.$_SESSION['name'];
                echo '<h1>'.$message.'</h1>';
            }
        ?>
    </div>
    <div id="user-actions">
        <div class="action-wrapper">
            <div class="user-option">
                <a href="/upload">Загрузить фото</a>
            </div>
        </div>
        @if(isset($_SESSION['type']))
            <div class="action-wrapper">
                <div class="user-option">
                    <a href="/tables">
                        <svg aria-hidden="true" width="32" height="32" focusable="false" data-prefix="fas" data-icon="pen-to-square" class="svg-inline--fa fa-pen-to-square" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M383.1 448H63.1V128h156.1l64-64H63.1C28.65 64 0 92.65 0 128v320c0 35.35 28.65 64 63.1 64h319.1c35.34 0 63.1-28.65 63.1-64l-.0039-220.1l-63.1 63.99V448zM497.9 42.19l-28.13-28.14c-18.75-18.75-49.14-18.75-67.88 0l-38.62 38.63l96.01 96.01l38.62-38.63C516.7 91.33 516.7 60.94 497.9 42.19zM147.3 274.4l-19.04 95.22c-1.678 8.396 5.725 15.8 14.12 14.12l95.23-19.04c4.646-.9297 8.912-3.213 12.26-6.562l186.8-186.8l-96.01-96.01L153.8 262.2C150.5 265.5 148.2 269.8 147.3 274.4z"></path></svg>
                    </a>
                </div>
            </div>
        @endif
    </div>
    <div id="account-actions">
        <div class="account-option">
            <a href="/authorize">Войти</a>
        </div>
        <div class="account-option">
            <a href="/register">Зарегистрироваться</a>
        </div>
        <div class="account-option">
            <a href="/logout">Выйти</a>
        </div>
    </div>
</header>
<main>
    <h1>Загруженные изображения</h1>
    <div id="gallery">
        <div class="images-area">
            @foreach($data as $element)
                <figure>
                    <img src= {{url('uploads/small_images/'.$element->Path)}} alt= {{$element->Alt}} title="{{$element->Title}}" id={{$element->id}}>
                    <figcaption>
                        Просмотров:
                        <span>{{$element->Views}}</span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</main>
<script src={{url('js/indexPageScript.js')}}></script>
</body>
</html>
