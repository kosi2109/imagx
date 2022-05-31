<?php

namespace controllers;

use models\User;

class AuthController
{
    public function login()
    {
        if ($_SESSION['auth']) {
            return redirect();
        }
        return view('auth/login');
    }

    public function loginStore()
    {
        $users = new User();
        $user = $users->where(request('username'), 'username')->getOne();
        if (!$user) {
            setOld(['username' => request("username")]);
            setError([
                "message" => "User Not Found .",
            ]);
            return redirectBack(["test" => "test"]);
        }

        if (!password_verify(request('password'), $user['password'])) {
            setOld(['username' => request("username")]);
            setError([
                "message" => "Wrong User Creditial",
            ]);
            return redirectBack();
        }

        $_SESSION["auth"] = [
            "username" => $user->username,
            "full_name" => $user->full_name,
        ];
        return redirect();
    }

    public function register()
    {
        if ($_SESSION['auth']) {
            return redirect();
        }
        return view('auth/register');
    }

    public function registerStore()
    {
        if (request("username") == "" | request("full_name") == "" | request("password") == "" | request("password2") == "") {
            setOld([
                "username" => request("username"),
                "full_name" => request("full_name"),
            ]);
            setError([
                "message" => "All fields are required",
            ]);
            return redirectBack();
        }

        if (request("password") !== request("password2")) {
            setOld([
                "username" => request("username"),
                "full_name" => request("full_name"),
            ]);
            setError([
                "message" => "Password doesn't match",
            ]);
            return redirectBack();
        }
        $users = new User();
        $user = $users->where(request('username'), 'username')->getOne();
        if ($user) {
            setOld([
                "username" => request("username"),
                "full_name" => request("full_name"),
            ]);
            setError([
                "message" => "User already exist .",
            ]);
            return redirectBack();
        }
        $req = [
            'username' => request('username'),
            'full_name' => request('full_name'),
            'password' => password_hash(request('password'), PASSWORD_DEFAULT),
        ];

        $users->store($req);
        $_SESSION["success"] = "Account has been successfully created .";
        return redirect("/login");
    }

    public function logout()
    {
        session_destroy();
        return redirect('/login');
    }
}
