<?php
namespace Authorization;

use Database\DatabaseConnection;

require_once __DIR__ . "/DatabaseConnection.php";
abstract class LoginContract
{
    public $user_name;
    public $password;
    public $loginErrors = [
        "missing_username" => "",
        "missing_password" => "",
        "invalid_password" => "",
    ];

    public function __construct($userName, $password)
    {
        $this->user_name = $userName;
        $this->password = $password;
    }

    public function validate_user_input()
    {
        $input_valid = true;
        $strong_password_pattern = '/^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])/';
        if (empty($this->user_name)) {
            $this->loginErrors["missing_username"] = "User name is mandatory";
            $input_valid = false;
        } else {
            $this->loginErrors["missing_username"] = "";
            $input_valid = true;
        }
        if (empty($this->password)) {
            $this->loginErrors["missing_password"] = "Password is missing";
            $input_valid = false;
        } else {
            $this->loginErrors["missing_password"] = "";
            $input_valid = true;
        }

        return $input_valid;
    }

    abstract public function display_errors();
    abstract public function login();
}

class Login extends LoginContract
{
    use DatabaseConnection;
    public function display_errors()
    {
        foreach ($this->loginErrors as $key => $error) {
            if ($error)
                echo "<li class='error'>$error</li>";
        }
    }

    public function login()
    {
        $connection = $this->connect();
        echo $connection;
    }
}
