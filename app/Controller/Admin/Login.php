<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User;
use \App\Session\Admin\Login as SessionLogin;
use \App\Controller\Pages\Index;
use \App\Controller\Pages\Components\Alert;

class Login extends Index {
    
    public static function getLogin($request, $alert = []) {
        $content = View::render('admin/login', []);
        $css = View::getStyleView('login');
        $js = View::getScriptView('login');

        return parent::getindex('Login', $content, $css, $js, $alert);
    }

    public static function setSignup($request) {
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';
        $nome = $postVars['nome'] ?? '';

        $obUser = User::createUser($email, $senha, $nome);

        if(!$obUser instanceof User){
            $alert = Alert::getAlert('Erro ao fazer cadastro, por favor tente novamente!', 'erro');
            $alertJs = Alert::getAlertScript();

            return self::getLogin($request, [
                'alert' => $alert,
                'alertJs' => $alertJs
            ]);
        }

        self::setSession($obUser, $request);
    }

    public static function setLogin($request){
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        $obUser = User::getUserByEmail($email);
        
        if(!$obUser instanceof User || !password_verify($senha, $obUser->senha)){
            $alert = Alert::getAlert('Email ou Senha Incorretos!', 'sucesso');
            $alertJs = Alert::getAlertScript();

            return self::getLogin($request, [
                'alert' => $alert,
                'alertJs' => $alertJs
            ]);
        }

        self::setSession($obUser, $request);
    }

    public static function setPostLogin($request){
        if(isset($request->getQueryParams()["cad"])){
            return self::setSignup($request);
        } else {
            return self::setLogin($request);
        }
    }

    public static function setSession($obUser, $request){
        SessionLogin::login($obUser);

        $request->getRouter()->redirect('/');
    }

    public static function setLogout($request){
        SessionLogin::logout($obUser);
        
        $request->getRouter()->redirect('/login');
    }
}