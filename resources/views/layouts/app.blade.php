<!DOCTYPE html>
<html>
<head>
    <title>App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: radial-gradient(circle at 80% 20%, #1e293b 0%, #000 60%);
            color: white;
        }

        .navbar-custom {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            margin: 20px;
            padding: 10px 30px;
        }

        .navbar-custom a {
            color: #aaa;
            text-decoration: none;
            margin: 0 10px;
        }

        .navbar-custom a:hover {
            color: white;
        }

        .glass-card {
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(15px);
        }

        .btn-glow {
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            border: none;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar-custom d-flex justify-content-between align-items-center">

    <div><strong>MyApp</strong></div>

    <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('buku.index') }}">Buku</a>
        <a href="{{ route('pensil.index') }}">Pensil</a>
        <a href="{{ route('profile') }}">Profile</a>
    </div>

    <div class="d-flex">

        <form action="{{ route('search') }}" method="GET" class="d-flex me-2">
            <input type="text" name="q" class="form-control me-2" placeholder="Search">
            <button class="btn btn-glow">Go</button>
        </form>

        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>

    </div>

</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>