<?php
namespace Register;

interface RegisterContract {
    function validate_user_input();
}

class Register implements RegisterContract {
    public $first_name;
    public $last_name;
    public $user_name;
    public $password;
    public $password_confirm;
    public $registerErrors = [
        'missing_first_name' => '',
        'missing_last_name' => '',
        'missing_username' => '',
        'missing_password' => '',
        'missing_password_confirm' => '',
        'mismatching_password' => '',
        'invalid_password' => '',
    ];
    public function __construct($first_name, $last_name, $user_name, $password, $password_confirm) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->password_confirm = $password_confirm;
    }

    public function validate_user_input() {
        $strong_password_pattern = '/^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])/';
        if (empty($this->first_name)) {
            $this->registerErrors["missing_first_name"] = "First name is mandatory";
        } else {
            $this->registerErrors["missing_first_name"] = "";
        }
        if (empty($this->last_name)) {
            $this->registerErrors["missing_last_name"] = "Last name is mandatory";
        } else {
            $this->registerErrors["missing_last_name"] = "";
        }
        if (empty($this->user_name)) {
            $this->registerErrors["missing_username"] = "Username is mandatory";
        } else {
            $this->registerErrors["missing_username"] = "";
        }
        if (empty($this->password)) {
            $this->registerErrors["missing_password"] = "Password is mandatory";
        } else {
            $this->registerErrors["missing_password"] = "";
            if (strlen($this->password) < 6) {
                $this->registerErrors["invalid_password"] = "Password is too short";
            } else {
                if (preg_match($strong_password_pattern, $this->password)) {
                    $this->registerErrors["invalid_password"] = "";
                } else {
                    $this->registerErrors["invalid_password"] = "Password must include a capital letter, number and special character";
                }
            }
        }
        if (empty($this->password_confirm)) {
            $this->registerErrors["missing_password_confirm"] = "Password confirm is mandatory";
        } else {
            $this->registerErrors["missing_password_confirm"] = "";
            if ($this->password !== $this->password_confirm) {
                $this->registerErrors['mismatching_password'] = "Passwords do not match";
            }
        }
    }

    public function display_errors()
    {
       foreach ($this->registerErrors as $key => $error) {
           if ($error) echo "<li class='error'>$error</li>";
       }
    }
}