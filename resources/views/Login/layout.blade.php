<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @vite('resources/css/app.css')
</head>
<body>
<div class="container-fluid d-flex h-100 justify-content-center p-1">
    <div class="row text-center">
        @csrf
        @yield('form',"Login")
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>

