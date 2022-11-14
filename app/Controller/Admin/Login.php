<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Utils\Email;
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
            $alert = Alert::getAlert('Email ou Senha Incorretos!', 'erro');
            $alertJs = Alert::getAlertScript();

            return self::getLogin($request, [
                'alert' => $alert,
                'alertJs' => $alertJs
            ]);
        }

        self::setSession($obUser, $request);
    }

    public static function setRecovery($request){
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';

        $obUser = User::getUserByEmail($email);
        
        if(!$obUser instanceof User){
            $alert = Alert::getAlert('Este email não está vinculado á um usuario!', 'erro');
            $alertJs = Alert::getAlertScript();

            return self::getLogin($request, [
                'alert' => $alert,
                'alertJs' => $alertJs
            ]);
        }

        $userToken = User::getUserToken($obUser->email, $obUser->nome);

        $sender = Email::sendEmail($email, 'recovery', $userToken);

        $alert = "";
        
        if(!$sender){
            $alert = Alert::getAlert('Erro no envio de email, tente novamente!', 'erro');
        } else {
            $alert = Alert::getAlert('Email enviado com sucesso!', 'sucesso');
        }

        $alertJs = Alert::getAlertScript();

        return self::getLogin($request, [
            'alert' => $alert,
            'alertJs' => $alertJs
        ]);
    }

    public static function setPostLogin($request){
        if(isset($request->getQueryParams()["cad"])){
            return self::setSignup($request);
        } else if(isset($request->getQueryParams()["recovery"])) {
            return self::setRecovery($request);
        } else {
            return self::setLogin($request);
        }
    }

    public static function setSession($obUser, $request){
        SessionLogin::login($obUser);

        $request->getRouter()->redirect('/confeitaria-mvc');
    }

    public static function setLogout($request){
        SessionLogin::logout($obUser);
        
        $request->getRouter()->redirect('/login');
    }
}