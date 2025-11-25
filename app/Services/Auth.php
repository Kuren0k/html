<?php
namespace App\Services;

class Auth
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function login($username, $password)
    {
        $adminConfig = $this->config['admin'];

        if($username == $adminConfig['username'] && password_verify($password, $adminConfig['password']))
        {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            return true;
        }
        return false;
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    public function requireAuth()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /admin.php?action=login');
            exit;
        }
    }
}
?>