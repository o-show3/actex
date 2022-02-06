<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
@include('common.navbar')
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <div>
                    <p class="menu-label">
                        新着メッセージ
                    </p>
                    <ul class="list-group bg-dark">
                        <li class="list-group-item border-0 bg-dark text-white justify-content-between align-items-center">
                            <a>田中太郎</a>
                            <span class="badge bg-primary rounded-pill">14</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-3">
                    <p class="menu-label">
                        最近やりとりした人
                    </p>
                    <ul class="list-group bg-dark">
                        <li class="list-group-item border-0 bg-dark text-white justify-content-between align-items-center">
                            <a>田中太郎</a>
                            <span class="badge bg-primary rounded-pill">14</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
