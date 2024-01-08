<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register User &mdash; Alrescha Wash</title>
    <link rel="icon" href="{{ asset('img/logo-alrescha.ico') }}" type="image/x-icon">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="m-3 p-4">
                        <img src="{{ asset('img/logo-alrescha.png') }}" alt="logo" width="80"
                            class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Selamat Datang Di <span
                                class="font-weight-bold">Alrescha Wash</span>
                        </h4>
                        <p class="text-muted">Isi biodata diri anda</p>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @error('error')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="name" class="form-control" name="name" tabindex="1"
                                    required autofocus value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    Silahkan isi nama anda
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" tabindex="1"
                                    required autofocus value="{{ old('username') }}">
                                <div class="invalid-feedback">
                                    Silahkan isi username anda
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                    required autofocus value="{{ old('email') }}">
                                <div class="invalid-feedback">
                                    Silahkan isi email anda
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" required>
                                <div class="invalid-feedback">
                                    Silahkan isi password anda
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="alamat" class="control-label">Alamat</label>
                                </div>
                                <input id="alamat" type="text" value="{{ old('alamat') }}" class="form-control"
                                    name="alamat" tabindex="2" required>
                                <div class="invalid-feedback">
                                    Silahkan isi alamat anda
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="no_hp" class="control-label">Nomor HP</label>
                                </div>
                                <input id="no_hp" type="text" class="form-control" value="{{ old('no_hp') }}"
                                    name="no_hp" tabindex="2" required>
                                <div class="invalid-feedback">
                                    Silahkan isi nomor HP anda
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                                    tabindex="4">
                                    Register
                                </button>
                            </div>
                        </form>

                        <div class="text-small mt-5 text-center">
                            Copyright &copy; Perusahaan. Dibuat 💙 oleh Alrescha Wash
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    data-background="{{ asset('img/unsplash/carpet.jpg') }}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="display-4 font-weight-bold mb-2 ">Good Morning</h1>
                                <h5 class="font-weight-normal ">Pekanbaru, Indonesia</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
