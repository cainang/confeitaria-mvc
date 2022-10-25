<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User;
use \App\Session\Admin\Login as SessionLogin;

class Login extends Index {
    
    public static function getLogin($request) {
        $content = View::render('admin/login', []);

        return parent::getindex('Login', $content);
    }

    public static function setLogin($request){
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        $obUser = User::getUserByEmail($email);
        
        if(!$obUser instanceof User || $senha != $obUser->senha){
            return self::getLogin($request);
        }

        SessionLogin::login($obUser);

        $request->getRouter()->redirect('/admin');
    }

    public static function setLogout($request){
        SessionLogin::logout($obUser);
        
        $request->getRouter()->redirect('/login');
    }
}