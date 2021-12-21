<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма загрузки изображений</title>
    <link rel="stylesheet" href="{{ url('css/uploadPageStyle.css') }}">
</head>
<body>
    <div class="container">
        <form action="/upload/addImage" method="post" id="upload" enctype="multipart/form-data">
            @csrf
            <input type="file" id="file-button" name="file">
            <input type="submit" id="confirm-button" value="Подтвердить">
            <?php
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            if(isset($_SESSION['upload_message'])) {
                echo '<h2 style="color: red; font-size: 2em">'.$_SESSION['upload_message'].'</h2>';
                unset($_SESSION['upload_message']);
            }
            ?>
            <input type="button" id="confirm-button" value="На главную" onclick="location.href='{{ url('/') }}'">
        </form>
    </div>
</body>
</html>
