<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WheelyGoodCars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-md navbar-dark d-print-none bg-black">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><strong class="text-primary">Wheely</strong> good cars<strong class="text-primary">!</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('cars.index') }}">Alle auto's</a></li>
                    @auth
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('profile.cars', auth()->id()) }}">Mijn aanbod</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('cars.create') }}">Aanbod plaatsen</a></li>
                    @endauth
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('register') }}">Registreren</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('login') }}">Inloggen</a></li>
                    @endguest
                    @auth
                    <li class="nav-item"><a class="nav-link text-secondary" href="{{ route('logout') }}">Uitloggen</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex justify-content-center">
        @yield('content')
    </div>
</body>

</html>