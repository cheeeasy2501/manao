<?php

namespace Classes;

class Database
{
    private $xml_path;

    function __construct($xml_path)
    {
        $this->xml_path = $xml_path;
    }

    public function isExists()
    {
        if (file_exists($this->xml_path)) {
            return true;
        }
        return false;
    }

    public function loadDatabase()
    {
        return simplexml_load_file($this->xml_path);
    }

    public function checkUserByPassword($database, $login, $password)
    {
        $result = null;
        foreach ($database->user as $user) {
            if ($login == $user->login && $password == $user->password) {
                $result = $user;
                break;
            }
        }
        return $result;
    }

    public function checkUserByCode($database, $login, $code)
    {
        foreach ($database->user as $user) {
            if ($user->login == $login && $user->session == $code) {
                $_SESSION['login'] = (string)$user->name;
                return true;
            }
        }
        return false;
    }

    public function setLogin($database, $user)
    {
        $user_code = $this->generateCode(15);
        setcookie("cookie_login", $user->login, time() + 7 * 24 * 60 * 60, "/");
        setcookie("cookie_code", $user_code, time() + 7 * 24 * 60 * 60, "/");
        $_SESSION['login'] = (string)$user->name;
        $user->session = $user_code;
        $database->asXML($this->xml_path);
    }

    public function beforeRegistration($database, $login, $email)
    {
        $errors = [];

        if(!preg_match("/^[A-Za-z0-9]+$/", $login)) {
            $errors['login'] = "Wrong login! <br /> Use only A-Z  letters and numbers!";
            return $errors;
        }

        foreach ($database->user as $user) {
            if ($user->login == $login || $user->email == $email) {
                if ($user->login == $login) {
                    $errors['login'] = "Login is already exists!";
                }
                if ($user->email == $email) {
                    $errors['email'] = "Email is already exists!";
                }
            }
            if ($errors) {
                break;
            }
        }
        return $errors;
    }

    public function saveInXml($database, $email, $login, $password, $name)
    {
        try {
            $new_user = $database->addChild('user');
            $new_user->addChild('name', $name);
            $new_user->addChild('email', $email);
            $new_user->addChild('login', $login);
            $new_user->addChild('password', $password);
            $new_user->addChild('session', ' ');
            $database->asXML($this->xml_path);
            return;
        } catch (\Exception $error) {
            return ["errors" => $error];
        }
        return ["errors" => false];
    }

    public function getCookie()
    {
        if (isset($_COOKIE['cookie_login']) && isset($_COOKIE['cookie_code'])) {
            return ['login' => $_COOKIE['cookie_login'], 'code' => $_COOKIE['cookie_code']];
        }
        return false;
    }

    public function destroyCookie()
    {
        setcookie('cookie_login', null, -1, '/');
        setcookie('cookie_code', null, -1, '/');
    }

    public function destroySession()
    {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }

    public function generateCode($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
}
