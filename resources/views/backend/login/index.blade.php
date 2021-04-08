<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Đăng nhập hệ thống</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    </head>

    <body class="authentication-page">
        <div id="app">
            <router-view></router-view>
        </div>

        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    </body>
</html>