<!DOCTYPE html>
<html>

<head>
    <title>404</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
            background: url(../images/header.jpg) no-repeat center top;
            width: 100%;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .btn {
            font-size: 50px;
        }

        .title {
            font-size: 150px;
            margin-bottom: 40px;
            text-shadow: -1px -1px #fff, -2px -2px #fff, -1px 1px #fff, -2px 2px #fff, 1px 1px #fff, 2px 2px #fff, 1px -1px #fff, 2px -2px #fff, -3px -3px 2px #bbb, -3px 3px 2px #bbb, 3px 3px 2px #bbb, 3px -3px 2px #bbb;
            color: #4682b4;
            transition: all 1s
        }

        .title:hover {
            color: #9acd32
        }
    </style>
    <script defer>
        (function () {
            let url = window.location.pathname;
            let arrLinks = ['/user_messages', '/all_users', '/news', '/sections_categories', '/user_sections', '/schedule', '/user_news', '/user_gallery', '/images_gallery', '/social','/profile','/login','/register'];

            if (arrLinks.indexOf(url) > -1) {
                window.location.href = `${window.location.origin}/controls`;
            }
        }());
    </script>

</head>

<body>

<div class="container">
    <div class="content">
        <a href="{{url('/').'#home'}}" class="btn btn-primary">Перейти на главную</a>
        <div class="title">404 Error</div>
    </div>
</div>
</body>

</html>
