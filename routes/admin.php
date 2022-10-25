<?php

    use \App\Http\Response;
    use \App\Controller\Admin;

    $obRouter->get('/admin', [
        'middlewares' => [
            'require-admin-login'
        ],
        function(){
            return new Response(200, 'Admin');
        }
    ]);

    $obRouter->get('/login', [
        'middlewares' => [
            'require-admin-logout'
        ],
        function($request){
            return new Response(200, Admin\Login::getLogin($request));
        }
    ]);

    $obRouter->get('/logout', [
        'middlewares' => [
            'require-admin-login'
        ],
        function($request){
            return new Response(200, Admin\Login::setLogout($request));
        }
    ]);

    $obRouter->post('/login', [
        'middlewares' => [
            'require-admin-logout'
        ],
        function($request){
            return new Response(200, Admin\Login::setLogin($request));
        }
    ]);

?>