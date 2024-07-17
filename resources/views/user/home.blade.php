<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman user</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Vidio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">Hi, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="mt-5 mb-4 text-center">Pilihan Produk Lainnya</h2>
        <div class="row">
            @foreach($videos as $video)
            <div class="col-md-3">
                <div class="card">
                    @php
                        // Ambil ID video YouTube dari link
                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video->link, $matches);
                        $video_id = $matches[1];
                        $thumbnail_url = "https://img.youtube.com/vi/$video_id/hqdefault.jpg";
                    @endphp
                    <img src="{{ $thumbnail_url }}" class="card-img-top" alt="{{ $video->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->name }}</h5>
                        {{-- <p class="card-text">{{ $video->link }}</p> --}}
                        @auth
                            <a href="{{ $video->link }}" class="btn btn-secondary" target="_blank">Nonton Sini</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary">Nonton Sini</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
