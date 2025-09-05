<!DOCTYPE html> 
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('backends/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backends/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backends/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .alert-error {
            background-color: #ff8f87;
            color: white;
            padding: 20px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container-xxl">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 bg-black auth-header-box rounded-top">
                                    <div class="text-center p-3">
                                        <a href="{{ url('/') }}" class="logo logo-admin">
                                            <img src="{{asset('backends/assets/images/logo-sm.png')}}" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Create Your Account</h4>
                                        <p class="text-muted fw-medium mb-0">Register to continue to Rizz.</p>
                                    </div>
                                </div>

                                <div class="card-body pt-2">
                                    @if (session('status'))
                                        <div class="alert alert-{{ session('status') }}">
                                            {{ session('sms') }}
                                        </div>
                                    @endif

                                    <form class="my-4" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Full Name -->
                                        <div class="form-group mb-2">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name') }}" required>
                                            @error('name') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                                        </div>

                                        <!-- Username -->
                                        <div class="form-group mb-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                                   value="{{ old('username') }}" required>
                                            @error('username') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group mb-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}" required>
                                            @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                                        </div>

                                        <!-- Photo -->
                                        <div class="form-group mb-2">
                                            <label class="form-label">Profile Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group mb-2">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group mb-2">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit">Register
                                                        <i class="fas fa-user-plus ms-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="text-center mb-2">
                                        <p class="text-muted">Already have an account?
                                            <a href="{{route('login')}}" class="text-primary ms-2">Login</a>
                                        </p>
                                    </div>
                                </div> <!--end card-body-->
                            </div> <!--end card-->
                        </div>
                    </div>
                </div><!--end card-body-->
            </div>
        </div>
    </div>
</body>
</html>
