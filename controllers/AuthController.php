<?php
namespace controllers;

use models\User;

class AuthController
{
    public function login()
    {
        if($_SESSION['auth']){
            return redirect();
        }
        return view('auth/login');
    }

    public function loginStore()
    {
        $users = new User();
        $user = $users->where(request('username'),'username')->getOne();
        if(!$user){
            setError([
                "message"=>"User Not Found .",
                "username"=>request("username")
            ]);
            return redirectBack(["test"=>"test"]);
        }
        
        if(!password_verify(request('password'),$user['password'])){
            setError([
                "message"=>"Wrong User Creditial",
                "username"=>request("username")
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
        if($_SESSION['auth']){
            return redirect();
        }
        return view('auth/register');
    }

    public function registerStore()
    {
        if(request("username") == "" | request("full_name") == "" | request("password") == "" | request("password2") == "")
        {
            setError([
                "message"=>"All fields are required",
                "username"=>request("username"),
                "full_name"=>request("full_name"),
            ]);
            return redirectBack();
        }

        if(request("password") !== request("password2")){
            setError([
                "message"=>"Password doesn't match",
                "username"=>request("username"),
                "full_name"=>request("full_name"),
            ]);
            return redirectBack();
        }
        $users = new User();
        $user = $users->where(request('username'),'username')->getOne();
        if($user){
            setError([
                "message"=>"Password doesn't match",
                "username"=>request("username"),
                "full_name"=>request("full_name"),
            ]);
            return redirectBack();
        }
        $req = [
            'username' => request('username'),
            'full_name' => request('full_name'),
            'password' => password_hash(request('password'),PASSWORD_DEFAULT),
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