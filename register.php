<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/styles/all.css">
    <title>Register</title>
</head>
<body>
<?php
    require_once "./namespaces/Register.php";
    use \Register\Register;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $user_name = $_POST["user_name"];
        $password = $_POST["username"];
        $password_confirm = $_POST["confirm_password"];
        $register = new Register($first_name, $last_name, $user_name, $password, $password_confirm);
        $register -> validate_user_input();
    }
?>
<div class="app">
    <div class="register-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <ul><?php isset($register) && $register->display_errors() ?></ul>
            <div class="field_wrapper first_name">
                <label for="first_name"></label>
                <input type="text" id="first_name" name="first_name" placeholder="What's your first name?" autocomplete="off">
            </div>
            <div class="field_wrapper last_name">
                <label for="last_name"></label>
                <input type="text" id="last_name" name="last_name" placeholder="What's your last name?" autocomplete="off">
            </div>
            <div class="field_wrapper user_name">
                <label for="user_name"></label>
                <input type="text" id="user_name" name="user_name" placeholder="Enter a desired username" autocomplete="off">
            </div>
            <div class="field_wrapper password">
                <label for="password"></label>
                <input type="text" id="password" name="password" placeholder="Enter a password" autocomplete="off">
            </div>
            <div class="field_wrapper password">
                <label for="password"></label>
                <input type="text" id="password" name="confirm_password" placeholder="Confirm password" autocomplete="off">
            </div>
            <button type="submit">Register</button>
            <hr>
            <div class="login_note">Already have an account? <a href="index.php">Login</a> instead</div>
        </form>
    </div>
</div>
</body>
</html>
