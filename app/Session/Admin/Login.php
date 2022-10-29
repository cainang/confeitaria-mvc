<?php

namespace App\Session\Admin;

class Login {

    private static function init(){
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($obUser){
        self::init();

        $_SESSION['admin']['user'] = [
            'id' => $obUser->ID,
            'nome' => $obUser->nome,
            'email' => $obUser->email,
            'ativo' => $obUser->ativo,
        ];

        return true;
    }

    public static function logout(){
        self::init();

        unset($_SESSION['admin']['user']);

        return true;
    }

    public static function isLogged() {
        self::init();

        return isset($_SESSION['admin']['user']['nome']);
    }

    public static function getId() {
        self::init();

        return $_SESSION['admin']['user']['id'];
    }
}