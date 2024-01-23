<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shivam Associates</title>
    <link rel="icon" href="img/shivamlogo.png" type="image/png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    .login-box {
        margin-right: 200px;
    }

    .login-box-body {
        background-color: transparent;
        color: white;
    }

    @media (max-width: 768px) {
        /* Adjust styles for smaller screens */
        .login-box {
            margin-right: 0;
            margin-left: 15px; /* Adjust this value based on your design */
        }
    }

            .form-group {
                position: relative;
                margin-bottom: 15px; /* Add margin for spacing between form groups */
            }

            /* Adjust the position and styles of the icon */
            .form-group .icon {
                position: absolute;
                top: 50%;
                left: 10px; /* Adjust as needed */
                transform: translateY(-50%);
                color: #555; /* Adjust the color as needed */
            }

            /* Adjust the padding for the form control */
            .form-group input.form-control {
                padding-left: 30px; /* Adjust as needed based on the icon size and position */
            }



    </style>

</head>
<body class="hold-transition login-page"
    style="background-image: url('img/back.jpeg');height: 80%; background-size: cover; background-repeat: no-repeat;">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-box-body" style="border:1px solid white;">
            <div class="col-md-12 text-center">
                <!-- <h1>SHIVAM ASSOCIATES</h1> -->
                <!-- <p class="login-box-msg">Investment Of Trust</p> -->
                <img src="img/Shivamlogo _1_.png" alt="" height="200" width="200">
            </div>

            <div class="col-md-12 d-flex justify-content-center login-box-msg">
            </div>
            <p class="login-box-msg">Sign In</p>

            <form action="login_check.php" method="post">
                <div class="form-group has-feedback">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <input type="text" name="uname" class="form-control" placeholder="User" autocomplete="off" required autofocus>
                </div>
                <div class="form-group has-feedback">
                    <span class="icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="pass" class="form-control" placeholder="Password" required>
                </div>
                
                <div class="row">
                    <div class="col-xs-4">
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</body>

</html>



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