<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shivam Investment</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <style>
    .login-box {
        margin-right: 200px;
    }

    .login-box-body {
        background-color: transparent;
        color: white;
    }
        /* :root {
            font-size: 100%;
            font-size: 16px;
            line-height: 1.5;
            --priamary-blue: #233975;
        }
        body {
            padding: 0;
            margin: 0;
            font-family: 'montserrat', sans-serif;
            font-weight:500;
        }
        h1{
            font-size: 2.25rem;
            font-weight:700;
        }
        h2{
            font-size: 1.5rem;
            font-weight: 700;
        }
        a{
            text-decoration:none;
            color:var(--primary-blue);
        }
        a:hover {
            text-decoration:underline;

        }
        .small {
            font-size: 80;
            text-align: center;
        } */
    </style>
</head>
<!-- <body>
    <div class="split-screen">
        <div class="left">
                <section class="copy">
                    <h1>The Investment</h1>
                    <p>Log in To start Your Investment Session</p>
                </section>
        </div>
        <div class="right">
            <form action="">
                <section class="copy">
                    <h2>Sign Up</h2>
                    <div class="login-container">
                        <p>Already have account<a href=""><strong>Log in</strong></a></p>
                    </div>
                </section>
                <div class="input-container name">
                    <label for="fname">User Name</label>
                    <input type="text" id="name">
                </div>
                <div class="input-container email">
                    <label for="password">Password</label>
                    <input type="text" id="name">
                    <i class="far fa-eye-slash"></i>
                </div>
                <div class="input-container cta">
                    
                </div>
                <button class="signup-btn" type="submit">Sign Up</button>
                <section class="copy legal">

                </section>
            </form>
        </div>
    </div>
</body> -->

<body class="hold-transition login-page"
    style="background-image: url('img/back.jpeg');height: 80%; background-size: cover; background-repeat: no-repeat;">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-box-body" style="border:1px solid white;">
            <div class="col-md-12 text-center">
                <h1>THE INVESTMENT</h1>
                <p class="login-box-msg">Investment Of Trust</p>
            </div>

            <div class="col-md-12 d-flex justify-content-center login-box-msg">
            </div>
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="login_check.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="uname" class="form-control" placeholder="User" autocomplete="off" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="pass" class="form-control" placeholder="Password" required>
                    <div class="toggle-password" onclick="togglePassword()">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
                    </div>
                </div>
                <script>
                    function togglePassword() 
                    {
                        // const passwordField = document.getElementById("password");
                        // const toggleButton = document.querySelector(".toggle-password i");
                        // if (passwordField.type === "password") {
                        //     passwordField.type = "text";
                        //     toggleButton.classList.remove("fa-eye");
                        //     toggleButton.classList.add("fa-eye-slash");
                        // } else {
                        //     passwordField.type = "password";
                        //     toggleButton.classList.remove("fa-eye-slash");
                        //     toggleButton.classList.add("fa-eye");
                        // }
                    }
                </script>
                <div class="row">
                    <div class="col-xs-4">
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>

</body>

</html>