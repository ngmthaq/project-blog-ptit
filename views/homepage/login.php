<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('./views/parts/__head.php') ?>
    <title>Document</title>
    <style>
        .main-head {
            height: 150px;
            background: #fff;

        }

        .sidenav {
            height: 100%;
            background-color: #5bc9da;
            overflow-x: hidden;
            padding-top: 20px;
        }


        .main {
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }
        }

        @media screen and (max-width: 450px) {
            .login-form {
                margin-top: 10%;
            }

            .register-form {
                margin-top: 10%;
            }
        }

        @media screen and (min-width: 768px) {
            .main {
                margin-left: 40%;
            }

            .sidenav {
                width: 40%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
            }

            .login-form {
                margin-top: 40%;
            }

            .register-form {
                margin-top: 20%;
            }
        }


        .login-main-text {
            margin-top: 20%;
            padding: 60px;
            color: #fff;
        }

        .login-main-text h2 {
            font-weight: 300;
        }

        .btn-black {
            background-color: #000 !important;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="app">
        <div class="sidenav">
            <div class="login-main-text text-dark">
                <h2>Application<br> Login Page</h2>
                <p>Login from here to access.</p>
            </div>
        </div>
        <div class="main">
            <div class="col-lg-8 col-sm-12">
                <div class="login-form">
                    <form action="index.php?controller=admin" method="post" class="my-5">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user_name" class="form-control" placeholder="Username" value="<?php echo isset($user_name) ? $user_name : '' ?>">
                            <?php echo isset($err['user_name']) ? "<small class='text-danger'>" . $err['user_name'] . "</small>" : "" ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <?php echo isset($err['password']) ? "<small class='text-danger'>" . $err['password'] . "</small>" : "" ?>
                            <?php echo isset($err['user']) ? "<small class='text-danger'>" . $err['user'] . "</small>" : "" ?>
                        </div>
                        <button type="submit" class="btn btn-outline-info">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('./views/parts/__script.php') ?>
    <script></script>
</body>

</html>