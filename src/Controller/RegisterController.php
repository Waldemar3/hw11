<?php


namespace App\Controller;


use App\Model\User;

class RegisterController
{
    public function __invoke()
    {
        $user = new User();
        $user->login = request()->all()['fullname'];
        $user->email = request()->all()['email'];
        $user->password = password_hash(request()->all()['password'], PASSWORD_BCRYPT);
        $user->save();
        header('Location: /');
    }
}