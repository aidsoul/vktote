<?php

namespace Vktote\Settings;

use Vktote\Config\Config;
use Vktote\Config\User as U;

/**
 * User class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class User
{

    private string $password;
    private string $path = PATH_GROUP_FOLDER . '/' . USER_CONFIG;

    public function __construct()
    {
        if (file_exists($this->path)) {
            Config::set($this->path);
        } else {
            $this->create($this->path);
            Config::set($this->path);
        }
    }

    /**
     * Checking for the existence of a user
     *
     * Checking whether $_SESSION['user'] matches the
     * password from the user's configuration file
     *
     * @return boolean
     */
    public function existUser(): bool
    {
        $send = false;
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user'] == U::get()->password) {
                $send = true;
            } else {
                $this->exitUser();
            }
        }

        return $send;
    }

    /**
     * Log out of the user account
     *
     * @return int
     */
    public function exitUser(): int
    {
        $status = 0;
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            $status = 1;
        }

        return $status;
    }

    /**
     * User authorization by session means
     *
     * @return array
     */
    private function login(): array
    {
        $_SESSION['user'] = $this->password;
        return ['status' => 1];
    }

    /**
     * checkIfExist function
     *
     * @return string
     */
    public function checkIfExist(): string
    {
        $status = ['status' => 0];
        $this->existUser();
        if (!isset($_SESSION['user'])) {
            if (isset($_POST['password'])) {
                $this->password = md5(USER_ACCESS_KEY . $_POST['password']);
                if (file_exists($this->path)) {
                    // Ok
                    $pass = U::get()->password;
                    //create password
                    if ($pass === '1') {
                        $this->create($this->path);
                        $status = $this->login();
                    } else {
                        if ($pass == $this->password) {
                            $status =  $this->login();
                        } else {
                            if (empty($pass)) {
                                $this->create($this->path);
                                $status = $this->login();
                            } else {
                                $status = ['status' => 2];
                            }
                        }
                    }
                    //Create password
                } else {
                    $this->create($this->path);
                    $status = $this->login();
                }
            } else {
                $status = ['status' => 3];
            }
        } else {
            if ($_SESSION['user'] == U::get()->password) {
                $status = ['status' => 4];
            } else {
                $status = ['status' => 5];
            }
        }

        return json_encode($status);
    }

    /**
     * Create user password function
     *
     * @param string $filePath
     * @param string $password
     * 
     * @return void
     */
    private function create(string $filePath, string $password = ''): void
    {
        $password = $this->password ?? '';
        file_put_contents($filePath, include SETTINGS_PATTERN . '/PatterUser.php');
    }
}
