<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./assets/styles/all.css">
        <title>Login</title>
    </head>

    <body>
        <?php
        require_once "./namespaces/Login.php";
        use \Authorization\Login;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_name = $_POST["username"];
            $password = $_POST["password"];
            $login = new Login($user_name, $password);
            $input_valid = $login->validate_user_input();
            if ($input_valid) {
                $login->login();
            }
        }
        ?>
        <div class="app">
            <div class="login-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <ul>
                        <?php isset($login) && $login->display_errors() ?>
                    </ul>
                    <div class="field_wrapper login_user_name">
                        <label for="username"></label>
                        <input type="text" id="username" name="username" placeholder="Enter your SMS username"
                            autocomplete="off">
                    </div>
                    <div class="field_wrapper login_user_password">
                        <label for="password"></label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <button type="submit">Continue</button>
                    <hr>
                    <div class="register_note">Don't have an account? <a href="register.php">Register</a> with us</div>
                </form>
            </div>
        </div>
    </body>

</html>