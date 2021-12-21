<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/registrationPageStyle.css') }}">
    <title>Регистрация</title>
</head>
<body>
<div id="registration-area">
    <form action="/register/registerUser" method="post">
        @csrf
        <h1>Регистрация</h1>
        @if($errors->any())
            <div id="errors-list">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="text" placeholder="Введите свое имя..." name="name" id="name" required>
        <input type="text" placeholder="Введите логин..." name="login" id="login" required>
        <div id="password-area">
            <input type="password" placeholder="Введите пароль..." name="password" id="password" minlength="6" required>
            <span id="preview-password">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="eye-slash" className="svg-inline--fa fa-eye-slash" role="img" width="33" height="33" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M325.1 351.5L225.8 273.6c8.303 44.56 47.26 78.37 94.22 78.37C321.8 352 323.4 351.6 325.1 351.5zM320 400c-79.5 0-144-64.52-144-143.1c0-6.789 1.09-13.28 1.1-19.82L81.28 160.4c-17.77 23.75-33.27 50.04-45.81 78.59C33.56 243.4 31.1 251 31.1 256c0 4.977 1.563 12.6 3.469 17.03c54.25 123.4 161.6 206.1 284.5 206.1c45.46 0 88.77-11.49 128.1-32.14l-74.5-58.4C356.1 396.1 338.1 400 320 400zM630.8 469.1l-103.5-81.11c31.37-31.96 57.77-70.75 77.21-114.1c1.906-4.43 3.469-12.07 3.469-17.03c0-4.976-1.562-12.6-3.469-17.03c-54.25-123.4-161.6-206.1-284.5-206.1c-62.69 0-121.2 21.94-170.8 59.62L38.81 5.116C34.41 1.679 29.19 0 24.03 0C16.91 0 9.839 3.158 5.121 9.189c-8.187 10.44-6.37 25.53 4.068 33.7l591.1 463.1c10.5 8.203 25.57 6.333 33.69-4.073C643.1 492.4 641.2 477.3 630.8 469.1zM463.1 256c0 24.85-6.705 47.98-17.95 68.27l-38.55-30.23c5.24-11.68 8.495-24.42 8.495-38.08c0-52.1-43-96-95.1-96c-2.301 .0293-5.575 .4436-8.461 .7658C316.8 170 319.1 180.6 319.1 192c0 10.17-2.561 19.67-6.821 28.16L223.6 149.9c25.46-23.38 59.12-37.93 96.42-37.93C399.5 112 463.1 176.6 463.1 256z"></path></svg>
            </span>
        </div>
        <input type="email" placeholder="Введите свой email..." name="email" id="email" required>
        <strong>Выберите роль</strong>
        <select name="role" id="user-roles">
            <option value="1" selected>Пользователь</option>
            <option value="2">Администратор</option>
        </select>
        <button>Зарегистрироваться</button>
    </form>
</div>
<script src="{{ url('js/registrationPageScript.js') }}"></script>
</body>
</html>
