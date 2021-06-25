<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap-utilities.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('public/css/style.css'); }}">

    <title>Ошибка! Страница не найдена.</title>
</head>
<body>
<div class="main-wrapper">
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ URL::asset('public/materials'); }}">Test</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @yield('active')" aria-current="page" href="{{ URL::asset('public/materials'); }}">Материалы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('active')" href="{{ URL::asset('public/tags'); }}">Теги</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('active')" href="{{ URL::asset('public/categories'); }}">Категории</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1>Ошибка! Страница не найдена.</h1>
        </div>
    </div>
    <footer class="footer py-4 mt-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col text-muted">Test</div>
            </div>
        </div>
    </footer>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>
</html>