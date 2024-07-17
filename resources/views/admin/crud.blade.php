<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user') }}">User Management</a>
            </li>
        </ul>
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

<div class="container mt-5">
    <h2 class="mb-4">CRUD Form</h2>
    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#videoModal">
        Tambah Video
    </button>

    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Tambah Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="videoForm" method="POST" action="{{ route('videos.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="videoName">Nama Video</label>
                            <input type="text" class="form-control" id="videoName" name="videoName" placeholder="Masukkan Nama Video">
                        </div>
                        <div class="form-group">
                            <label for="videoLink">Link Video</label>
                            <input type="url" class="form-control" id="videoLink" name="videoLink" placeholder="Masukkan Link Video">
                        </div>
                        <div class="form-group">
                            <label for="videoDuration">Durasi Video (dalam menit)</label>
                            <input type="number" class="form-control" id="videoDuration" name="videoDuration" placeholder="Masukkan Durasi Video">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5">Daftar Video</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nama Video</th>
            <th>Link Video</th>
            <th>Durasi</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($videos as $video)
            <tr>
                <td>{{ $video->name }}</td>
                <td><a href="{{ $video->link }}" target="_blank">{{ $video->link }}</a></td>
                <td>{{ $video->duration }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editVideoModal{{ $video->id }}">Edit</button>
                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editVideoModal{{ $video->id }}" tabindex="-1" role="dialog" aria-labelledby="editVideoModalLabel{{ $video->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editVideoModalLabel{{ $video->id }}">Edit Video</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editVideoForm{{ $video->id }}" method="POST" action="{{ route('videos.update', $video->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="videoName">Nama Video</label>
                                    <input type="text" class="form-control" id="videoName" name="videoName" value="{{ $video->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="videoLink">Link Video</label>
                                    <input type="url" class="form-control" id="videoLink" name="videoLink" value="{{ $video->link }}">
                                </div>
                                <div class="form-group">
                                    <label for="videoDuration">Durasi Video (dalam menit)</label>
                                    <input type="number" class="form-control" id="videoDuration" name="videoDuration" value="{{ $video->duration }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
