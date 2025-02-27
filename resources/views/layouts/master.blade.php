<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="{!! asset('assets/plugins/custom/datatables/datatables.bundle.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/plugins/global/plugins.bundle.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('assets/css/jquery-confirm.css') !!}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.theme.min.css"
        integrity="sha512-8vDOoSF7kZUYkn7BiQulRCTvpRoenljlkQDZhM6+IqDJi5jHDH9QEYH9NfMBB8LlqiYc7O17YGxbGx7dOxKrpw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.core.min.css"
        integrity="sha512-tYKqO78H3mRRCHa75fms1gBvGlANz0JxjN6fVrMBvWL+vOOy200npwJ69OBl9XEsTu3yVUvZNrdWFIIrIf8FLg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
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
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                @if ($image)
                                <img src="{{ asset('assets/img/user/' . $image) }}" class="avatar img-fluid rounded-circle" alt="User Avatar" style="width: 50px; height: 50px; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                @else
                                    <img src="{{ asset('assets/img/user/default.jpg') }}" class="avatar img-fluid rounded-circle" alt="User Avatar" style="width: 50px; height: 50px; border: 2px solid #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow-lg" style="border: none; border-radius: 10px; padding: 10px; min-width: 200px;">
                                @can('Access Profile')
                                    <a href="{{ route('management.profile.index') }}" class="dropdown-item d-flex align-items-center" style="padding: 10px; border-radius: 8px; transition: background-color 0.3s ease;">
                                        <i class='bx bxs-user mx-2'></i>
                                        <span>Profile</span>
                                    </a>
                                @endcan
                                <a href="{{ route('home') }}" class="dropdown-item d-flex align-items-center" style="padding: 10px; border-radius: 8px; transition: background-color 0.3s ease;">
                                    <i class='bx bx-door-open mx-2'></i>
                                    <span>Back</span>
                                </a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center" style="padding: 10px; border-radius: 8px; transition: background-color 0.3s ease;">
                                        <i class='bx bx-log-out mx-2'></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-3">
                @yield('breadcrumb')
            </div>

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    @yield('container')
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{!! asset('assets/plugins/global/plugins.bundle.js') !!}"></script>
    <script src="{!! asset('assets/js/scripts.bundle.js') !!}"></script>
    <script src="{!! asset('assets/plugins/custom/datatables/datatables.bundle.js') !!}"></script>
    <script src="{!! asset('assets/js/custom/helper/sanitize.js') !!}"></script>
    <script src="{!! asset('assets/js/custom/helper/js.cookie.js') !!}"></script>
    <script defer src="{!! asset('assets/js/custom/helper/helper.js') !!}?v={{ time() }}"></script>
    <script src="{!! asset('assets/js/custom/jquery.blockUI.js') !!}"></script>
    <script src="{!! asset('assets/plugins/global/viewer.js') !!}"></script>
    <script src="{!! asset('assets/plugins/global/jquery-viewer.js') !!}"></script>
    <script src="{!! asset('assets/js/custom/jquery-confirm.js') !!}"></script>
    <script src="{!! asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/glide.min.js"
        integrity="sha512-2sI5N95oT62ughlApCe/8zL9bQAXKsPPtZZI2KE3dznuZ8HpE2gTMHYzyVN7OoSPJCM1k9ZkhcCo3FvOirIr2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/master.js') }}"></script>
    <script>
        var hostUrl = "assets/";
        const BASEURL = '{{ url('/') }}';
        const APP_URL = "{{ config('app.url') }}/";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
