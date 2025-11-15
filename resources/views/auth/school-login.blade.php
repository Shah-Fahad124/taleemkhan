<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="" name="description">
    <meta content="" name="author">
    <meta name="keywords" content="School Login, Taleemkhan Portal">
    <title>Taleemkhan Portal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #3C3B3F, #605C3C);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            width: 95%;
            max-width: 450px;
            margin: auto;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-icon {
            background: linear-gradient(135deg, #3C3B3F, #605C3C);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 32px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #605C3C;
            box-shadow: 0 0 0 0.2rem rgba(96, 92, 60, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #3C3B3F, #605C3C);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .footer {
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 15px;
            width: 100%;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-right: none;
        }

        .input-group .form-control {
            border-left: none;
        }
    </style>
</head>

<body class="d-flex flex-column">
    <div class="login-container">
        <div class="login-header">
            <div class="login-icon">
               <img src="{{ asset('assets/img/taleemkhan-logo.png') }}" alt="Taleemkhan Logo" class="img-fluid" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <h3 class="font-weight-bold text-dark">School Login</h3>
            <p class="text-muted">Access your Taleemkhan Portal</p>
        </div>

        <form method="POST" action="{{ route('school.login.post') }}">
            @csrf
            <!-- EMIS Code -->
            <div class="form-group">
                <label for="emis_code" class="font-weight-semibold">EMIS Code</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0">
                            <i class="fas fa-school text-muted"></i>
                        </span>
                    </div>
                    <input type="text" name="emis_code" id="emis_code" class="form-control border-left-0" placeholder="Enter your EMIS code" value="{{ old('emis_code') }}" required autofocus>
                </div>
                @error('emis_code')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="font-weight-semibold">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-light border-right-0">
                            <i class="fas fa-lock text-muted"></i>
                        </span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control border-left-0" placeholder="Enter your password" required>
                </div>
                @error('password')
                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                @enderror
            </div>

            <!-- Error / Success Messages -->
            @if(session('error'))
                <div class="alert alert-danger rounded mt-3 mb-0">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success rounded mt-3 mb-0">{{ session('success') }}</div>
            @endif

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-login btn-block text-white font-weight-bold py-2">Login to Portal</button>
            </div>
        </form>
    </div>

    <div class="footer mt-auto">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} Taleemkhan Portal. All rights reserved.</p>
            <!-- <div class="d-flex justify-content-center">
                <a href="#" class="text-white-50 mx-2">Privacy Policy</a>
                <a href="#" class="text-white-50 mx-2">Terms of Service</a>
                <a href="#" class="text-white-50 mx-2">Support</a>
            </div> -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
