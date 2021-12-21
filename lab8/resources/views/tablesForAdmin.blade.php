<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Таблица пользователей и комментариев</title>
    <link rel="stylesheet" href="{{url('css/tablesPageStyle.css')}}">
</head>
<body>
<main>
    <h1>Таблица пользователей системы</h1>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Логин</th>
            <th>Тип пользователя</th>
            <th>Email</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->Name}}</td>
                <td>{{$user->Login}}</td>
                <td>{{$user->TypeName}}</td>
                <td>{{$user->Email}}</td>
                <td>
                    <button onclick="location.href = '{{url('/editUser/'.$user->id)}}'">Редактировать</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h1>Таблица комментариев</h1>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>id картинки</th>
            <th>Имя автора</th>
            <th>Комментарий</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->ImageId}}</td>
                <td>{{$comment->Author}}</td>
                <td>{{$comment->Content}}</td>
                <td>
                    <button onclick="location.href = '{{url('/editComment/'.$comment->id)}}'">Редактировать</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
</body>
</html>
