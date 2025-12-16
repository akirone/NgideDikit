<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>NgideDikit</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="user/img/favicon.png" rel="icon">
    <link href="user/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="user/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="user/vendor/aos/aos.css" rel="stylesheet">
    <link href="user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="user/css/main.css" rel="stylesheet">
</head>

<section class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;"
    id="login">
    <div class="border border-2 border-success shadow mb-5 bg-body-tertiary rounded rounded-4 p-4 w-100" style="max-width: 370px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-1">Login</h2>
            <p class="text-muted mb-0">Silakan masuk ke akun Anda</p>
        </div>
        <form action="{{ route('do-post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control rounded-3" id="email" name="email"
                    placeholder="Masukkan email">
                @error('email')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control rounded-3" id="password" name="password"
                    placeholder="Masukkan password">
                @error('password')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-success w-100 rounded-3 fw-bold">Login</button>
        </form>
        <div class="position-relative d-flex">
            <div class="text-center mt-3 me-auto">
                <a href="#" class="text-decoration-none">Lupa
                    password?</a>
            </div>
            <div class="text-center mt-3 ">
                <a href="/register" class="text-decoration-none">Register</a>
            </div>
        </div>
    </div>
</section>
