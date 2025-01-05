<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" />
</head>

<body>

    <div class="wrapper">
        @include('partials.sidebar')

        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    {{-- <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                @if($image)
                                    <img src="{{ asset('userProfile/'.$image) }}" class="avatar img-fluid rounded" alt="">
                                @else
                                    <img src="{{ asset('assets/img/male.svg') }}" class="avatar img-fluid rounded" alt="">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('profile') }}" class="dropdown-item" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; text-align: center; font-weight: 600;"><i class='bx bxs-user mx-1'></i> Profile</a>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="text-align: center; font-weight: 600; padding-top: 10px;"><i
                                            class='bx bx-log-out mx-1'></i> Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul> --}}
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    @yield('container')
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class='bx bxs-moon' ></i>
                <i class='bx bxs-sun' ></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>{{ config('app.name') }}</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">FAQ</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/master.js') }}"></script>
</body>

</html>