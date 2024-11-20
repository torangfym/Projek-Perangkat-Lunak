<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/dist/img/logounib.png') }}" type="image/png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('{{ asset('assets/dist/img/background.jpeg') }}') center/cover no-repeat;
        }

        .welcome-box {
            border-radius: 10px;
            overflow: hidden;
            width: 700px; /* Memperlebar box utama */
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .welcome-box:hover {
            transform: scale(1.02);
        }

        .welcome-header {
            background: linear-gradient(to right, #3498db, #6b5b95);
            color: #fff;
            padding: 30px;
            text-align: center;
        }

        .welcome-content {
            padding: 30px;
            text-align: center;
        }

        .auth-links {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .auth-links a {
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            color: #fff;
        }

        .auth-links .btn-primary {
            background-color: #3498db;
        }

        .auth-links .btn-success {
            background-color: #41b883;
        }

        .kritik-box {
            margin-top: 40px;
        }

        textarea {
            width: calc(100% - 30px);
            padding: 15px;
            margin-top: 20px;
            resize: vertical;
            border-radius: 5px;
        }

        .btn-kirim {
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: linear-gradient(to right, #e74c3c, #c0392b);
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-kirim:hover {
            background: linear-gradient(to right, #c0392b, #e74c3c);
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <div class="welcome-header">
            <h1 class="display-5 font-weight-bold">Selamat Datang di Sistem Informasi Monitoring Dan Arsip Inventaris
                Laboratorium Informatika
            </h1>
        </div>
        <div class="welcome-content">
            <p class="lead">Silakan login untuk dapat mengakses fitur-fitur kami.</p>

            <div class="auth-links">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
