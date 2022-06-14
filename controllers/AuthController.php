<?php

namespace controllers;

use models\User;

class AuthController
{
    public function login()
    {
        if (auth()) {
            return redirectBack();
        }
        return view('auth/login');
    }

    public function loginStore()
    {
        if($this->attempt(request('username'),request('password'))){
            return redirect();
        }
    }

    public function register()
    {
        if (auth()) {
            return redirectBack();
        }
        return view('auth/register');
    }

    public function registerStore()
    {
        setOld([
            "username" => request("username"),
            "full_name" => request("full_name"),
            'email' => request('email'),
        ]);
        
        if (request("email") == "" |request("username") == "" | request("full_name") == "" | request("password") == "" | request("password2") == "") {
            setError("All fields are required");
            return redirectBack();
        }

        if (request("password") !== request("password2")) {
            setError("Password doesn't match");
            return redirectBack();
        }
        $users = new User();
        $user = $users->where(request('username'), 'username')->orWhere(request('email'), 'email')->getOne();
        if ($user) {
            setOld([
                "username" => request("username"),
                "full_name" => request("full_name"),
                'email' => request('email'),
            ]);
            setError("User already exist");
            return redirectBack();
        }
        $req = [
            'username' => request('username'),
            'full_name' => request('full_name'),
            'email' => request('email'),
            'password' => password_hash(request('password'), PASSWORD_DEFAULT),
        ];

        $user = $users->store($req);
        if(!$user){
            setError("Fail to create account");
            return redirectBack(); 
        }
        setSuccess("Account has been successfully created .");
        return redirect("/login");
    }

    public function logout()
    {
        login_required();
        session_destroy();
        return redirect('/login');
    }

    private function attempt (string $username , string $password)
    {
        $users = new User();
        $user = $users->where($username, 'username')->getOne();
        setOld(['username' => $username]);
        if (!$user) 
        {
            setError("User Not Found");
            return redirectBack(["test" => "test"]);
        };

        if (!password_verify($password, $user['password'])) 
        {
            setError("Wrong User Creditial");
            return redirectBack();
        };  

        $_SESSION["auth"] = [
            "username" => $user['username'],
            "full_name" => $user['full_name'],
        ];
        return true;
    }

    public function changePassword()
    {
        login_required();
        return view('auth/changePassword');
    }

    public function changePasswordStore()
    {
        login_required();
        if(request('new_password') != request('com_password')){
            setError("Password doesn't match");
            return redirectBack();
        }
        $users = new User();
        $user = $users->where(auth()['username'], 'username')->getOne();
        
        if($this->attempt($user['username'],request('old_password'))){
            $user['password'] = password_hash(request('new_password'), PASSWORD_DEFAULT);
            $users->update($user['id'],$user);
            setSuccess("Password successfully updated");
            return redirectBack();
        }else{
            setError("Fail to update Password");
            return redirectBack();
        }
    }

}
