<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
            background-color: #f7f9fb;
            font-size: 14px;
        }
        .my-login-page .card-wrapper {
            width: 400px;
        }
        .my-login-page .card {
            border-color: transparent;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
        }
        .my-login-page .card.fat {
            padding: 10px;
            margin-top: 90px;
        }
        .my-login-page .form-control {
            border-width: 2.3px;
        }
        .my-login-page .btn.btn-block {
            padding: 12px 10px;
        }
        .my-login-page .footer {
            margin: 40px 0;
            color: #888;
            text-align: center;
        }
        @media screen and (max-width: 425px) {
            .my-login-page .card-wrapper {
                width: 90%;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <b>Oops!</b> {{ session('error') }}
                        </div>
                    @endif
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title text-center">Admin Login</h4>
                            <form method="POST" action="{{ route('admin.actionadmin') }}" class="my-login-validation" novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-block" style="background-color: #179BAE; color: white;">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2024 &mdash; Your Company
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha384-SgWQX71pbKZ07bMycZTAwQFcxB6JCMzhVDgMDop3HYGPGb5xpR3apEy99Dx86uYH" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-DAsBR0AHcfe/V5zA3FdvYX3t8RoGaTy7CENrq9l5Al32rdU6OTc0AOMmUsZzsjZn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-h4MUkkV3ZNUcAE28zTX5QJQ3ng/ABXHhzHQ7JS5wWCDuzKT2Bz7X0GQUbS9fEYYx" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</body>
</html>
