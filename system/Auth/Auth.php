<?php

namespace System\Auth;

use App\User;
use System\Session\Session;

class Auth
{
    protected $redirectTo = "Auth\Login";
    private function userMethod()
    {
        if (!Session::get('user')) {
            return redirect($this->redirectTo);
        } else {
            $user = User::find(Session::get("user"));
            if (empty($user)) {
                Session::remove("user");
                return redirect($this->redirectTo);
            } else {
                return $user;
            }
        }
    }
    private function isItMethod($input, $rule , $goTo = "Auth\Login")
    {
        if (!Session::get("user")) {
            return redirect($this->redirectTo);
        } else {
            $user = User::find(Session::get("user"));
            if (empty($user)) {
                Session::remove("user");
                return redirect($this->redirectTo);
            } else {
                if ($user->$input != $rule) {
                    return redirect($goTo);
                }
            }
        }
    }
    private function checkMethod()
    {
        if (!Session::get('user')) {
            return redirect($this->redirectTo);
        } else {
            $user = User::find(Session::get("user"));
            if (empty($user)) {
                Session::remove("user");
                return redirect($this->redirectTo);
            } else {
                return true;
            }
        }
    }
    private function checkLoginMethod()
    {
        if (!Session::get('user')) {
            return false;
        } else {
            $user = User::find(Session::get("user"));
            if (empty($user)) {
                return false;
            } else {
                return true;
            }
        }
    }

    private function loginByEmailMethod($email, $password)
    {
        $findUser = User::where("email", $email)->get();
        if (empty($findUser)) {
            error("login", "we cant not find this email");
            return false;
        } else {
            if (!password_verify($password, $findUser[0]->password)) {
                error("login", "password is not true or equil");
                return false;
            } else {
                Session::set("user", $findUser[0]->id);
                return true;
            }
        }
    }

    private function loginByIdMethod($id)
    {
        $findUser = User::find($id);
        if (empty($findUser)) {
            error("login", "we cant not find this email");
            return false;
        } else {
            Session::set("user", $findUser->id);
            return true;
        }
    }
    private function logOutMethod()
    {
        Session::remove("user");
    }

    public function __call($method, $arguments)
    {
        return $this->callMethod($method, $arguments);
    }

    public static function __callStatic($method, $arguments)
    {
        $instance = new Auth();
        return $instance->callMethod($method, $arguments);
    }
    private function callMethod($method, $arguments)
    {
        $sufixx = "Method";
        $method .= $sufixx;
        return call_user_func_array(array($this, $method), $arguments);
    }
}
