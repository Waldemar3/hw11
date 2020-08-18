<?php


namespace App\Controller;


use App\Model\User;

class LoginController
{
    public function __invoke()
    {
        $user = User::where('email', request()->all()['email'])->get()->first();
        if(!is_null($user) && password_verify(request()->all()['password'], $user->password)){
            if(password_needs_rehash($user->password, PASSWORD_ARGON2ID)){
                $user->password = password_hash(request()->all()['password'], PASSWORD_ARGON2ID);
                $user->save();
                echo 'Вы успешно вошли, а также мы обновили хеш пароль!';
            }else{echo 'Вы успешно вошли!';}
        }else{echo 'Нерпавильный email или пароль';}
    }
}