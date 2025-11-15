<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <title>Admin Login | SBA Portal</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #5BB65F, #4CAF50);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .single-page {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 600px;
            /* min-height: 70vh; */
            padding: 50px 40px;
        }


        h3 {
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }

        .form-control {
            height: 55px;
            border-radius: 10px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: none;
        }

        .btn-login {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            padding: 14px;
        }

        .btn-login:hover {
            background-color: #45a049;
            color: white
        }

        .alert {
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container single-page">
        <div class="wrapper">
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <h3 class="text-center">Admin Login</h3>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Enter Admin Email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter Password" required>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Error / Success Messages --}}
                @if (session('error'))
                    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif

                {{-- Submit Button --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-login w-100">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
