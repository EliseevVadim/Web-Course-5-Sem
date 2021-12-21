<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    private $id;
    private $name;
    private $login;
    private $password;
    private $userType;
    private $email;

    public function __construct()
    {
        $params = func_get_args();
        $number = func_num_args();
        switch ($number) {
            case 2:
                $login = $params[0];
                $password = $params[1];
                $this->login = $login;
                $this->password = sha1($password);
                break;
            case 3:
                $name = $params[0];
                $login = $params[1];
                $email = $params[2];
                $this->name = $name;
                $this->login = $login;
                $this->email = $email;
                break;
            case 4:
                $name = $params[0];
                $login = $params[1];
                $email = $params[2];
                $id = $params[3];
                $this->name = $name;
                $this->login = $login;
                $this->email = $email;
                $this->id = $id;
                break;
            case 5:
                $name = $params[0];
                $login = $params[1];
                $password = $params[2];
                $userType = $params[3];
                $email = $params[4];
                $this->name = $name;
                $this->login = $login;
                $this->password = sha1($password);
                $this->userType = $userType;
                $this->email = $email;
                break;
            default:
                throw new \InvalidArgumentException();
        }
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function getEmail() {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function addToDatabase() {
        try {
            $id = DB::table('User')->insertGetId(
                [
                    'Name' => $this->name,
                    'Login' => $this->login,
                    'Password' => $this->password,
                    'UserTypeId' => $this->userType,
                    'Email' => $this->email
                ]
            );
            session_start();
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['type'] = $this->userType;
            $_SESSION['name'] = $this->name;
        }
        catch (QueryException $exception) {
            throw new \Exception('Пользователь с таким логином уже существует');
        }
    }

    public function existsInDatabase() {
        $sessionInfo = DB::table('User')
            ->select('id', 'UserTypeId', 'Name')
            ->where('login', $this->login)
            ->where('password', $this->password)
            ->get();
        if (count($sessionInfo) === 0)
            return false;
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $sessionInfo[0]->id;
        $_SESSION['type'] = $sessionInfo[0]->UserTypeId;
        $_SESSION['name'] = $sessionInfo[0]->Name;
        return true;
    }

    public function updateInDatabase() {
        $rows = DB::update('update user set Login = :login, Name = :nick, Email = :email
                            where id = :id',
            ['login' => $this->login, 'nick' => $this->name,
                'email' => $this->email, 'id' => $this->id]);
    }

    public function changePassword($newPassword) {
        $this->setPassword($newPassword);
        $rows = DB::update('update user set Password = :password
                            where Login = :login and Name = :nick and Email = :email',
            ['password' => $this->password, 'login' => $this->login, 'nick' => $this->name,
                'email' => $this->email]);
        if ($rows == 0) {
            throw new \Exception('Такого пользователя не существует');
        }
    }

    public static function getAll(): array
    {
        $users = DB::table('user')
            ->join('usertype', 'usertype.id', '=', 'user.UserTypeId')
            ->select('user.id', 'user.Name', 'user.Login', 'usertype.TypeName', 'user.Email')
            ->get();
        return $users->all();
    }

    public static function getUserById($id): array
    {
        $user = DB::table('user')->select('id', 'Name', 'Login', 'Email')
            ->where('id', $id)
            ->get();
        return $user->all();
    }
}
