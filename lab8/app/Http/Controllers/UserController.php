<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class UserController extends Controller
{
    public function openHomePage() {
        session_start();
        $_SESSION['auth'] = empty($_SESSION['auth']) ? false : $_SESSION['auth'];
        $images = Image::getAllImages();
        return view('index', ['data' => $images]);
    }

    public function openUploadingPage() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SESSION["auth"] == false) {
            return view('register');
        }
        return view('upload');
    }

    public function openAuthorizationPage() {
        return view('authorize');
    }

    public function openRegistrationPage() {
        return view('register');
    }

    public function openResetPasswordPage() {
        return view('resetPassword');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        session_start();
        unset($_SESSION['auth']);
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['type']);
        return redirect()->route('home');
    }
    public function registerUser(Request $request) {
        $isValid = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'login' => 'required',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $login = $request->input('login');
        $password = $request->input('password');
        $role = $request->input('role');
        $user = new User($name, $login, $password, $role, $email);
        try {
            $user->addToDatabase();
            return redirect()->route('home');
        }
        catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function checkUser(Request $request) {
        $isValid = $request->validate([
            'login' => 'required',
            'password' => 'required|min:6',
        ]);
        $login = $request->input('login');
        $password = $request->input('password');
        $user = new User($login, $password);
        if($user->existsInDatabase()) {
            return redirect()->route('home');
        }
        session_start();
        $_SESSION['auth_error'] = true;
        return redirect()->route('authorize');
    }

    public function resetPassword(Request $request) {
        $isValid = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'login' => 'required',
            'password' => 'required|min:6',
            'newPassword' => 'required|min:6',
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $login = $request->input('login');
        $password = $request->input('password');
        $newPassword = $request->input('newPassword');
        if($password != $newPassword) {
            session_start();
            $_SESSION['reset_message'] = 'Пароли не совпадают';
            return redirect('reset');
        }
        try {
            $user = new User($name, $login, $email);
            $user->changePassword($newPassword);
            return redirect()->route('home');
        }
        catch (\Exception $exception){
            session_start();
            $_SESSION['reset_message'] = $exception->getMessage();
            return redirect()->route('reset');
        }
    }

    public function openTablesPage() {
        session_start();
        if(isset($_SESSION['type'])) {
            $users = User::getAll();
            $comments = Comment::getAllComments();
            if($_SESSION['type'] == 2) {
                return view('tablesForAdmin', ['users' => $users, 'comments' => $comments]);
            }
            return view('tablesForUser', ['users' => $users, 'comments' => $comments]);
        }
        die('<h1>Невозможно открыть страницу');
    }

    public function openUserEditingPage($id) {
        session_start();
        $this->checkRightsAllowance();
        $user = User::getUserById($id);
        if(count($user) == 0)
            die('<h1>Такой страницы не существует</h1>');
        return view('editUserPage', ['user' => $user[0]]);
    }

    public function openCommentEditingPage($id) {
        session_start();
        $this->checkRightsAllowance();
        $comment = Comment::getCommentById($id);
        if(count($comment) == 0)
            die('<h1>Такой страницы не существует</h1>');
        return view('editCommentPage', ['comment' => $comment[0]]);
    }

    public function updateUser($id) {
        $name = $_POST['name'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $user = new User($name, $login, $email, (int)$id);
        try {
            $user->updateInDatabase();
            return redirect()->route('tables');
        }
        catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }

    private function checkRightsAllowance() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(!isset($_SESSION['type']) || $_SESSION['type'] != 2)
            die('<h1>Такой страницы не существует</h1>');
    }
}
